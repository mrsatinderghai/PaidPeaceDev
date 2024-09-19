<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Models\Sale;
use App\Models\Company;
use PDF;
use App\Repositories\InvoiceRepository;
use App\Repositories\CompanyRepository;
use App\Repositories\SaleRepository;
use Auth;
use App\Models\Work_Order;
use App\Models\Customer;
use App\Models\Transaction;
use Mail;
use Datatables;



class InvoiceController extends Controller
{

    public function __construct(InvoiceRepository $invoices, SaleRepository $sales)
    {
        $this->middleware('auth');
        $this->invoices = $invoices;
        $this->sales = $sales;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*$sales = $this->sales->get_sales($request->user()->team_id);
        $sale_options = array();
        foreach ($sales as $sale)
        {
          //$company_name = Company::find($sale->company_id)->name;
          $sale_options[$sale->id] = $sale->name;
        }*/
        return view('invoices/index', [
            'invoices' => [],
            'title' => 'Invoices Not Sent',
            ]);
    }

    /**
     * Get Paginated resuls
     */
    public function indexData(){
       $data = $this->invoices->need_sent_raw(); 
       return Datatables::of($data)
                        ->editColumn('customer', function($invoice){
                          return $invoice->work_order->customer->full_name();
                        })
                        ->editColumn('address', function($invoice){
                          return $invoice->work_order->customer->full_address();
                        })
                        ->addColumn('view', function($invoice){
                          return '<a href="'.url('invoice/'.$invoice->id) .'" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a>';
                        })
                        ->addColumn('sent', function($invoice){
                          return '<form action="'. url('invoice/send/'.$invoice->id) .'" method="POST">
                                 '.csrf_field() .
                                  method_field('PATCH') .'
                                  <button class="btn btn-success btn-xs">
                                      <i class="fa fa-check"></i>
                              </form>
                              ';
                        } )
                        ->make(true);
    }
    
    public function allData(){
      $data = $this->invoices->team_invoices_raw(Auth::user()->team_id); 


      if(!empty(request()->report_date)){
        $report_date = request()->report_date; 
        $data = $data->where('created_at', 'like', "%$report_date%");   
      }

      if(!empty(request()->from_date)){
        $from = request()->from_date; 
        $data = $data->where('created_at', '>', $from);
      }

      if(!empty(request()->to_date)){
        $to = request()->to_date; 
        $data = $data->where('created_at', '<', $to); 
      }

      return Datatables::of($data)
                        ->editColumn('customer', function($invoice){
                          return $invoice->work_order->customer->full_name();
                        })
                        ->editColumn('address', function($invoice){
                          return $invoice->work_order->customer->full_address();
                        })
                        ->addColumn('checkout', function($invoice){
                            if($invoice->is_paid == 0)
                             return '<a href="'. url('invoice/check_out/'.$invoice->id).'" class="btn btn-success btn-xs"><i class="fa fa-dollar"></i></a>';
                            else 
                              return ''; 
                        })
                        ->addColumn('view', function($invoice){
                          return '<a href="'.url('invoice/'.$invoice->id) .'" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a>';
                        })
                        ->addColumn('delete', function($invoice){
                          return '<form action="'. url('invoice/'.$invoice->id) .'" method="POST">
                                 '.csrf_field() .
                                  method_field('DELETE') .'
                                  <button class="btn btn-danger btn-xs">
                                      <i class="fa fa-trash"></i>
                              </form>
                              ';
                        } )
                        ->make(true);
    }

