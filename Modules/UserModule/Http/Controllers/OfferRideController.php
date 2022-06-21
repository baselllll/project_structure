<?php

namespace Modules\UserModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\UserModule\Http\Requests\DeleteOfferRideRequest;
use Modules\UserModule\Http\Requests\OfferRideRequest;
use Modules\UserModule\Http\Requests\UpdateCheckOfferRideRequest;
use Modules\UserModule\Http\Requests\VechileRequest;
use Modules\UserModule\Http\Resources\OfferRideServiceResource;
use Modules\UserModule\Http\Resources\VechileResource;
use Modules\UserModule\Services\OfferRideService;

class OfferRideController extends Controller
{
    private $OfferRideService;
    public function __construct(OfferRideService $OfferRideService) {
        $this->OfferRideService = $OfferRideService;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $OfferRideService = OfferRideServiceResource::collection($this->OfferRideService->getallofferRide($request->page_size));
        return response()->json($OfferRideService,200);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(OfferRideRequest $request)
    {
        $vechile = new OfferRideServiceResource($this->OfferRideService->createofferRide($request->validated()));
        return response()->json($vechile,200);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('usermodule::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('usermodule::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateCheckOfferRideRequest $request,OfferRideRequest $offerRequest, $id)
    {
        $offer_ride = new OfferRideServiceResource($this->OfferRideService->updateofferRide($offerRequest->validated(),$id));
        return response()->json($offer_ride,200);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(DeleteOfferRideRequest $request,$id)
    {
        $offer_ride = $this->OfferRideService->deleteofferRide($id);
        return response()->json($offer_ride,200);
    }
}
