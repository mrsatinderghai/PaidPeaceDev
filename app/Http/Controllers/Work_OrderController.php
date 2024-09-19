<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Work_Order;
use App\Repositories\Work_OrderRepository;
use App\Repositories\CustomerRepository;
use Auth;
use App\Models\Customer;
use App\Models\Team;
use App\Repositories\ServiceRepository;
use App\Models\Invoice;
use PDF;
use App\Models\Work_Order_Service;
use App\Models\Service;
use Carbon\Carbon;
use App\Repositories\ProductRepository;
use App\Models\Product;
use App\Repositories\InvoiceRepository;
use App\Models\Truck;
use App\Models\Custom_Service;
use App\Models\Custom_Part;
use App\Models\Date_Note;
use App\Models\Trucks_Users_Day;
use App\Models\Time_Slot_Lock;
use Mail;

class Work_OrderController extends Controller
{

  public function __construct(Work_OrderRepository $work_orders, CustomerRepository $customers, ServiceRepository $services, ProductRepository $products, InvoiceRepository $invoices)
  {
    $this->middleware('auth');
    $this->middleware('admin', ['only' => ['update_stop_orders']]);
    $this->work_orders = $work_orders;
    $this->customers = $customers;
    $this->services = $services;
    $this->products = $products;
    $this->invoices = $invoices;
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $sort_by = 'id', $filter_by = '')
    {
      if (! is_null($sort_by)) {
        if ($sort_by == 'filter') {

        }
        $request->session()->put('work_order_sort_by', $sort_by);
      } 
      $sort_by = session('work_order_sort_by', 'id');
      $work_orders = $this->work_orders->active($sort_by);
      $work_order = new Work_Order;
      $customers = $this->customers->customers(Auth::user()->team_id, 'first_name');

      $customer_select = array();
      foreach($customers as $customer) {
        $customer_select[$customer->id] = $customer->full_name();
      }

      $assigned_to_select = array();
      
      if(isset(Auth::user()->team->members)){
        $team_members = Auth::user()->team->members;

      }else{
        $team_members = array();

      }
      foreach($team_members as $team_member) {
        $assigned_to_select[$team_member->id] = $team_member->name;
      }

      $services = $this->services->team_services();

      session(['from' => $request->path()]);


      if ($request->session()->has('customer_id')) {
        $customer_id = $request->session()->pull('customer_id');
      } else {
        $customer_id = null;
      }

      if ($request->session()->has('new_customer_name')) {
        $new_customer_name = $request->session()->pull('new_customer_name');
      } else {
        $new_customer_name = null;
      }

      $status_options = config('constants.status_options');

      if(empty($status_options)){
        $status_options = [];
      }

      return view('work_orders.index', [
        'work_orders' => $work_orders,
        'work_order' => $work_order,
        'customer_select' => $customer_select,
        'customer' => new Customer,
        'assigned_to_select' => $assigned_to_select,
        'services' => $services,
        'customer_id' => $customer_id,
        'customers_all' => $customers,
        'completed' => 0,
        'new_customer_name' => $new_customer_name,
        'status_options' => $status_options,
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $customers = $this->customers->customers(Auth::user()->team_id, 'first_name');

      $customer_select = array();
      foreach($customers as $customer) {
        $customer_select[$customer->id] = $customer->full_name();
      }

      $assigned_to_select = array();
     // $team_members = Auth::user()->team->members;

      $user = Auth::user();
      if ($user->team) {
        $team_members = $user->team->members;
      } else {
        $team_members = [];
      }


      if(!empty($team_members)){
        foreach($team_members as $team_member) {
          $assigned_to_select[$team_member->id] = $team_member->name;
        }
      }

      session(['from' => $request->path()]);

      if ($request->session()->has('customer_id')) {
        $customer_id = $request->session()->pull('customer_id');
      } else {
        $customer_id = null;
      }

      if ($request->session()->has('new_customer_name')) {
        $new_customer_name = $request->session()->pull('new_customer_name');
      } else {
        $new_customer_name = null;
      }
      return view('work_orders.create', [
        'customers_all' => $customers,
        'customer' => new Customer,
        'work_order' => new Work_Order,
        'new_customer_name' => $new_customer_name,
        'customer_id' => $customer_id,
        

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
        'customer_id' => 'required',
      ]);

      $work_order = new Work_Order;
      $work_order->customer_id = $request->customer_id;
      $work_order->reason = $request->reason;
      $work_order->discount = $request->discount;
      $work_order->code = $request->code;
      $work_order->status = 'Mobile Service';
      $work_order->appointment_date = '0000-00-00';
      $work_order->save();

      $services = $request->services;
      if ($services) {
        foreach($services as $service) {
          $work_order->services()->attach($service);
        }
      }

      if (Auth::user()->hasRole('Admin')) {
        return redirect('/work_order/schedule');
      } else {
        return redirect()->route('work_order.edit', $work_order->id);
      }
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $work_order = Work_Order::findOrFail($id);
      $invoice = $work_order->invoice->first();
      $services = $this->services->team_services();
      $products = $this->products->team_products();
      $select_services = $work_order->services();
      $trucks = Truck::all();
      $assigned_to_truck = array();
      $assigned_to_select = array();
      $team_members = Auth::user()->team->members;
      foreach($team_members as $team_member) {
        $assigned_to_select[$team_member->id] = $team_member->name;
      }
      $assigned_toselect[null] = "Unassigned";
      $assigned_to_truck[null] = 'Unassigned';
      foreach($trucks as $truck) {
        $assigned_to_truck[$truck->id] = $truck->name;
      }
      $custom_parts = $work_order->custom_parts()->get();

      $custom_services = $work_order->custom_services()->get();

      
      $services_select = array();
      $services_costs = array();
      $services_select[0] = 'None';
      foreach($services as $service) {
        $services_select[$service->id] = $service->description;
      }
      
      foreach($services as $service) 
        
        
        $parts_select = array();
      $parts_costs = array();
      $parts_select[0] = 'None';
      foreach($products as $product) {
        $parts_select[$product->id] = $product->description;
      }
      $num_parts = $work_order->products->count();
      $num_services = $work_order->services->count();

//         $status_options = config('constants.status_options');
      $status_options = [
        'Cancelled' => 'Cancelled',
        'Mobile Service' => 'Mobile Service',
        'Installation' => 'Installation',
        'Schedule for Delivery' => 'Schedule for Delivery',
        'Delivery' => 'Delivery',
        'Shop Work' => 'Shop Work',
        'Waiting on Payment' => 'Waiting on Payment',
        'Complete' => 'Complete'
      ];
      return view('work_orders.edit2', [
        'invoice' => $invoice,
        'work_order' => $work_order,
        'services' => $services,
        'products' => $products,
        'assigned_to_select' => $assigned_to_select,
        'assigned_to_truck' => $assigned_to_truck,
        'status_options' => $status_options,
        'custom_parts' => $custom_parts,
        'custom_services' => $custom_services,
        'services_select' => $services_select,
        'parts_select' => $parts_select,
        'num_parts' => $num_parts,
        'num_services' => $num_services,
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
      //dd($request);
      $work_order = Work_Order::findOrFail($id);
      $work_order->truck_id = $request->truck_id;
      $work_order->appointment_date = $request->appointment_date;
      $work_order->appointment_time_slot = $request->appointment_time_slot;
      $work_order->reason = $request->reason;
      $work_order->status = $request->status;
      $work_order->cancellation_reason = $request->cancellation_reason;
      $work_order->comments = $request->comments;
      $work_order->shop_work_status = $request->shop_work_status;
      $work_order->assigned_to = $request->assigned_to;
      $work_order->delivery_date = $request->delivery_date; 
      $work_order->save();

      $total_cost = 0;

      foreach($work_order->services as $s) {
        $total_cost += $s->pivot->line_cost;
      }

      foreach($work_order->products as $p) {
        $total_cost += $p->pivot->line_cost;
      }

      if ($request->service1) {
        $service = Service::findOrFail($request->service1);
        $work_order->services()->attach($service, ['sale_price' => $request->service1cost, 'quantity' => 1, 'line_cost' => $request->service1cost]);
        $total_cost += $request->service1cost;
      }
      

      if ($request->service2) {
        $service = Service::findOrFail($request->service2);
        $work_order->services()->attach($service, ['sale_price' => $request->service2cost, 'quantity' => 1, 'line_cost' => $request->service2cost]);
        $total_cost += $request->service2cost;
      }

      if ($request->service3) {
        $service = Service::findOrFail($request->service3);
        $work_order->services()->attach($service, ['sale_price' => $request->service3cost, 'quantity' => 1, 'line_cost' => $request->service3cost]);
        $total_cost += $request->service3cost;
      }
      
      $num_parts = $work_order->products->count();
      
      
      if ($request->part) {
        $count = $num_parts + 1;
        foreach($request->part as $p) {
          $part = Product::findOrFail($p);
          $price = 'part' . $count . 'cost';
          $qty = 'part' . $count . 'qty';
          $price_var = $request->$price;
          $qty_var = $request->$qty;
          $line_cost = $price_var * $qty_var;
          $work_order->products()->attach($part, ['sale_price' => $price_var, 'quantity' => $qty_var, 'line_cost' => $line_cost, 'tax' => '0.00', ]);
          $count++;
          $total_cost += $line_cost;
        }
      }


      $work_order->save();

      if ( $request->create_invoice ) {
        if ( Invoice::where('work_order_id', $work_order->id)->get()->count()) {
          return redirect('/work_order');
        }
        $invoice = new Invoice;
        $invoice->team_id = 1;
        $invoice->work_order_id = $work_order->id;
        $invoice->status = 'Unpaid';
        $invoice->is_paid = 0;

        $amount = 0;
        foreach($work_order->services as $service) {
          $amount += $service->pivot->line_cost;
        }

        foreach($work_order->products as $product) {
          $amount += $product->pivot->line_cost;
        }

        $invoice->amount = $amount;
        $invoice->save();
        $invoice->number = $invoice->id;
        $invoice->save();
        $work_order->status = 'Completed';
        $work_order->save();
      }

      $customer = $work_order->customer;

      if ($request->send_quote) {
        Mail::send('work_orders.quote', [
          'customer' => $customer,
          'work_order' => Work_Order::findOrFail($work_order->id),
          'team' => Auth::user()->team,
          'quote_datetime' => Carbon::now(),
          'total_cost' => $total_cost,
          
        ],
        function ($m) use ($request, $customer) {
          $m->from('noreply@sharpmower.com', 'Sharp Mower');
          $m->to($customer->email, $customer->full_name())->subject('Sharp Mower Quote');
        });
      }

      $invoice = $work_order->invoice()->first();
      if (! is_null($invoice)) {
        return redirect('/invoice/check_out/'.$invoice->id);
      } else {
        return redirect()->route('work_order.edit', $work_order->id);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $work_order = Work_Order::findOrFail($id);
      $work_order->delete();

      return redirect('/work_order');
    }

    public function invoice($id)
    {
      $work_order = Work_Order::findOrFail($id);
      $invoice = Invoice::where(['work_order_id' => $work_order->id])->first();
      $customer = $work_order->customer;


      // $pdf = PDF::loadView('invoices.invoice', [
      //     'invoice' => $invoice,
      //     'customer' => $customer,
      //     'work_order' => $work_order,
      //     'team' => Auth::user()->team,
      //     ]);

      // return $pdf->stream($invoice->number.'.pdf');
      return view('invoices.invoice', [
        'invoice' => $invoice,
        'customer' => $customer,
        'work_order' => $work_order,
        'team' => Auth::user()->team,
      ]);
    }

    public function update_service(Request $request, $id)
    {
      $invoice = Invoice::findOrFail($request->invoice_id);
      $work_order = $invoice->work_order;
      $service = $work_order->services()->find($id);
      $wos = Work_Order_Service::findOrFail($id);
      $wos->sale_price = $request->sale_price;
      //$service->pivot->sale_price = $request->sale_price;
      $wos->quantity = 1;
      //$service->pivot->quantity = 1;
      $wos->line_cost = $request->sale_price * 1;
      //$service->pivot->line_cost = $request->sale_price * 1;
      $wos->save();
      //$service->pivot->save();

      return redirect('invoice/check_out/'.$request->invoice_id);
    }

    public function update_product(Request $request, $id)
    {
      //dd($request->all());
      $invoice = Invoice::findOrFail($request->invoice_id);
      $work_order = $invoice->work_order;
      $product = $work_order->products()->find($id);
      $product->pivot->sale_price = $request->sale_price;
      $product->pivot->quantity = $request->product_quantity;
      $product->pivot->tax = 0; //($request->sale_price * $request->product_quantity) * .07;
      $product->pivot->line_cost = $request->sale_price * $request->product_quantity;

      $product->pivot->save();

      return redirect('invoice/check_out/'.$request->invoice_id);
    }

    public function schedule($today = null)
    {
      if (! Auth::user()->hasRole('Admin')) {
        return redirect()->route('work_order.my_schedule');
      }
      
      if (is_null($today)) {
        $today = Carbon::now();
      } else {
        $today = Carbon::parse($today);
      }
      $last_week = $today->copy()->subDays(7)->toDateString();
      $next_week = $today->copy()->addDays(7)->toDateString();

      $work_orders = Work_Order::where('appointment_date', '0000-00-00')->where('status', '<>', 'Completed')->where('status', '<>', 'Cancelled')->get();
      
      $work_orders_left = Work_Order::where('appointment_date', '0000-00-00')
      ->whereIn('status', ['Installation', 'Delivery', 'Mobile Service'])
      ->orWhere(function($q) {
        $q->where('appointment_date', '<>' ,'0000-00-00')
        ->whereNull('delivery_date')
        ->whereIn('status', ['Installation', 'Delivery']);
      })->get();
      
      $trucks = Truck::where('hidden', false)->get();
      $assigned_to_select = array();
      $assigned_to_select[0] = 'Unassigned';
      $team_members = Auth::user()->team->members;
      foreach($team_members as $team_member) {
        $assigned_to_select[$team_member->id] = $team_member->name;
      }
      $assigned_to_select[-1] = 'Blocked';

      $dates = array();
      $days_of_week = array();
      $date_notes = array();
      foreach($trucks as $truck){
        $date_notes[$today->toDateSTring()][$truck->id] = Date_Note::where('date', $today->toDateString())->where('truck_id', $truck->id)->get();
      }
      $wo = array();
      $wo[$today->toDateString()]['9am-1pm'] = Work_Order::where('appointment_date', $today->toDateString())->where('appointment_time_slot', '9am-1pm')->where('status', '<>', 'Cancelled')->get();
      $wo[$today->toDateString()]['12pm-5pm'] = Work_Order::where('appointment_date', $today->toDateString())->where('appointment_time_slot', '12pm-5pm')->where('status', '<>', 'Cancelled')->get();
      $wo[$today->toDateString()]['8am-6pm'] = Work_Order::where('appointment_date', $today->toDateString())->where('appointment_time_slot', '8am-6pm')->where('status', '<>', 'Cancelled')->get();
      array_push($dates, $today->toDateString());
      array_push($days_of_week, $today->format('l'));
      for ($x = 1; $x < 7; $x++)
      {
        $new_date = $today->addDays(1)->toDateString();
        foreach($trucks as $truck){
          $date_notes[$today->toDateSTring()][$truck->id] = Date_Note::where('date', $new_date)->where('truck_id', $truck->id)->get();
        }
        $wo[$new_date]['9am-1pm'] = Work_Order::where('appointment_date', $new_date)->where('appointment_time_slot', '9am-1pm')->where('status', '<>', 'Cancelled')->get();
        $wo[$new_date]['12pm-5pm'] = Work_Order::where('appointment_date', $new_date)->where('appointment_time_slot', '12pm-5pm')->where('status', '<>', 'Cancelled')->get();
        $wo[$new_date]['8am-6pm'] = Work_Order::where('appointment_date', $new_date)->where('appointment_time_slot', '8am-6pm')->where('status', '<>', 'Cancelled')->get();

        array_push($dates, $new_date);
        array_push($days_of_week, Carbon::createFromFormat('Y-m-d', $new_date)->format('l'));
      }
      //dd($date_notes);
      $assigned_to_truck[null] = 'Unassigned';
      foreach($trucks as $truck) {
        $assigned_to_truck[$truck->id] = $truck->name;
      }
      $status_options =  config('constants.status_options');
      if(empty($status_options)){
        $status_options = [];
      }

      $tsl = array();
      $time_slot_locks = array();
      foreach($dates as $date) {
        $ntsl = Time_Slot_Lock::where('date', $date)->get();
        array_push($tsl, $ntsl);
        foreach($ntsl as $t) {
          $time_slot_locks[$t->date][$t->truck_id][$t->time_slot] = $t->is_locked;
        }
      }
      
      foreach($tsl as $t) {
        
      }
      //dd($time_slot_locks);

      $customers = $this->customers->customers(Auth::user()->team_id, 'first_name');

      $view = request()->has('view') ? 'schedule':'schedule2';
      /*
      $status_options = [
          'Cancelled' => 'Cancelled',
          'Mobile Service' => 'Mobile Service',
          'Installation' => 'Installation',
          'Schedule for Delivery' => 'Schedule for Delivery',
          'Delivery' => 'Delivery',
          'Shop Work' => 'Shop Work',
          'Waiting on Payment' => 'Waiting on Payment',
          'Complete' => 'Complete'
      ];
      */
//       return view('work_orders.'.$view, [
      return view('work_orders.schedule', [
        'work_orders' => $work_orders,
        'work_orders_left' => $work_orders_left,
        'trucks' => $trucks,
        'wo' => $wo,
        'dates' => $dates,
        'days_of_week' => $days_of_week,
        'assigned_to_select' => $assigned_to_select,
        'next_week' => $next_week,
        'last_week' => $last_week,
        'assigned_to_truck' => $assigned_to_truck,
        'status_options' => $status_options,
        'date_notes' => $date_notes,
        'time_slot_locks' => $time_slot_locks,
        'customer' => new Customer,
        'customers_all' => $customers,
        'work_order' => new Work_Order,
        'new_customer_name' => null,
        'customer_id' => null,
      ]);
    }

    public function update_schedule($id, $date, $time, $truck)
    {
      $TUD = Trucks_Users_Day::where('date', $date)->where('truck_id', $truck)->first();
      if ($TUD) {
        if ($TUD->is_blocked()) {
          return "Can't schedule on blocked date.";
        }
      }
      $work_order = Work_Order::findOrFail($id);
      if ($work_order->status == 'Completed') {
        return "Can't move a completed work order.";
      }
      $work_order->appointment_date = $date;
      $work_order->delivery_date = $date;
      $work_order->appointment_time_slot = $time;
      $work_order->truck_id = $truck;
      if ($TUD) {
        $work_order->assigned_to = $TUD->user_id;
      }
      $work_order->save();

      return 'Work Order updated.';
    }

    public function completed(Request $request)
    {
      $work_orders = $this->work_orders->completed();
      $work_order = new Work_Order;
      $customers = $this->customers->customers(Auth::user()->team_id, 'first_name');

      $customer_select = array();
      foreach($customers as $customer) {
        $customer_select[$customer->id] = $customer->full_name();
      }

      $assigned_to_select = array();
      $team_members = Auth::user()->team->members;
      foreach($team_members as $team_member) {
        $assigned_to_select[$team_member->id] = $team_member->name;
      }

      $services = $this->services->team_services();

      session(['from' => $request->path()]);

      if ($request->session()->has('customer_id', 'default')) {
        $customer_id = $request->session->get('customer_id');
      } else {
        $customer_id = null;
      }

      $status_options = config('constants.status_options');
      if(empty($status_options)){
        $status_options = [];
      }


      return view('work_orders.index', [
        'work_orders' => $work_orders,
        'work_order' => $work_order,
        'customer_select' => $customer_select,
        'customer' => new Customer,
        'assigned_to_select' => $assigned_to_select,
        'services' => $services,
        'customer_id' => $customer_id,
        'customers_all' => $customers,
        'completed' => 1,
        'new_customer_name' => '',
        'status_options' => $status_options,
      ]);
    }

    public function truck_schedule(Request $request, $truck_id, $date = null)
    {
      $request->session()->put('from', url()->current());
      $truck = Truck::findOrFail($truck_id);
      if (is_null($date)) {
        $date = Carbon::now();
      } else {
        $date = Carbon::parse($date);
      }
      $dates = array();
      $wo = array();
      $date_notes = Date_Note::where('date', $date)->where('truck_id', $truck_id)->first();
      $wo[$date->toDateString()]['9am-1pm'] = Work_Order::where('appointment_date', $date->toDateString())->where('appointment_time_slot', '9am-1pm')->where('truck_id', $truck_id)->where('status', '<>', 'Cancelled')->orderBy('schedule_order', 'ASC')->get();
      $wo[$date->toDateString()]['12pm-5pm'] = Work_Order::where('appointment_date', $date->toDateString())->where('appointment_time_slot', '12pm-5pm')->where('truck_id', $truck_id)->where('status', '<>', 'Cancelled')->orderBy('schedule_order', 'ASC')->get();
      $wo[$date->toDateString()]['8am-6pm'] = Work_Order::where('appointment_date', $date->toDateString())->where('appointment_time_slot', '8am-6pm')->where('truck_id', $truck_id)->where('status', '<>', 'Cancelled')->orderBy('schedule_order', 'ASC')->get();

      return view('work_orders.truck_schedule', [
        'truck' => $truck,
        'wo' => $wo,
        'date' => $date->toDateString(),
        'date_notes' => $date_notes,
      ]);
    }

    public function cancel($id)
    {
      $work_order = Work_Order::findOrFail($id);
      $work_order->status = 'Cancelled';
      $work_order->save();

      return redirect('work_order/schedule');
    }

    public function set_time(Request $request, $id) {
      //dd($request);
      //if ($request->truck_id != 1 && $request->truck_id != 2) {
        //dd('died here' . 'truck_id: ' . $request->truck_id);
        //return redirect('work_order/schedule');
      //}

      $this->validate($request, [
//         'truck_id' => 'required',
        'appointment_date' => 'required',
        'appointment_time_slot' => 'required',
        'code' => 'required',
//         'discount' => 'required',
      ]);

      $work_order = Work_Order::findOrFail($id);
      $work_order->status = $request->status;
      $work_order->appointment_date = $request->appointment_date;
      $work_order->appointment_time_slot = $request->appointment_time_slot;
      $work_order->truck_id = $request->truck_id;
      $work_order->code = $request->code;
      $work_order->discount = $request->discount;
      $work_order->save();

      return redirect('work_order/schedule');
    }

    public function store_new_part(Request $request){
      $work_order = Work_Order::findOrFail($request->work_order_id);
      $work_order->save();

      $this->validate($request, [
        'category' => 'required',
        'description' => 'required',
        'cost' => 'required',
        'sell_price' => 'required'
      ]);
      
      $product = new Product;
      $product->team_id = Auth::user()->team_id;
      $product->category = $request->category;
      $product->description = $request->description;
      $product->cost = $request->cost;
      $product->sell_price = $request->sell_price;
      $product->save();
      
      return redirect()->route('work_order.edit', $work_order->id);
    }

    public function remove_part($id, $part_id){
      $work_order = Work_Order::findOrFail($id);
      $work_order->products()->detach($part_id);

      return redirect()->route('work_order.edit', $id);
    }

    public function remove_service($id, $service_id){
      $work_order = Work_Order::findOrFail($id);
      $work_order->services()->detach($service_id);

      return redirect()->route('work_order.edit', $id);
    }

    public function shop_work($id) {
      $work_order = Work_Order::findOrFail($id);
      $work_order->shop_work = !$work_order->shop_work;
      $work_order->save();

      return redirect()->route('work_order.edit', $id);
    }

    public function shop_work_list(Request $request)
    {
      $work_orders = $this->work_orders->shop_work();
      $work_order = new Work_Order;
      $customers = $this->customers->customers(Auth::user()->team_id, 'first_name');

      $customer_select = array();
      foreach($customers as $customer) {
        $customer_select[$customer->id] = $customer->full_name();
      }

      $assigned_to_select = array();
      $team_members = Auth::user()->team->members;
      foreach($team_members as $team_member) {
        $assigned_to_select[$team_member->id] = $team_member->name;
      }

      $services = $this->services->team_services();

      session(['from' => $request->path()]);

      if ($request->session()->has('customer_id', 'default')) {
        $customer_id = $request->session->get('customer_id');
      } else {
        $customer_id = null;
      }

      $status_options = config('constants.status_options');
      if(empty($status_options)){
        $status_options = [];
      }

      return view('work_orders.index', [
        'work_orders' => $work_orders,
        'work_order' => $work_order,
        'customer_select' => $customer_select,
        'customer' => new Customer,
        'assigned_to_select' => $assigned_to_select,
        'services' => $services,
        'customer_id' => $customer_id,
        'customers_all' => $customers,
        'completed' => 1,
        'new_customer_name' => '',
        'status_options' => $status_options, 
      ]);
    }

    public function schedule_for_delivery_list(Request $request)
    {
      $work_orders = $this->work_orders->schedule_for_delivery();
      $work_order = new Work_Order;
      $customers = $this->customers->customers(Auth::user()->team_id, 'first_name');

      $customer_select = array();
      foreach($customers as $customer) {
        $customer_select[$customer->id] = $customer->full_name();
      }

      $assigned_to_select = array();
      $team_members = Auth::user()->team->members;
      foreach($team_members as $team_member) {
        $assigned_to_select[$team_member->id] = $team_member->name;
      }

      $services = $this->services->team_services();

      session(['from' => $request->path()]);

      if ($request->session()->has('customer_id', 'default')) {
        $customer_id = $request->session->get('customer_id');
      } else {
        $customer_id = null;
      }

      $status_options = config('constants.status_options');
      if(empty($status_options)){
        $status_options = [];
      }

      return view('work_orders.list_for_schedule', [
        'work_orders' => $work_orders,
        'work_order' => $work_order,
        'customer_select' => $customer_select,
        'customer' => new Customer,
        'assigned_to_select' => $assigned_to_select,
        'services' => $services,
        'customer_id' => $customer_id,
        'customers_all' => $customers,
        'completed' => 1,
        'new_customer_name' => '',
        'status_options' => $status_options, 
      ]);
    }

    public function update_stop_orders(Request $request) {
      //dd($request->all());
      $this->middleware('Admin');
      foreach($request->except('_token') as $key => $value) {
        $work_order = Work_Order::findOrFail($key);
        $work_order->schedule_order = $value;
        $work_order->save();
      }

      return redirect($request->session()->get('from'));
    }

    public function my_schedule(Request $request) {
      $today = Carbon::now();
      $today = $today->toDateString();
      $user_id = Auth::id();

      //dd("Date String: " . $today . " - User ID: " . $user_id);

      $tud = Trucks_Users_Day::where('date', $today)->where('user_id', $user_id)->first();

      if (! $tud) {
        return view('no_truck');
      } else {
        //dd($tud);
        $truck_id = $tud->truck_id;
        return redirect()->route('work_order.truck_schedule', ['truck_id' => $truck_id, 'date' => $today]);
      }
    }

    public function filter(Request $request)
    {
      $work_orders = $this->work_orders->filter_by($request->filter_by);
      $work_order = new Work_Order;
      $customers = $this->customers->customers(Auth::user()->team_id, 'first_name');

      $customer_select = array();
      foreach($customers as $customer) {
        $customer_select[$customer->id] = $customer->full_name();
      }

      $assigned_to_select = array();
      $team_members = Auth::user()->team->members;
      foreach($team_members as $team_member) {
        $assigned_to_select[$team_member->id] = $team_member->name;
      }

      $services = $this->services->team_services();
      

      $status_options = config('constants.status_options');
      $customer_id = null;
      if(empty($status_options)){
        $status_options = [];
      }
      return view('work_orders.index', [
        'work_orders' => $work_orders,
        'work_order' => $work_order,
        'customer_select' => $customer_select,
        'customer' => new Customer,
        'assigned_to_select' => $assigned_to_select,
        'services' => $services,
        'customer_id' => $customer_id,
        'customers_all' => $customers,
        'completed' => 1,
        'new_customer_name' => '',
        'status_options' => $status_options,
        'do_not_paginate' => true,
        'no_paginate' => true,
      ]);
    }

    public function lock_time_slot($date, $truck_id, $time_slot, $action){
      //dd('got here!');
      if ($action == "lock") {
        $tsl = new Time_Slot_Lock();
        $tsl->date = $date;
        $tsl->truck_id = $truck_id;
        $tsl->time_slot = $time_slot;
        $tsl->is_locked = 1;
        $tsl->save();
      }
      else if ($action == "unlock") {
        $tsl = Time_Slot_Lock::where('date', $date)->where('truck_id', $truck_id)->where('time_slot', $time_slot)->first();
        $tsl->delete();
      }
      else {
        dd("Something went wrong with the action being sent to a time slot lock.");
      }
      return redirect('work_order/schedule');
    }

    public function search(Request $request) {
      $woid = $request->search_work_order;
      $wo = Work_Order::findOrFail($woid);

      return redirect()->route('work_order.edit', $wo->id);
    }

    public function analyze(Request $request) {

      if ($request->isMethod('get')) {
        $work_orders = [];
      } else if ($request->isMethod('post')) {
        $work_orders = Work_Order::join('customers', 'work_orders.customer_id', '=', 'customers.id')->whereBetween('work_orders.appointment_date', [$request->from_date, $request->to_date])->orderBy('customers.zip')->select('work_orders.*')->get();
      }

      return view('work_orders.analyze', [
        'work_orders' => $work_orders,
      ]);
    }

    public function quote(Request $request)
    {
      
    }
    
  }
