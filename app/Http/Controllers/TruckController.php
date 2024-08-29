<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Truck;
use App\Trucks_Users_Day;
use App\Work_Order;

class TruckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trucks = Truck::all();
        $truck = new Truck;

        return view('trucks.index', [
          'trucks' => $trucks,
          'truck' => $truck,
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
        'name' => 'required',
      ]);

      $truck = new Truck;
      $truck->name = $request->name;
      $truck->save();
      return redirect()->route('truck.index');
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
    public function destroy($id)
    {
      $truck = Truck::findOrFail($id);
      $truck->delete();
      return redirect()->route('truck.index');
    }

    public function assign_user_to_day(Request $request)
    {
      $truck = Truck::findOrFail($request->truck_id);
      $date = $request->date;
      $user_id = $request->user_id;

      $tud = Trucks_Users_Day::where('date', $date)->where('truck_id', $truck->id)->get();
      if (count($tud) > 0 )
      {
        foreach($tud as $t)
        {
          $t->delete();
        }
      }

      if ($request->user_id != 0) {
        $new_tud = new Trucks_Users_Day;
        $new_tud->truck_id = $truck->id;
        $new_tud->user_id = $user_id;
        $new_tud->date = $date;
        $new_tud->save();
      }

      $wos = Work_Order::where('truck_id', $truck->id)->where('appointment_date', $date)->get();
      //dd($wos);
      foreach($wos as $wo) {
        $wo->assigned_to = $user_id;
        $wo->save();
      }
      return redirect('work_order/schedule');

    }

    public function hide(Request $request, $id) 
    {
        $truck = Truck::findOrFail($id);
        if ($truck->hidden) {
          $truck->hidden = false;
        } else {
          $truck->hidden = true;
        }

        $truck->save();

        return redirect()->route('truck.index');
    }
}
