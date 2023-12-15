<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Exports\OrderInformationExport;
use Maatwebsite\Excel\Facades\Excel;

class DeliveryController extends Controller
{
    public function index() {
        $deliveries = Delivery::orderBy('delivery_date','asc')->with('truck')->get();
        return response()->json($deliveries);
    }

     public function changeStatus(Request $request)
    {
        $data = Delivery::where('id', $request->id)->first();
        $preorder = Order::where("id",$request->preorder_id)->first();

        if (!$data) {
            return response()->json([
                'status' => 500,
                'message' => 'internal_server'
            ]);
        }

        $preorder->update([
            "deleted_at"=>Carbon::now()
        ]);

        $data->update([
            'status' => $request->status
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'success'
        ]);
    }

    public function store(Request $request){

        $delivery = Delivery::create($request->all());
        return response()->json($delivery);
    }

    public function export()
    {
        return Excel::download(new OrderInformationExport, 'delivery_pending_list_with_delivery_date.xlsx');
    }

}
