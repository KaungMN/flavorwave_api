<?php

namespace App\Http\Controllers;

use App\Models\RawMaterial;
use Illuminate\Http\Request;

class RawMaterialController extends Controller
{
    //
    public function store(Request $request){
        $raw_material = RawMaterial::create($request->all());
        return response()->json($raw_material);
    }

    public function getRaws(){
        $raws = RawMaterial::get();
        return response()->json($raws);
    }

    public function showRaw($id){
        $raw = RawMaterial::where("id",$id)->first();
        if(!$raw){
            return response()->json([
                "message"=>"Not Found"
            ]);
        }
        return response()->json($raw);

    }

    public function updateRaw(Request $request,$id){
        $raw = RawMaterial::find($id);
        if($raw){
            $updatedRaw = $raw->update($request->all());
            return response()->json($updatedRaw);
        }
        else{
            return response()->json(['message'=>'Something went wrong'],500);
        }
    }


    public function destroy($id){
       $deleteRaw = RawMaterial::find($id);
       if($deleteRaw){
        $deleteRaw->delete();
        return response()->json(['message'=>'raw material deleted successfully'],200);
       }
       else{
        return response()->json(['message'=>'Something went wrong'],500);
       }
    }
}
