<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Customer;
use App\Repositories\CustomerRepository;
use App\Work_Order;
use App\Repositories\Work_OrderRepository;

class CustomerController extends Controller
{

    public function __construct(CustomerRepository $customers, Work_OrderRepository $work_orders)
    {
        $this->middleware('auth');
        $this->customers = $customers;
        $this->work_orders = $work_orders;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $sort_by = null)
    {
        if (! is_null($sort_by)) {
          $request->session()->put('customer_sort_by', $sort_by);
        }
        $sort_by = session('customer_sort_by', 'last_name');
        $customers = Customer::orderby($sort_by)->paginate(15);
        $customers_all = Customer::orderby('first_name')->get();
        $customer = new Customer;

        return view('customers.list', [
          'customers' => $customers,
          'customers_all' => $customers_all,
          'customer' => $customer,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $sort_by = null)
    {
        //
        if (! is_null($sort_by)) {
          $request->session()->put('customer_sort_by', $sort_by);
        }
        $sort_by = session('customer_sort_by', 'last_name');
        $customers = Customer::orderby($sort_by)->paginate(15);
        $customers_all = Customer::orderby('first_name')->get();
        $customer = new Customer;

        return view('customers.create', [
          'customers' => $customers,
          'customers_all' => $customers_all,
          'customer' => $customer,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
          'first_name' => 'required|max:255',
          'last_name' => 'required|max:255',
          'phone' => 'required',
          'email' => 'email',
          'state' => 'max:2',
          'zip' => 'max:5'
        ]);

        $customer = [
          'first_name' => $request->first_name,
          'last_name' => $request->last_name,
          'zip' => $request->zip,

        ];

        $customer2 = Customer::firstOrNew($customer);

        $customer2->equipment_make = $request->equipment_make;
        $customer2->equipment_model = $request->equipment_model;
        $customer2->cell_phone = $request->cell_phone;
        $customer2->notes = $request->notes;
        $customer2->phone = $request->phone;
        $customer2->email = $request->email;
        $customer2->address1 = $request->address1;
        $customer2->address2 = $request->address2;
        $customer2->city = $request->city;
        $customer2->state = $request->state;
      
        $customer2->preferred_contact_method = $request->preferred_contact_method;
        if ($request->do_not_contact) {
          $customer2->do_not_contact = 1;
        }

        if ($request->hoa) {
          $customer2->hoa = 1;
        }

        if ($request->is_tax_exempt) {
          $customer2->tax_exempt = 1;
        }
        $customer2->tax_exempt_id = $request->tax_exempt_id;
        $customer2->referred_by = $request->referred_by;

        $customer2->save();

        
        $request->session()->put('customer_id', $customer2->id);
        $request->session()->put('new_customer_name', $customer2->full_name());
        if($request->session()->has('from'))
        {
          return redirect($request->session()->pull('from', 'default'));
        }
        return redirect('/customer');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
      $customer = Customer::findOrfail($id);
        $work_orders = $this->work_orders->customer_work_orders($id);

        session(['from' => $request->path()]);

        $status_options = [
          'Mobile Service' => 'Mobile Service',
          'Completed' => 'Completed',
          'Needs Estimate' => 'Needs Estimate',
          'Call with Estimate' => 'Call with Estimate',
          'Estimate Approved' => 'Estimate Approved',
          'Awaiting Parts' => 'Awaiting Parts',
          'In Progress' => 'In Progress',
          'Update Customer' => 'Update Customer',
          'Deliver' => 'Deliver',
          'Pick-Up' => 'Pick-Up',
          'Waiting on Payment' => 'Waiting on Payment',
          'Cancelled' => 'Cancelled'
        ];

        return view('customers.view', [
          'customer' => $customer,
          'work_orders' => $work_orders,
          'status_options' => $status_options,
          'completed' => 0,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::findOrfail($id);

        return view('customers.edit', [
          'customer' => $customer,
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'first_name' => 'required|max:255',
        'last_name' => 'required|max:255',
        'phone' => 'required',
        'email' => 'email',
        'state' => 'max:2',
        'zip' => 'max:5'
      ]);

      $customer = Customer::findOrfail($id);

      $customer->first_name = $request->first_name;
      $customer->last_name = $request->last_name;
      $customer->address1 = $request->address1;
      $customer->address2 = $request->address2;
      $customer->city = $request->city;
      $customer->state = $request->state;
      $customer->zip = $request->zip;
      $customer->phone = $request->phone;
      $customer->email = $request->email;
      $customer->equipment_make = $request->equipment_make;
      $customer->equipment_model = $request->equipment_model;
      $customer->cell_phone = $request->cell_phone;
      $customer->notes = $request->notes;
      $customer->area_color_override = $request->area_color_override;
      
      $customer->preferred_contact_method = $request->preferred_contact_method;
      if ($request->do_not_contact) {
        $customer->do_not_contact = 1;
      }

      if ($request->hoa) {
        $customer->hoa = 1;
      }

      if ($request->is_tax_exempt) {
        $customer->tax_exempt = 1;
      }

      if ($request->wants_follow_up_calls) {
        $customer->wants_follow_up_calls = 1;
      }
      $customer->tax_exempt_id = $request->tax_exempt_id;
      $customer->referred_by = $request->referred_by;
      $customer->save();

      if($request->session()->has('from'))
      {
        return redirect($request->session()->pull('from', 'default'));
      }
      return redirect('/customer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::findOrfail($id);

        $customer->delete();

        return redirect('/customer');
    }

    public function find(Request $request)
    {
      $id = $request->customer_search_id;
      return redirect('/customer/'.$id);
    }

    public function search(Request $request)
    {
      $sort_by = session('customer_sort_by', 'last_name');
      $params = $request->all();
      $params = array_filter($params, 'strlen');
      unset($params['_token']);
      unset($params['hoa']);
      unset($params['do_not_service']);
      unset($params['tax_exempt']);
      unset($params['wants_follow_up_calls']);
      unset($params['do_not_service']);
      unset($params['referred_by']);
      
      $customers = Customer::where(function($q) use ($params){
          foreach($params as $key => $value){
              $q->where($key, 'LIKE', "%" . $value . "%");
          }
      })->orderBy($sort_by)->get();
      $paginate = false;

      /*$query = Customer::where(function($q) use ($params){
          foreach($params as $key => $value){
              $q->where($key, 'LIKE', $value);
          }
      })->toSql();*/

      $customers_all = Customer::orderby('first_name')->get();
      $customer = new Customer;

      return view('customers.index', [
        'customers' => $customers,
        'customers_all' => $customers_all,
        'customer' => $customer,
        'paginate' => $paginate,
      ]);

    }

    public function update_notes(Request $request, $id) {
      $customer = Customer::findOrFail($id);
      $customer->notes = $request->notes;
      $customer->save();
      return redirect('/work_order/schedule');
    }

    public function specials(Request $request)
    {
        $customers = Customer::where('wants_follow_up_calls', true)->paginate(15);
        $customers_all = Customer::orderby('first_name')->get();
        $customer = new Customer;

        return view('customers.list', [
          'customers' => $customers,
          'customers_all' => $customers_all,
          'customer' => $customer,
        ]);
    }
}
