<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;
use App\Http\Resources\ServiceResource;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ServiceResource::collection(Service::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        $validated = $request->safe()->all();
        $service = Service::create($validated);
        return (new ServiceResource($service))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return new ServiceResource($service);
    }

    public function update(UpdateServiceRequest $request, Service $service)
    {
        $validated = $request->safe()->all();
        $service->update($validated);
        return new ServiceResource($service);
    }

    public function destroy(Service $service) 
    {
        $service->delete();
        return response()->noContent();
    }

   
}
