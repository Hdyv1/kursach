<?php

namespace App\Http\Controllers;

use App\Models\RepairOrder;
use App\Models\Device;
use App\Http\Requests\StoreRepairOrderRequest;
use App\Http\Requests\UpdateRepairOrderRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\RepairOrderService;

class RepairOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        return response()->json(RepairOrder::with(['device', 'services', 'reviews'])->get());
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRepairOrderRequest $request)
    {
        $device = new Device();
        $device->user_id = Auth::id();
        $device->type = $request->type;
        $device->brand = $request->brand;
        $device->model = $request->model;
        $device->problem_description = $request->description;
        $device->save();
        $order = new RepairOrder();
        $order->user_id = Auth::id();
        $order->device_id = $device->id;
        $order->description = $request->description;
        $order->client_name = $request->client_name;
        $order->client_phone = $request->client_phone;
        $order->client_email = $request->client_email;
        $order->save();
        return response()->json(['message' => 'Заявка отправлена', 'order_id' => $order->id, 'device_id' => $device->id], 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(RepairOrder $order)
    {
        return response()->json($order->with(['device', 'services', 'reviews'])->first());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RepairOrder $repairOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRepairOrderRequest $request, RepairOrder $order)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        if($request->status!== 'done' && $request->status !== 'in_progress' && $request->status !== 'pending') {
            return response()->json(['error' => 'Неверный статус'], 422);
        }
        $order->update($request->all());
        return response()->json(['message' => 'Заявка обновлена', 'order_id' => $order->id], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RepairOrder $repairOrder)
    {
        //
    }
}
