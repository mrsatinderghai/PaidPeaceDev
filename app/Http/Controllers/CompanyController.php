<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\CompanyRepository;
use App\Company;
use App\Repositories\NoteRepository;
use App\Repositories\TaskRepository;
use App\Repositories\ContactRepository;
use App\Repositories\SaleRepository;
use Illuminate\Support\Facades\Redirect;

class CompanyController extends Controller
{

    protected $companies;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(CompanyRepository $companies, NoteRepository $notes, TaskRepository $tasks, ContactRepository $contacts, SaleRepository $sales)
    {
        $this->middleware('auth');
        $this->companies = $companies;
        $this->notes = $notes;
        $this->tasks = $tasks;
        $this->contacts = $contacts;
        $this->sales = $sales;
    }
    public function index(Request $request)
    {
        return view('companies.index', [
            'companies' => $this->companies->team_companies($request->user()->team_id),
            'title' => 'Customers',
        ]);
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
            'name' => 'required|max:255'
        ]);

        $request->user()->team->companies()->create([
            'name' => $request->name,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'phone' => $request->phone,
            'team_id' => $request->user()->team_id,
            'website' => $request->user()->website,
        ]);

        return redirect('/company');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::findOrFail($id);
        return view('companies.view', [
            'company' => $company,
            'notes' => $this->notes->get_notes($id, 'Company'),
            'subtasks' => $this->tasks->sub_tasks($id, 'Company'),
            'parent' => $company,
            'parent_type' => 'Company',
            'contacts' => $this->contacts->company_contacts($id),
            'sales' => $this->sales->company_sales($id),
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
    public function destroy(Request $request, Company $company)
    {
        $this->authorize('destroy', $company);
        $company->delete();
        return Redirect::back();
    }
}
