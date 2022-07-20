<?php

namespace Modules\UserModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\UserModule\Http\Requests\ResetPasswordRequest;
use Modules\UserModule\Http\Requests\OfferRideRequest;
use Modules\UserModule\Http\Requests\searchOnRideOfferRequest;
use Modules\UserModule\Http\Requests\UpdateCheckOfferRideRequest;
use Modules\UserModule\Http\Requests\UpdateMessageRequest;
use Modules\UserModule\Http\Requests\UpdateStatusRequest;
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
        $OfferRideService = new OfferRideServiceResource($this->OfferRideService->createofferRide($request->all()));
        return response()->json(
            [
                "message"=>"data stored successfully",
                "status"=>"success",
                "data"=>$OfferRideService
            ],200);
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
        $offer_ride = new OfferRideServiceResource($this->OfferRideService->updateofferRide($offerRequest->all(),$id));
        return response()->json([
                "message"=>"data updated successfully",
                "status"=>"success",
                "data"=>$offer_ride
            ],200);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $offer_ride = $this->OfferRideService->deleteofferRide($id);
        return response()->json([
            "message"=>"data deleted successfully",
            "status"=>"success",
            "data"=>$offer_ride
        ],200);
    }

    public function searchOnRideOffer(searchOnRideOfferRequest $request)
    {

        $offer_ride = $this->OfferRideService->searchOnRideOffer($request->validated());
        return response()->json([
            "message"=>"data getting successfully",
            "status"=>"success",
            "data"=>$offer_ride
        ],200);
    }

    public function updateStatusRideOffer(UpdateStatusRequest $request,$offer_ride_id){
        $offer_ride = $this->OfferRideService->updateStatusRideOffer($offer_ride_id,$request->validated());
        return response()->json([
            "message"=>"data updated successfully",
            "status"=>"success",
            "data"=>$offer_ride
        ],200);
    }
    public function  updateMessageOnRideOffer(UpdateMessageRequest $request,$offer_ride_id){
        $offer_ride = $this->OfferRideService->updateMessageOnRideOffer($offer_ride_id,$request->validated());
        return response()->json([
            "message"=>"data updated successfully",
            "status"=>"success",
            "data"=>$offer_ride
        ],200);
    }
}
