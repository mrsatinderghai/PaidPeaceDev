<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\ContactRepository;
use App\Models\Contact;
use Illuminate\Support\Facades\Redirect;
use App\Repositories\NoteRepository;



class ContactController extends Controller
{

    protected $contacts;


    public function __construct(ContactRepository $contacts, NoteRepository $notes)
    {
        $this->middleware('auth');
        $this->contacts = $contacts;
        $this->notes = $notes;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('contacts.index', [
            'contacts' => $this->contacts->team_contacts($request->user()->team_id),
            'title' => 'Contacts',
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

        $contact = new Contact;

     if ($request->has('parent_id')) 
        {
            $contact->company_id = $request->parent_id;
        }

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->cell_phone = $request->cell_phone;
        $contact->title = $request->title;
        $contact->team_id = $request->user()->team_id;

        $contact->save();

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
        $contact = Contact::findOrFail($id);
        return view('contacts.view', [
                'contact' => $contact,
                'notes' => $this->notes->get_notes($id, 'Contact'),
                'parent' => $contact,
                'parent_type' => 'Contact',
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
    public function destroy(Request $request, Contact $contact)
    {
        // $this->authorize('destroy', $contact);
        $contact->delete();
        return Redirect::back();
    }
}
