<?php

namespace Modules\UserModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\UserModule\Http\Requests\DeleteVechileRequest;
use Modules\UserModule\Http\Requests\UpdateCheckVechileRequest;
use Modules\UserModule\Http\Requests\VechileRequest;
use Modules\UserModule\Http\Resources\VechileResource;
use Modules\UserModule\Services\VechileService;

class VechileController extends Controller
{
    private $VechileService;
    public function __construct(VechileService $VechileService) {
        $this->VechileService = $VechileService;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $vechile = VechileResource::collection($this->VechileService->getallvechiles($request->page_size));
        return response()->json($vechile,200);
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
    public function store(VechileRequest $request)
    {
        $vechile = new VechileResource($this->VechileService->createVechile($request->validated()));
        return response()->json([
            "message"=>"data stored successfully",
            "status"=>"success",
            "data"=>$vechile
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
    public function update(UpdateCheckVechileRequest $request, $id)
    {
        $vechile = new VechileResource($this->VechileService->updateVechile($request->all(),$id));

        return response()->json([
            "message"=>"data updated successfully",
            "status"=>"success",
            "data"=>$vechile
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(DeleteVechileRequest $request,$id)
    {
        $vechile = $this->VechileService->deleteVechile($id);
        return response()->json([
            "message"=>"data deleted successfully",
            "status"=>"success",
            "data"=>$vechile
        ],200);
    }
}
