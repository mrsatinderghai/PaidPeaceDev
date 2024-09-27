<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Tenant;
use App\Models\User_Role;
use App\Services\DatabaseManager;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Spatie\Multitenancy\Models\Tenant as BaseTenant; // This is if you need to refer to the base class


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest'); // Ensure only guests can access registration
        $this->middleware('check.tenant.domain');
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function showRegistrationForm()
    {
        if (request()->attributes->get('isMainDomain')) {
            return view('auth.register_main'); // Main domain registration view
        } else {
            return view('auth.register_tenant'); // Tenant registration view
        }
    }

    protected function validator(array $data)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];

        if (request()->attributes->get('isMainDomain')) {
            $rules['domain'] = ['required', 'string', 'unique:tenants'];
        }

        return Validator::make($data, $rules);
    }

    protected function create(array $data)
    {
        if (request()->attributes->get('isMainDomain')) {
            // Step 1: Create the tenant
            $tenant = $this->createTenant($data);
            
            // Step 2: Create the tenant's database
            $this->createTenantDatabase($tenant);
    
            // Step 3: Run tenant migrations
            $this->runTenantMigrations($tenant);
    
            // Step 4: Insert user details into the tenant database
            $this->insertUserDetailsInTenantDatabase($data, $tenant);
    
            // Step 5: Fetch the user from the tenant database (newly created user)
            $user = DB::connection('tenant')->table('users')->where('email', $data['email'])->first();
    
            // Returning the user so that we can log them in
            return $user; // Important to return the user object, not a redirect here
        } else {
            // If registering on a tenant subdomain, create the user in the tenant's database
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            return $user;
        }
    }
    
    public function register(Request $request)
    {
        // Validate the request
        $this->validator($request->all())->validate();
    
        // Create the user (now the correct user object will be returned)
        $user = $this->create($request->all());
    
        // Log the user in
        $this->guard()->loginUsingId($user->id); // Assuming the $user object has an ID
    
        // Check if the request is from the main domain or tenant subdomain
        if (request()->attributes->get('isMainDomain')) {
            // Redirect to the tenant subdomain
            $tenant = Tenant::on('mysql')->where('domain', $request->input('domain'))->first();
            return redirect()->to('http://' . $tenant->domain .'.'. env('SUB_DOMAIN'));
        } else {
            // Redirect to the tenant's home page
            return redirect('/home');
        }
    }
    

    protected function createTenant(array $data)
    {
        $databaseName = 'tenant_' . $data['domain'];

        return Tenant::create([
            'name' => $data['name'] . ' Tenant',
            'domain' => $data['domain'],
            'database' => $databaseName,
        ]);
    }


    protected function createTenantDatabase(Tenant $tenant)
    {
        // Instantiate the DatabaseManager service to create the tenant's database
        $databaseManager = new DatabaseManager();
        $databaseManager->createDatabase($tenant->database);
    }

    protected function runTenantMigrations(Tenant $tenant)
    {

        try {
            $tenant->makeCurrent();
            // Other operations...
            // Define the tenant database connection dynamically
            config(['database.connections.tenant.database' => $tenant->database]); // Set the database name here

            // Run migrations specifically on the tenant's database connection
            \Artisan::call('migrate', [
                '--database' => 'tenant',  // Use tenant connection
                '--path' => 'database/migrations', // Path to tenant-specific migrations
                '--force' => true,
            ]);


            // Include full namespace if applicable
            $seeders = [
                \Database\Seeders\RolesTableSeeder::class,
                \Database\Seeders\TeamsTableSeeder::class,
                \Database\Seeders\ZipcodeareasTableSeeder::class,
            ];

            foreach ($seeders as $seeder) {
                \Artisan::call('db:seed', [
                    '--database' => 'tenant',
                    '--class' => $seeder,
                    '--force' => true,
                ]);
            }
        } catch (\Exception $e) {
            \Log::error("Error setting current tenant: " . $e->getMessage());
        } finally {
            $tenant->forgetCurrent();
        }
    }

    protected function insertUserDetailsInTenantDatabase(array $data, Tenant $tenant)
    {
        // Set the current tenant context
        config(['database.connections.tenant.database' => $tenant->database]);

        // Create a new DB connection for the tenant
        $tenantDB = DB::connection('tenant');

        // Insert user details into the tenant's users table
        $tenantDB->table('users')->insert([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'team_id' => '1',
            'is_admin' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $tenantUserId = $tenantDB->table('users')->where('email', $data['email'])->value('id');

        $tenantDB->table('user_roles')->insert([
            'user_id' => $tenantUserId,
            'role_id' => '1',
        ]);
    }
}
