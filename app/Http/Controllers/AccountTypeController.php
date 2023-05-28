<?php

namespace App\Http\Controllers;

use App\Models\AccountTypes;
use Illuminate\Http\Request;
use App\Http\Helpers\APIHelpers;
use App\Http\Resources\AccountTypeResource;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class AccountTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $accountTypes = AccountTypes::all();
            $code = Response::HTTP_OK;
            $message = $accountTypes->count() . " Account Types Found!";
            $response = APIHelpers::createAPIResponse(false, $code, $message, AccountTypeResource::collection($accountTypes)->response()->getData(true));
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
        return "connection successfuly";
        try {
            $validated = $request->validate([
                'name' => 'required|unique:posts|max:255',
                'description' => 'required',
            ]);

            $accountTypes = AccountTypes::create($request->all());


            $code = Response::HTTP_CREATED;
            $message = "Account Types added Successfully!";
            $response = APIHelpers::createAPIResponse(false, $code, $message, new AccountTypeResource($accountTypes));
        } catch (QueryException $exception) {
            $code = $exception->getCode();
            $message = $exception->getMessage();
            $response = APIHelpers::createAPIResponse(true, $code, $message, null);
        }
        return new JsonResponse($response, Response::HTTP_OK);
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
