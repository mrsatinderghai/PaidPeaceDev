<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class Time_Slot_LockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    public function lock($date, $truck_id, $time_slot, $action){
        dd('got here!');
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
}
