<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Truck;
use Illuminate\Http\Request;

class TruckController extends Controller
{

    public function index(){
        $trucks = Truck::paginate(6);
        return response()->json($trucks);
    }
    public function create(Request $request)
    {
        // $truck = Truck::create($request->all());
        // return response()->json($truck, 201);

        $validatedData = $request->validate([
            'trackNum' => 'required',
            'box_pcs' => 'required|string|unique:trucks|max:20',
            'staff_id' => 'required',

        ]);
    
        
        $truck = Truck::create($validatedData);
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
        $truck->update($request->all());
        return response()->json($truck, 200);
    }

    public function destroy($id)
    {
        Truck::findOrFail($id)->delete();
        return response()->json('Truck deleted successfully', 200);
    }

    // public function store(Request $request){
    //       $truck = new Truck();
    //       $truck->trackNum = $request->name;
    //       $truck->staff_id = Staff::staff();
    //       $truck->capacity = $request->capacity;
          

    // }
}
