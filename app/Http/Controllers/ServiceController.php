<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        return response()->json(Service::all());
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
    public function store(StoreServiceRequest $request)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $service = Service::create($request->all());
        return response()->json(['message' => 'Услуга создана', 'service_id' => $service->id], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($service_id)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $service = Service::where('id', $service_id)->first();
        if (!$service) {
            return response()->json(['error' => 'Услуга не найдена'], 404);
        }
        return response()->json($service, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, $service_id)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $service = Service::where('id', $service_id)->first();
        if (!$service) {
            return response()->json(['error' => 'Услуга не найдена'], 404);
        }
        $service->update($request->all());
        return response()->json(['message' => 'Услуга обновлена', 'service' => $service], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($service_id)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $service = Service::where('id', $service_id)->first();
        if (!$service) {
            return response()->json(['error' => 'Услуга не найдена'], 404);
        }
        $service->delete();
        return response()->json(['message' => 'Услуга удалена'], 200);
    }
}
