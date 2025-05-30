<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use App\Models\ServiceOrder;
use App\Models\ServiceOrderItem;
use Illuminate\Support\Facades\Auth;
class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render("Invoice/Invoice");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $services = Service::all();
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
         return Inertia::render("Invoice/Invoice",[
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
                   $countToday = ServiceOrder::whereDate('created_at', today())->count() + 1;
                   $voucher_no = $datePrefix . '-' . str_pad($countToday, 4, '0', STR_PAD_LEFT);
                   $orderId =  ServiceOrder::create([
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
                        $data = ServiceOrderItem::create([
                            "service_order_id" => $orderId,
                            "service_id" => $item["name"],
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
        
       // return redirect("invoice/create");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = ServiceOrder::find($id);
        $items = $order->serviceitems;
        $type = "service";
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
