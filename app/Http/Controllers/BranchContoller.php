<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Http\Helpers\APIHelpers;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\BrancheResource;
use App\Http\Resources\AccountTypeResource;
use Symfony\Component\HttpFoundation\Response;


class BranchContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $branch = Branch::all();
            $code = Response::HTTP_OK;
            $message = $branch->count() . " Account Types Found!";
            $response = APIHelpers::createAPIResponse(false, $code, $message, BrancheResource::collection($branch)->response()->getData(true));
        } catch (QueryException $exception) {
            $code = $exception->getCode();
            $message = $exception->getMessage();
            $response = APIHelpers::createAPIResponse(true, $code, $message, null);
        }

        return new JsonResponse($response, Response::HTTP_OK);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
