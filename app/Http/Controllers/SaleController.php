<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\SaleRepository;
use Illuminate\Support\Facades\Redirect;
use App\Sale;
use App\Repositories\NoteRepository;
use App\Repositories\TaskRepository;
use App\Repositories\InvoiceRepository;
use App\Repositories\WorkflowRepository;
use App\Repositories\CompanyRepository;
use App\Repositories\ActivityRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\ProductRepository;
use Auth;
use Mail;

class SaleController extends Controller
{

  protected $sales;

  public function __construct(
                              SaleRepository $sales,
                              NoteRepository $notes,
                              TaskRepository $tasks,
                              InvoiceRepository $invoices,
                              WorkflowRepository $workflows,
                              CompanyRepository $companies,
                              ActivityRepository $activities,
                              ServiceRepository $services,
                              ProductRepository $products
                              )
  {
    $this->middleware('auth');
    $this->sales = $sales;
    $this->notes = $notes;
    $this->subtasks = $tasks;
    $this->invoices = $invoices;
    $this->workflows = $workflows;
    $this->companies = $companies;
    $this->activities = $activities;
    $this->services = $services;
    $this->products = $products;
  }
  /**
  * Display a listing of the resource that are accepted.
  *
  * @return \Illuminate\Http\Response
  */
  public function index(Request $request)
  {
    $companies = $this->companies->team_companies(Auth::user()->team_id);
    $company_options = array();
    foreach($companies as $company)
    {
      $company_options[$company->id] = $company->name;
    }
    $team_members = $request->user()->team->members;
    $team_member_options = array();

    foreach($team_members as $member) {
      $team_member_options[$member->id] = $member->name;
    }

    $status_options = $this->sales->status_options();

    return view('sales.index',[
      'sales' => $this->sales->get_sales($request->user()->team_id),
      'leads' => $this->sales->leads($request->user()->team_id),
      'accepted' => $this->sales->accepted($request->user()->team_id),
      'rejected' => $this->sales->rejected($request->user()->team_id),
      'title' => 'Sales',
      'company_options' => $company_options,
      'team_member_options' => $team_member_options,
      'status_options' => $status_options,
    ]);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $sale = new Sale;
    $products = $this->products->team_products(Auth::user()->team_id);
    $services = $this->services->team_services(Auth::user()->team_id);

    return view('sales.create', [
      'sale' => $sale,
      'products' => $products,
      'services' => $services,
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
      'name' => 'required|max:255',
      'company_id' => 'required',
      'assigned_to_user_id' => 'required',
    ]);

    $sale = new Sale;

    if ($request->has('parent_id'))
    {
      $sale->company_id = $request->parent_id;
    }

    $sale->name = $request->name;
    $sale->status = $request->status;
    $sale->product = $request->product;
    $sale->amount = $request->amount;
    $sale->start_date = $request->start_date;
    $sale->close_date = $request->close_date;
    $sale->team_id = $request->user()->team_id;
    $sale->assigned_to_user_id = $request->assigned_to_user_id;

    $sale->save();

    $user = Auth::user();
    $team_members = $user->team->members;
    $to = array();
    foreach ($team_members as $member)
    {
      array_push($to, $member->email);
    }

    Mail::send('emails.new_lead',
    [
      'item' => $sale,
      'notes' => $this->notes->get_notes($sale->id, 'Sale'),
    ],
    function ($m) use ($to, $sale) {
      $m->from('noreply@jexly.net', 'Jexly');

      $m->to($to)->subject('Jexly - New Lead - '.$sale->name);
    });

    return Redirect::back();


  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show(Request $request, $id)
  {
    $request->session()->put('return_url', $request->path());
    $team_members = Auth::user()->team->members;
    $team_member_options = array();

    foreach($team_members as $member) {
      $team_member_options[$member->id] = $member->name;
    }

    $sale = Sale::findOrFail($id);
    return view('sales.view', [
      'sale' => $sale,
      'notes' => $this->notes->get_notes($id, 'Sale'),
      'parent' => $sale,
      'parent_type' => 'Sale',
      'subtasks' => $this->subtasks->sub_tasks($id, 'Sale'),
      'invoices' => $this->invoices->sale_invoices($id),
      'workflows' => $this->workflows->get_workflows($id, 'Sale'),
      'team_members' => $team_member_options,
      'activities' => $this->activities->get_activities($id, 'Sale'),
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
    $team_members = Auth::user()->team->members;
    $team_member_options = array();

    foreach($team_members as $member) {
      $team_member_options[$member->id] = $member->name;
    }
    $companies = $this->companies->team_companies(Auth::user()->team_id);
    $company_options = array();
    foreach($companies as $company)
    {
      $company_options[$company->id] = $company->name;
    }

    $sale = Sale::findOrFail($id);
    $status_options = array(
      'Pending' => 'Pending',
      'Awaiting Customer Response' => 'Awaiting Customer Response',
      'Proposal' => 'Proposal',
      'Accepted' => 'Accepted',
      'Rejected' => 'Rejected',
      'Completed' => 'Completed',
    );
    return view('sales.edit', [
      'sale' => $sale,
      'team_member_options' => $team_member_options,
      'status_options' => $status_options,
      'company_options' => $company_options,
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
        'name' => 'required|max:255',
    ]);

    $sale = Sale::findOrFail($id);

    $sale->company_id = $request->company_id;
    $sale->name = $request->name;
    $sale->status = $request->status;
    $sale->amount = $request->amount;
    $sale->assigned_to_user_id = $request->assigned_to_user_id;
    $sale->start_date = $request->start_date;
    $sale->close_date = $request->close_date;

    $sale->save();

    return redirect($request->session()->get('return_url'));


  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy(Request $request, Sale $sale)
  {
    $this->authorize('destroy', $sale);
    $sale->delete();
    return Redirect::back();
  }

  //CUSTOM FUNCTIONS

  /**
  * Return the resources that are in 'lead' status
  */

  public function leads(Request $request)
  {
    $companies = $this->companies->team_companies(Auth::user()->team_id);
    $company_options = array();
    foreach($companies as $company)
    {
      $company_options[$company->id] = $company->name;
    }
    $team_members = $request->user()->team->members;
    $team_member_options = array();

    foreach($team_members as $member) {
      $team_member_options[$member->id] = $member->name;
    }
    $status_options = $this->sales->status_options();
    return view('sales.index',[
      'sales' => $this->sales->leads($request->user()->team_id),
      'title' => 'Leads',
      'company_options' => $company_options,
      'team_member_options' => $team_member_options,
      'status_options' => $status_options,
    ]);
  }

  /**
  * Return the resources that are in 'lead' status
  */

  public function rejected(Request $request)
  {
    $companies = $this->companies->team_companies(Auth::user()->team_id);
    $company_options = array();
    foreach($companies as $company)
    {
      $company_options[$company->id] = $company->name;
    }
    $team_members = $request->user()->team->members;
    $team_member_options = array();

    foreach($team_members as $member) {
      $team_member_options[$member->id] = $member->name;
    }
    $status_options = $this->sales->status_options();
    return view('sales.index',[
      'sales' => $this->sales->rejected($request->user()->team_id),
      'title' => 'Lost Sales',
      'company_options' => $company_options,
      'team_member_options' => $team_member_options,
      'status_options' => $status_options,
    ]);
  }

  public function accepted(Request $request)
  {
    $companies = $this->companies->team_companies(Auth::user()->team_id);
    $company_options = array();
    foreach($companies as $company)
    {
      $company_options[$company->id] = $company->name;
    }
    $team_members = $request->user()->team->members;
    $team_member_options = array();

    foreach($team_members as $member) {
      $team_member_options[$member->id] = $member->name;
    }
    $status_options = $this->sales->status_options();
    return view('sales.index', [
      'sales' => $this->sales->accepted($request->user()->team_id),
      'title' => 'Won Sales',
      'company_options' => $company_options,
      'team_member_options' => $team_member_options,
      'status_options' => $status_options,
    ]);
  }

  public function dashboard(Request $request)
  {
    return view ('sales.dashboard', [
      'open_sales' => count($this->sales->open_sales($request->user()->team_id)),
      'won_sales' => count($this->sales->accepted($request->user()->team_id)),
      'lost_sales' => count($this->sales->rejected($request->user()->team_id)),
      'title' => 'Sales Dashboard',
    ]);
  }

  public function pipeline(Request $request)
  {
    return view('sales.pipeline_index', [
      'pending_sales' => $this->sales->by_status('Pending'),
      'awaiting_customer_sales' => $this->sales->by_status('Awaiting Customer Response'),
      'proposal_sales' => $this->sales->by_status('Proposal'),
      'accepted_sales' => $this->sales->by_status('Accepted'),
      'rejected_sales' => $this->sales->by_status('Rejected'),
    ]);
  }



}