    public function unpaidData(){
      $data = $this->invoices->unpaid_raw(Auth::user()->team_id);
      return Datatables::of($data)
                        ->editColumn('customer', function($invoice){
                          return $invoice->work_order->customer->full_name();
                        })
                        ->editColumn('address', function($invoice){
                          return $invoice->work_order->customer->full_address();
                        })
                        ->addColumn('checkout', function($invoice){
                             return $invoice->is_paid ==0 ? '<a href="'. url('invoice/check_out/'.$invoice->id).'" class="btn btn-success btn-xs"><i class="fa fa-dollar"></i></a>':'';
                        })
                        ->addColumn('view', function($invoice){
                          return '<a href="'.url('invoice/'.$invoice->id) .'" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a>';
                        })
                        ->addColumn('delete', function($invoice){
                          return '<form action="'. url('invoice/'.$invoice->id) .'" method="POST">
                                 '.csrf_field() .
                                  method_field('DELETE') .'
                                  <button class="btn btn-danger btn-xs">
                                      <i class="fa fa-trash"></i>
                              </form>
                              ';
                        } )
                        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'amount' => 'required|max:255',
            'number'=> 'required',
        ]);

        $invoice = new Invoice;

         if ($request->has('parent_id'))
            {
                $invoice->sale_id = $request->parent_id;
                //$invoice->company_id = Sale::findOrFail($request->parent_id)->company_id;
            }
          else
          {
            $invoice->sale_id = $request->sale_id;
          }

        $invoice->number = $request->number;
        $invoice->amount = $request->amount;
        $invoice->status = 'Unpaid';
        $invoice->team_id = $request->user()->team_id;

        $invoice->save();

        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        $work_order = Work_Order::findOrFail($invoice->work_order_id);
        $customer = Customer::findOrFail($work_order->customer_id);
        $transactions = $invoice->transactions;

        $paid_amount = 0.00;
        if (count($transactions) > 0) {
          foreach ($transactions as $t) {
            $paid_amount += $t->amount;
          }
        } else {
          $paid_amount = null;
        }

        $pdf = PDF::loadView('invoices.invoice', [
            'invoice' => $invoice,
            'customer' => $customer,
            'work_order' => $work_order,
            'team' => Auth::user()->team,
            'paid_amount' => $paid_amount,
            'custom_services' => $work_order->custom_services()->get(),
            'custom_parts' => $work_order->custom_parts()->get(),
            ]);

        return $pdf->stream($invoice->number.'.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Invoice $invoice)
    {
        // $this->authorize('destroy', $invoice);
        $invoice->delete();
        return Redirect::back();
    }

    public function check_out($id)
    {
      $invoice = Invoice::findOrFail($id);
      $work_order = $invoice->work_order;
      (float) $total = 0.00;
      foreach($work_order->services as $service) {
        $total += $service->pivot->line_cost;
      }
      foreach($work_order->products as $product) {
        $total += $product->pivot->line_cost;
      }

      settype($total, "float");
      $invoice->amount = $total;
      $invoice->save();


      return view('invoices.check_out', [
        'work_order' => $work_order,
        'invoice' => $invoice,
        'customer' => $work_order->customer,
        'team' => Auth::user()->team,
        'total' => $total,
      ]);

    }

    public function process_payment(Request $request, $id)
    {
      $this->validate($request, [
        'email' => 'required|email|unique:users',
        'payment_method' => 'required',
        'send_via_email' => 'required_without_all:send_via_mail,send_via_text',
        'send_via_mail' => 'required_without_all:send_via_email,send_via_text',
        'send_via_text' => 'required_without_all:send_via_email,send_via_mail',
      ]);
      
      $invoice = Invoice::findOrFail($id);
      $work_order = $invoice->work_order;
      $customer = $work_order->customer;

      if ($work_order->shop_work) {
        dd("You cannot process a payment while work order is in shop work.");
      }

      if ($request->payment_method == 'mail') {
        $invoice->is_paid = 0;
        $invoice->status = 'Unpaid';
        $invoice_is_sent = 0;
      } else {
        $invoice->is_paid = 1;
        $invoice->status = 'Paid';
        $invoice->paid_with = $request->payment_method;
      }

      $total = $invoice->amount;
      $invoice->save();

      if ($invoice->status == 'Paid') {
        $transaction = new Transaction;
        $transaction->invoice_id = $invoice->id;
        $transaction->amount = $total;
        $transaction->type = 'Receivable';
        $transaction->team_id = 1;
        $transaction->other_party = $invoice->work_order->customer->full_name();
        $transaction->date = date('Y-m-d');
        $transaction->tender = $invoice->paid_with;
        $transaction->paid_with_detail = $request->paid_with_detail;
        $transaction->save();

        $work_order->status = "Complete";
        $work_order->completed_on = date('Y-m-d');
        $work_order->save();
      }

      if ($request->send_via_email)
      {
        $transactions = $invoice->transactions;
        $paid_amount = 0.00;
        if (count($transactions) > 0) {
          foreach ($transactions as $t) {
            $paid_amount += $t->amount;
          }
        } else {
          $paid_amount = null;
        }
        Mail::send('invoices.invoice', [
          'invoice' => $invoice,
          'customer' => $customer,
          'work_order' => $work_order,
          'team' => Auth::user()->team,
          'paid_amount' => $paid_amount,
          'custom_services' => $work_order->custom_services()->get(),
          'custom_parts' => $work_order->custom_parts()->get(),
        ],
        function ($m) use ($request, $customer) {
            $m->from('noreply@sharpmower.com', 'Sharp Mower');

            $m->to($request->email, $customer->full_name())->subject('Sharp Mower Invoice');
        });

        $invoice->is_sent = 1;
        $invoice->save();

        if ($request->send_via_mail)
        {
          $invoice->is_sent = 0;
          $invoice->save();
        }

        $customer->email = $request->email;
        $customer->save();

      }
      if (! Auth::user()->hasRole('Admin')) {
        return redirect()->route('work_order.my_schedule');
      }
      
      return redirect('/work_order/schedule');
    }

    public function send($id)
    {
      $invoice = Invoice::findOrFail($id);
      $invoice->is_sent = 1;
      $invoice->save();
      
      // Resend the email to customer  08/22
      $work_order = $invoice->work_order;
      $customer = $work_order->customer;

      return redirect('/invoice');
    }

    public function resend($id)
    {
      $invoice = Invoice::findOrFail($id);
      $invoice->is_sent = 1;
      $invoice->save();
      
      // Resend the email to customer  08/22
      $work_order = $invoice->work_order;
      $customer = $work_order->customer;
      
      $transactions = $invoice->transactions;
      $paid_amount = 0.00;
      if (count($transactions) > 0) {
        foreach ($transactions as $t) {
          $paid_amount += $t->amount;
        }
      } else {
        $paid_amount = null;
      }
      
            
      $mail = Mail::send('invoices.invoice', [
        'invoice' => $invoice,
        'customer' => $customer,
        'work_order' => $work_order,
        'team' => Auth::user()->team,
        'paid_amount' => $paid_amount,
        'custom_services' => $work_order->custom_services()->get(),
        'custom_parts' => $work_order->custom_parts()->get(),
      ],
      function ($m) use ($customer) {
          $m->from('noreply@sharpmower.com', 'Sharp Mower');

          $m->to($customer->email, $customer->full_name())->subject('Sharp Mower Invoice');
      });
      
      return redirect('/invoice');
    }

    public function all(Request $request)
    {
        /*$sales = $this->sales->get_sales($request->user()->team_id);
        $sale_options = array();
        foreach ($sales as $sale)
        {
          //$company_name = Company::find($sale->company_id)->name;
          $sale_options[$sale->id] = $sale->name;
        }*/
        return view('invoices.all', [
            'invoices' =>  [],
            'title' => 'All Invoices',
            ]);
    }

    public function unpaid(Request $request)
    {

        return view('invoices.unpaid', [
            'invoices' =>[],
            'title' => 'Unpaid Invoices',
            ]);
    }

    public function daily(Request $request)
    {

        return view('invoices.daily', [
            'invoices' =>[],
            'title' => 'Daily Invoices',
            ]);
    }

    public function timeframe(Request $request)
    {

        return view('invoices.timeframe', [
            'invoices' =>[],
            'title' => 'Timeframe Invoices',
            ]);
    }


}
