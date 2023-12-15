<?php

namespace App\Http\Controllers;

use App\Models\Preorder;
use App\Models\Truck;
use Illuminate\Http\Request;

class TruckController extends Controller
{
    public function index(){
        return Truck::filter(request(['staff','search']))->get();
    }

    public function getTrucks(){
        $trucks = Truck::orderBy('id', 'desc')->get();
        return response()->json($trucks);
    }

    public function store(Request $request)
    {

        // $validatedData = $request->validate([
        //     'track_number' => 'required',
        //     'track_name' => 'required',
        //     'capacity' => 'required',
        //     'staff_id' => 'required',

        // ]);

        $truck = Truck::create($request->all());
        return response()->json($truck, 201);
    }

    public function show($id)
    {
        $truck = Truck::findOrFail($id);
        return response()->json($truck);
    }

    public function update(Request $request, $id)
    {
        $truck = Truck::findOrFail($id);
        $validatedData = $request->validate([
            'track_number' => 'required',
            'track_name' => 'required',
            'capacity' => 'required',
            'staff_id' => 'required',

        ]);
        $truck->update($validatedData);

        return response()->json($truck, 200);

    }



    public function destroy($id)
    {
            Truck::findOrFail($id)->delete();
            return response()->json('Truck deleted successfully', 200);
    }

    public function AssignTruck(Request $request){
        $assignTrucks = [];

        $trucks = Truck::get();

        foreach($trucks as $truck){
            if($truck->capacity > $request->totalQuantity){
                array_push($assignTrucks,$truck);
                return response()->json($assignTrucks);
            }
            return;
        }
    }


}
