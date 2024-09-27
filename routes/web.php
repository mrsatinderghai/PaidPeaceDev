<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::group(['middleware' => ['web']], function () {

    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index');


});


Route::group(['middleware' => ['web']], function () {
    Route::auth();
    Route::get('/home', 'App\Http\Controllers\HomeController@index');
    Route::get('/access_denied', 'App\Http\Controllers\HomeController@access_denied');
    Route::post('/home/tweet', ['as' => 'home.tweet', 'uses' => 'App\Http\Controllers\HomeController@tweet']);
    Route::post('/home/fbstatus', ['as' => 'home.fbstatus', 'uses' => 'App\Http\Controllers\HomeController@fbstatus']);

  
    Route::get('task/team', 'App\Http\Controllers\TaskController@team');
    Route::get('task/project', 'App\Http\Controllers\TaskController@project');
    Route::get('task/hot', 'App\Http\Controllers\TaskController@hot');
    Route::resource('task', 'App\Http\Controllers\TaskController');

    //Team routes
    Route::resource('team', 'App\Http\Controllers\TeamController');

    //Note routes
    Route::resource('note', 'App\Http\Controllers\NoteController');

    //Company routes
    Route::resource('company', 'App\Http\Controllers\CompanyController');

    //Contact routes
    Route::resource('contact', 'App\Http\Controllers\ContactController');

    //Zip Code routes
    Route::resource('zipcodearea', 'App\Http\Controllers\ZipCodeAreaController');

    //Export routes
    Route::resource('export', 'App\Http\Controllers\CustomerController@export');
    Route::post('export_option', 'App\Http\Controllers\CustomerController@export_option')->name('customer.export_option');
    Route::post('export_whole', 'App\Http\Controllers\CustomerController@export_whole')->name('customer.export_whole');

    //Sales routes
    Route::get('sale/dashboard', 'App\Http\Controllers\SaleController@dashboard');
    Route::get('/sale/leads', 'App\Http\Controllers\SaleController@leads');
    Route::get('/sale/rejected', 'App\Http\Controllers\SaleController@rejected');
    Route::get('/sale/accepted', 'App\Http\Controllers\SaleController@accepted');
    Route::get('sale/pipeline', 'App\Http\Controllers\SaleController@pipeline');
    Route::resource('sale', 'App\Http\Controllers\SaleController');

    //Transaction routes
    Route::get('transaction/dashboard', 'App\Http\Controllers\TransactionController@dashboard');
    Route::get('transaction/receivable', 'App\Http\Controllers\TransactionController@receivable');
    Route::get('transaction/payable', 'App\Http\Controllers\TransactionController@payable');
    Route::resource('transaction', 'App\Http\Controllers\TransactionController');

    //Invoice routes
    Route::get('data/invoices', 'App\Http\Controllers\InvoiceController@indexData');
    Route::get('data/invoices/unpaid', 'App\Http\Controllers\InvoiceController@unpaidData');
    Route::get('data/invoices/all', 'App\Http\Controllers\InvoiceController@allData');
    Route::get('invoice/unpaid', 'App\Http\Controllers\InvoiceController@unpaid');
    Route::get('invoice/all', 'App\Http\Controllers\InvoiceController@all');
    Route::match(['get', 'post'], 'invoice/daily', 'App\Http\Controllers\InvoiceController@daily')->name('invoices.daily');
    Route::match(['get', 'post'], 'invoice/timeframe', 'App\Http\Controllers\InvoiceController@timeframe')->name('invoices.timeframe');
    Route::patch('invoice/send/{id}', 'App\Http\Controllers\InvoiceController@send');
    Route::patch('invoice/resend/{id}', 'App\Http\Controllers\InvoiceController@resend');
    Route::get('invoice/check_out/{id}', 'App\Http\Controllers\InvoiceController@check_out');
    Route::post('invoice/process_payment/{id}', 'App\Http\Controllers\InvoiceController@process_payment');
    Route::resource('invoice', 'App\Http\Controllers\InvoiceController');
//     Route::post('invoice/{id}', 'App\Http\Controllers\InvoiceController@show');

    //Workflow routes
    Route::resource('workflow', 'App\Http\Controllers\WorkflowController');

    //User routes
    Route::resource('user', 'App\Http\Controllers\UserController');
    Route::post('user/update_roles', ['as' => 'user.update_roles', 'uses' => 'App\Http\Controllers\UserController@update_roles']);

    Route::resource('role', 'App\Http\Controllers\RoleController');

    Route::get('activity/log/{type}/{id}/{parent_type}', 'App\Http\Controllers\ActivityController@log');
    Route::resource('activity', 'App\Http\Controllers\ActivityController');

    Route::patch('product/update_inventory/{id}', 'App\Http\Controllers\ProductController@update_inventory');
    Route::get('product/retire/{id}', ['as' => 'product.retire', 'uses' => 'App\Http\Controllers\ProductController@retire']);
    Route::resource('product', 'App\Http\Controllers\ProductController');

    Route::get('service/retire/{id}', ['as' => 'service.retire', 'uses' => 'App\Http\Controllers\ServiceController@retire']);
    Route::resource('service', 'App\Http\Controllers\ServiceController');

    Route::patch('customer/update_notes/{id}', ['as' => 'customer.update_notes', 'uses' => 'App\Http\Controllers\CustomerController@update_notes']);
    Route::post('customer/search', ['as' => 'customer.search', 'uses' => 'App\Http\Controllers\CustomerController@search']);
    Route::post('customer/find', 'App\Http\Controllers\CustomerController@find');
    Route::get('customer/index/{sort_by?}', 'App\Http\Controllers\CustomerController@index');
    Route::get('customer/specials', ['as' => 'customer.specials', 'uses' => 'App\Http\Controllers\CustomerController@specials']);
    Route::resource('customer', 'App\Http\Controllers\CustomerController');


    Route::match(['get', 'post'], 'reports/finance/daily', 'App\Http\Controllers\ReportController@finance_daily')->name('reports.finance.daily');
    Route::match(['get', 'post'], 'reports/finance/timeframe', 'App\Http\Controllers\ReportController@finance_timeframe')->name('reports.finance.timeframe');
    Route::match(['get', 'post'], 'reports/finance/payroll', 'App\Http\Controllers\ReportController@finance_payroll')->name('reports.finance.payroll');

    
    Route::match(['get','post'], 'work_order/analyze', 'App\Http\Controllers\Work_OrderController@analyze')->name('work_order.analyze');
    Route::post('work_order/search', ['as' => 'work_order.search', 'uses' => 'App\Http\Controllers\Work_OrderController@search']);
    Route::post('work_order/update_stop_orders', ['as' => 'work_order.update_stop_orders', 'uses' => 'App\Http\Controllers\Work_OrderController@update_stop_orders']);
    Route::get('work_order/shop_work/{id}', ['as' => 'work_order.shop_work', 'uses' => 'App\Http\Controllers\Work_OrderController@shop_work']);
    Route::get('work_order/truck_schedule/{id}/{date?}', ['as' => 'work_order.truck_schedule', 'uses' => 'App\Http\Controllers\Work_OrderController@truck_schedule']);
    Route::get('work_order/completed', 'App\Http\Controllers\Work_OrderController@completed');
    Route::get('work_order/shop_work', 'App\Http\Controllers\Work_OrderController@shop_work_list');
    Route::get('work_order/schedule_for_delivery', 'App\Http\Controllers\Work_OrderController@schedule_for_delivery_list');
    Route::get('work_order/update_schedule/{id}/{date}/{time}/{truck}', 'App\Http\Controllers\Work_OrderController@update_schedule');
    Route::get('work_order/schedule/{date?}', 'App\Http\Controllers\Work_OrderController@schedule');
    Route::get('work_order/invoice/{id}', 'App\Http\Controllers\Work_OrderController@invoice');
    Route::patch('work_order/update_service/{id}', 'App\Http\Controllers\Work_OrderController@update_service');
    Route::patch('work_order/update_product/{id}', 'App\Http\Controllers\Work_OrderController@update_product');
    Route::get('work_order/index/{sort_by?}', 'App\Http\Controllers\Work_OrderController@index');
    Route::get('work_order/cancel/{id}', 'App\Http\Controllers\Work_OrderController@cancel');
    Route::patch('work_order/set_time/{id}', ['as' => 'work_order.set_time', 'uses' => 'App\Http\Controllers\Work_OrderController@set_time']);
    Route::post('work_order/store_new_part', ['as' => 'work_order.store_new_part', 'uses' => 'App\Http\Controllers\Work_OrderController@store_new_part']);
    Route::get('work_order/{id}/remove_part/{part_id}', 'App\Http\Controllers\Work_OrderController@remove_part');
    Route::get('work_order/{id}/remove_service/{service_id}', 'App\Http\Controllers\Work_OrderController@remove_service');
    Route::get('work_order/my_schedule', ['as' => 'work_order.my_schedule', 'uses' => 'App\Http\Controllers\Work_OrderController@my_schedule']);
    Route::post('work_order/filter', ['as' => 'work_order.filter', 'uses' => 'App\Http\Controllers\Work_OrderController@filter']);
    Route::resource('work_order', 'App\Http\Controllers\Work_OrderController');

    Route::post('truck/assign_user_to_day', 'App\Http\Controllers\TruckController@assign_user_to_day');
    Route::resource('truck', 'App\Http\Controllers\TruckController');

    Route::post('date_note/save', 'App\Http\Controllers\Date_NoteController@save');

    Route::get('time_slot_locks/lock/{date}/{truck_id}/{time_slot}/{action}', ['as' => 'time_slot_locks.lock', 'uses' => 'App\Http\Controllers\Work_OrderController@lock_time_slot']);

    Route::post('service/get_sell_price', 'App\Http\Controllers\ServiceController@get_sell_price')->name('service.get_sell_price');
    Route::post('product/get_sell_price', 'App\Http\Controllers\ProductController@get_sell_price')->name('product.get_sell_price');

    Route::get('truck/hide/{id}', 'App\Http\Controllers\TruckController@hide')->name('truck.hide');

    Route::post('work_order/quote', 'App\Http\Controllers\Work_OrderController@quote')->name('work_order.quote');

    Route::post('zip_code_area/color_by_zip', 'App\Http\Controllers\ZipCodeAreaController@color_by_zip')->name('zip_code_area.color_by_zip');
 




    /*
     *  Social Media Routes
     */

    //Twitter
    Route::get('twitter/login', ['as' => 'twitter.login', function(){
    // your SIGN IN WITH TWITTER  button should point to this route
        $sign_in_twitter = true;
        $force_login = false;

    // Make sure we make this request w/o tokens, overwrite the default values in case of login.
        Twitter::reconfig(['token' => '', 'secret' => '']);
        $token = Twitter::getRequestToken(route('twitter.callback'));

        if (isset($token['oauth_token_secret']))
        {
            $url = Twitter::getAuthorizeURL($token, $sign_in_twitter, $force_login);

            Session::put('oauth_state', 'start');
            Session::put('oauth_request_token', $token['oauth_token']);
            Session::put('oauth_request_token_secret', $token['oauth_token_secret']);

            return Redirect::to($url);
        }

        return Redirect::route('twitter.error');
    }]);

    Route::get('twitter/callback', ['as' => 'twitter.callback', function() {
    // You should set this route on your Twitter Application settings as the callback
    // https://apps.twitter.com/app/YOUR-APP-ID/settings
        if (Session::has('oauth_request_token'))
        {
            $request_token = [
            'token'  => Session::get('oauth_request_token'),
            'secret' => Session::get('oauth_request_token_secret'),
            ];

            Twitter::reconfig($request_token);

            $oauth_verifier = false;

            if (Input::has('oauth_verifier'))
            {
                $oauth_verifier = Input::get('oauth_verifier');
            }

        // getAccessToken() will reset the token for you
            $token = Twitter::getAccessToken($oauth_verifier);

            if (!isset($token['oauth_token_secret']))
            {
                return Redirect::route('twitter.login')->with('flash_error', 'We could not log you in on Twitter.');
            }

            $credentials = Twitter::getCredentials();

            if (is_object($credentials) && !isset($credentials->error))
            {
            // $credentials contains the Twitter user object with all the info about the user.
            // Add here your own user logic, store profiles, create new users on your tables...you name it!
            // Typically you'll want to store at least, user id, name and access tokens
            // if you want to be able to call the API on behalf of your users.

            // This is also the moment to log in your users if you're using Laravel's Auth class
            // Auth::login($user) should do the trick.

                Session::put('access_token', $token);

                return Redirect::to('/home')->with('flash_notice', 'Congrats! You\'ve successfully signed in!');
            }

            return Redirect::route('twitter.error')->with('flash_error', 'Crab! Something went wrong while signing you up!');
        }
    }]);

    Route::get('twitter/error', ['as' => 'twitter.error', function(){
    // Something went wrong, add your own error handling here
    }]);

    Route::get('twitter/logout', ['as' => 'twitter.logout', function(){
        Session::forget('access_token');
        return Redirect::to('/')->with('flash_notice', 'You\'ve successfully logged out!');
    }]);

    //Facebook
    Route::get('/facebook/login', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb)
    {
    // Send an array of permissions to request
        $login_url = $fb->getLoginUrl(['email', 'publish_actions', 'manage_pages', 'publish_pages']);
        Session::put('facebook_login_url', $login_url);
    // Obviously you'd do this in blade :)
        return Redirect::to($login_url);
    });

// Endpoint that is redirected to after an authentication attempt
    Route::get('/facebook/callback', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb)
    {
    // Obtain an access token.
        try {
            $token = $fb->getAccessTokenFromRedirect();
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }

    // Access token will be null if the user denied the request
    // or if someone just hit this URL outside of the OAuth flow.
        if (! $token) {
        // Get the redirect helper
            $helper = $fb->getRedirectLoginHelper();

            if (! $helper->getError()) {
                abort(403, 'Unauthorized action.');
            }

        // User denied the request
            dd(
                $helper->getError(),
                $helper->getErrorCode(),
                $helper->getErrorReason(),
                $helper->getErrorDescription()
                );
        }

        if (! $token->isLongLived()) {
        // OAuth 2.0 client handler
            $oauth_client = $fb->getOAuth2Client();

        // Extend the access token.
            try {
                $token = $oauth_client->getLongLivedAccessToken($token);
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                dd($e->getMessage());
            }
        }

        $fb->setDefaultAccessToken($token);

    // Save for later
        Session::put('fb_user_access_token', (string) $token);


    // Get basic info on the user from Facebook.
        try {
            $response = $fb->get('/me?fields=id,name,email');
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }

        $facebook_user = $response->getGraphUser();


        //TIME TO ADD PAGE ACCESS
        /*
         *  This will need to be changed when other people start using the app.
         *  Will have to pull their list of pages and ask what they want to post as and then set the page_id below
         *
         */
        $page_id_8180 = '949479431749371';
        try
        {
            $page_access_token = $fb->get('/'.$page_id_8180.'?fields=access_token')->getGraphObject()->getProperty('access_token');
        }
        catch(Facebook\Exceptions\FacebookResponseException $e)
        {
          // When Graph returns an error
          echo 'Graph returned an error: ' . $e->getMessage();
          exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
          // When validation fails or other local issues
          echo 'Facebook SDK returned an error: ' . $e->getMessage();
          exit;
        }

        Session::put('fb_page_access_token', (string) $page_access_token);
        return redirect('/home')->with('message', 'Successfully logged in with Facebook');


        });
});

// $api = app('Dingo\Api\Routing\Router');

// $api->version('v1',  function ($api) {
//     $api->get('user/{id}', ['as' => 'users.show', 'uses' => 'App\Http\Controllers\Api\V1\Controllers\App\Http\Controllers\UserController@show']);
//     $api->get('task/{user_id}', ['as' => 'tasks.mine', 'uses' => 'App\Http\Controllers\Api\V1\Controllers\App\Http\Controllers\TaskController@mine']);
// });

