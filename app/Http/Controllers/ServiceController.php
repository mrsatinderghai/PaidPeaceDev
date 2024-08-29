<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\ServiceRepository;
use App\Service;
use Auth;

class ServiceController extends Controller
{


  public function __construct(ServiceRepository $services)
  {
    $this->middleware('auth');
    $this->services = $services;
  }
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $services = $this->services->team_services(Auth::user()->team_id);

    return view('services.index', [
      'service' => new Service,
      'services' => $services,
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
      'category' => 'required',
      'description' => 'required',
      'cost' => 'required',
      'sell_price' => 'required'
    ]);

    $service = new Service;
    $service->team_id = Auth::user()->team_id;
    $service->category = $request->category;
    $service->description = $request->description;
    $service->cost = $request->cost;
    $service->sell_price = $request->sell_price;
    $service->save();
    return redirect()->route('service.index');
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
    $service = Service::findOrFail($id);

    return view('services.edit', [
      'service' => $service,
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
    $service = Service::findOrFail($id);

    $service->description = $request->description;
    $service->category = $request->category;
    $service->cost = $request->cost;
    $service->sell_price = $request->sell_price;

    if ($request->is_retired) {
      $service->is_retired = 1;
    }

    $service->save();

    return redirect()->route('service.index');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $service = Service::findOrFail($id);
    $service->delete();
    return redirect()->route('service.index');
  }

  public function retire($id)
  {
    $service = Service::findOrFail($id);
    $service->is_retired = True;
    $service->save();
    
    return redirect()->route('service.index');
  }

  public function get_sell_price(Request $request)
  {
    $service = Service::findOrFail($request->id);
    return $service->sell_price;
  }
}
