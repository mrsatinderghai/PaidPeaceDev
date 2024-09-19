<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Zip_Code_Area;

class ZipCodeAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zcas = array();
        $areas = ['nw', 'n', 'ne', 'w', 'c', 'e', 'sw', 's', 'se'];
        foreach($areas as $area) {
            $zcas[$area] = Zip_Code_Area::where('area', $area)->get();
        }
        $area_select = [
            'NE' => 'NE',
            'N' => 'N', 
            'NW' => 'NW',
            'E' => 'E',
            'C' => 'C',
            'W' => 'W',
            'SE' => 'SE',
            'S' => 'S',
            'SW' => 'SW',
        ];

        return view('zip_code_areas.index', [
            'zcas' => $zcas,
            'areas' => $areas,
            'area_select' => $area_select,
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
            'zip_code' => 'required|max:5',
            'area' => 'required',
        ]);

        Zip_Code_Area::create([
            'zip_code' => $request->zip_code,
            'area' => $request->area,
        ]);

        return redirect()->route('zipcodearea.index');
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

    public function color_by_zip(Request $request)
    {
        $area = null;
        $zip = $request->zip;
        $zca = Zip_Code_Area::where('zip_code', $zip)->first();
        if (! is_null($zca)) {
            $area = $zca->area;
            $color = $this->color_by_area($area);
            return $color;
        }
        return 'white';
    }

    public function color_by_area($area)
    {
      if ($area == 'E') {
        return 'green';
      } elseif ($area == 'NW') {
        return 'yellow';
      } elseif ($area == 'N') {
        return 'deepskyblue';
      } elseif ($area == 'NE') {
        return 'red';
      } elseif ($area == 'W') {
        return 'hotpink';
      } elseif ($area == 'C') {
        return 'lightsteelblue';
      } elseif ($area == 'SW') {
        return 'orange';
      } elseif ($area == 'S') {
        return 'purple';
      } elseif ($area == 'SE') {
        return 'tan';
      } else {
        return 'white';
      }
    }
}
