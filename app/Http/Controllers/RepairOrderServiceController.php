<?php

namespace App\Http\Controllers;

use App\Models\RepairOrderService;
use App\Http\Requests\StoreRepairOrderServiceRequest;
use App\Http\Requests\UpdateRepairOrderServiceRequest;
use App\Models\RepairOrder;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class RepairOrderServiceController extends Controller
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
        //
    }
    public function serviceAdd(RepairOrder $order, Service $service)
    {
        if(Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $order->final_price += $service->price;
        $order->save();
        $orderService = new RepairOrderService();
        $orderService->repair_order_id = $order->id;
        $orderService->service_id = $service->id;
        $orderService->save();
        return response()->json(['message' => 'Услуга добавлена', 'order_service_id' => $orderService->id], 200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRepairOrderServiceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(RepairOrderService $repairOrderService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RepairOrderService $repairOrderService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRepairOrderServiceRequest $request, RepairOrderService $repairOrderService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RepairOrder $order,RepairOrderService $service)
    {
        if(Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $order->final_price -= $service->price;
        $order->save();
        $service->delete();
        return response()->json(['message' => 'Услуга удалена'], 200);
    }
}
