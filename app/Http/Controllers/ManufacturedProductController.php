<?php

namespace App\Http\Controllers;

use App\Models\ManufacturedProduct;
use App\Models\Preorder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Mail\ProcureRawMaterialsMail;
use Illuminate\Support\Facades\Mail;

class ManufacturedProductController extends Controller
{
    public function index()
    {
        $manufact_products = ManufacturedProduct::orderBy('id', 'desc')->get();

        if (!$manufact_products) {
            return response()->json([
                'status' => 404,
                'message' => 'not_found'
            ]);
        }

        return response()->json($manufact_products);
    }


    // store
    public function store(Request $request)
    {

        // $validateData = $request->validate([
        //     'product_id' => 'required',
        //     'raw_material_id' => 'required',
        //     'product_price' => 'required',
        //     'total_quantity' => 'required',
        //     'release_date' => 'required',
        // ]);

        $manufact_product = ManufacturedProduct::create($request->all());

        return response()->json($manufact_product);
    }


    // edit
    public function show($id)
    {
        $manufact_product = ManufacturedProduct::where('id', $id)->with('product', 'raw')->first();

        if (!$manufact_product) {
            return response()->json([
                'status' => 404,
                'message' => 'not_found'
            ]);
        }

        return response()->json($manufact_product);
    }



    // update
    public function update(Request $request, $id)
    {
        // $validateData = $request->validate([
        //     'product_id' => 'required',
        //     'raw_material_id' => 'required',
        //     'product_price' => 'required',
        //     'total_quantity' => 'required',
        //     'release_date' => 'required',
        // ]);

        $manufact_product = ManufacturedProduct::find($id);

        if (!$manufact_product) {
            return response()->json([
                'status' => 200,
                'message' => 'something_wrong',
            ]);
        }


        $manufact_product->update($request->all());
        return response()->json($manufact_product);
    }



    // delete
    public function destroy($id)
    {
        $manufact_product = ManufacturedProduct::find($id);
        if (!$manufact_product) {
            return response()->json([
                'status' => 404,
                'message' => 'not_found',
            ]);
        }
        $manufact_product->delete();

        return response()->json([
            'message' => 'deleted',
        ]);
    }

    public function checkValidAndConfirmPreorder(Request $request){
        $data = ManufacturedProduct::where('product_id',$request->productId)
                ->groupBy('product_id')
                ->selectRaw('*, sum(total_quantity) as totalQuantity')
                ->get();

        $preorder = Order::where('id',$request->orderId)->first();
        $preorderQuantity = explode('_',$preorder->box_pcs)[0];


        if($data['totalQuantity']>$preorderQuantity){
            Order::where('id',$request->orderId)->update(['status','confirmed']);
            $validProducts = ManufacturedProduct::where('product_id',$request->productId)
            ->select('total_quantity','release_date')
            ->orderBy('created_at','asc')
            ->get();
foreach($validProducts as $product){
                if($product->total_quantity > $preorderQuantity){
                   $updatedValidProductsQuantity = $product->total_quantity - $preorderQuantity;
                   $products = ManufacturedProduct::where('product_id',$request->productId)[0]->update(['total_quantity',$updatedValidProductsQuantity]);
                   return;
                }
                if($product->total_quantity < $preorderQuantity){
                    $updatedValidProductsQuantity =  $preorderQuantity - $product->total_quantity;
                    ManufacturedProduct::where('release_date',$product['release_date'])->update([
                        "deleted_at"=>Carbon::now()
                    ]);
                }
            }
        }


    }


    public function checkStock(Request $request){
        $productTotalCount = ManufacturedProduct::where('product_id',$request->productId)->groupBy('product_id')->selectRaw('sum(total_quantity) as totalQuantity')->get();

        if($productTotalCount<500){
            $this->sendToProcureRawsEmail($request->staffEmail);
        }

    }

    private function sendToProcureRawsEmail($email)
    {
        $title = 'Dear Factory';
        $body = 'One of our products\' stock is currently under 500 boxes right now.There is an urgent need for some things/items in our office. The details of which are as follows. (Write your stuff here, you can also specify your item specification here). You are requested to provide all the above items as soon as possible to avoid interruption in our work.';


        Mail::to($email)->send(new ProcureRawMaterialsMail($title, $body));

        return "Email sent successfully!";
    }
}
