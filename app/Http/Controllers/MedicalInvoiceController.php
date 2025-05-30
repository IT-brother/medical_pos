<?php

namespace App\Http\Controllers;

use App\Models\Medical;
use App\Models\MedicalOrder;
use App\Models\MedicalOrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class MedicalInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Medical::all();
         if(count($services) > 0)
         {
            foreach($services as $service)
            {
                $options[] = ["value" => $service->id,"label" => $service->name];
            }
         }else
         {
            $options = [];
         }
         return Inertia::render("Invoice/MedicalInvoice",[
            "services" => $options
         ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            "patient"   => ['required'],
            'address'       => ['required'],
            'items' => 'required|array',
            'items.*.name' => 'required',
            'items.*.price' => ["required","numeric","min:0"],
            'items.*.quantity' => ["required","numeric","min:1"],
        ]);
       // dd($validateData);
        if(count($request->items) > 0)
        {
            DB::beginTransaction();
            try {
                   $datePrefix = now()->format('Ymd');
                   $countToday = MedicalOrder::whereDate('created_at', today())->count() + 1;
                   $voucher_no = $datePrefix . '-' . str_pad($countToday, 4, '0', STR_PAD_LEFT);
                   $orderId =  MedicalOrder::create([
                                "voucher_no" => $voucher_no,
                                "payment"  => $request->payment,
                                "discount" => $request->discount,
                                "foc" => $request->foc,
                                "date" => date("Y-m-d"),
                                "patient" => $request->patient,
                                "address" => $request->address,
                                "user_id" => Auth::user()->id
                   ])->id;
                    foreach($request->items as $key=>$item)
                    {
                        $data = MedicalOrderItem::create([
                            "medical_order_id" => $orderId,
                            "medical_id" => $item["name"],
                            "quantity" => $item["quantity"],
                            "price" => $item["price"]
                        ]);
                    }
                }catch(\Exception $e)
                {
                    DB::rollback();
                }
            DB::commit();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = MedicalOrder::find($id);
        $items = $order->medicalitems;
        $type = "medical";
        return view("service-orders.print",compact("order","items","type"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
