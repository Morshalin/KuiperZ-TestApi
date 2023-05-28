<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Http\Helpers\APIHelpers;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\AccountResource;
use Symfony\Component\HttpFoundation\Response;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $account = Account::with('accountType','branch')->get();
            $code = Response::HTTP_OK;
            $message = $account->count() . " account Found!";
            $response = APIHelpers::createAPIResponse(false, $code, $message, AccountResource::collection($account)->response()->getData(true));
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
        //return $request->all();
        try {
            $validated = $request->validate([
                'account_type_id' => 'required|exists:account_types,id',
                'branche_id' => 'required|exists:branches,id',
                'account_number' => 'required',
                'balance' => 'required',
                'status' => 'required',
            ]);

            $account = Account::create($request->all());


            $code = Response::HTTP_CREATED;
            $message = "Account added Successfully!";
            $response = APIHelpers::createAPIResponse(false, $code, $message, new AccountResource($account));
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
        try {
            $account = Account::findOrFail($id);
            $code = Response::HTTP_OK;
            $message ="Account Found!";
            $response = APIHelpers::createAPIResponse(false, $code, $message, new AccountResource($account));
        } catch (QueryException $exception) {
            $code = $exception->getCode();
            $message = $exception->getMessage();
            $response = APIHelpers::createAPIResponse(true, $code, $message, null);
        }

        return new JsonResponse($response, Response::HTTP_OK);
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
        //return $id;
        try {
            $validated = $request->validate([
                'account_type_id' => 'required|exists:account_types,id',
                'branche_id' => 'required|exists:branches,id',
                'account_number' => 'required',
                'balance' => 'required',
                'status' => 'required',
            ]);

            Account::findOrFail($id)->update($request->all());
            $account = Account::findOrFail($id);


            $code = Response::HTTP_CREATED;
            $message = "Account update Successfully!";
            $response = APIHelpers::createAPIResponse(false, $code, $message, new AccountResource($account));
        } catch (QueryException $exception) {
            $code = $exception->getCode();
            $message = $exception->getMessage();
            $response = APIHelpers::createAPIResponse(true, $code, $message, null);
        }
        return new JsonResponse($response, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //return $id;
        try {
            $account = Account::findOrFail($id);
            $isDeleted = $account->delete();
            $code = Response::HTTP_OK;
            $message = "account Deleted Successfully";
            $response = APIHelpers::createAPIResponse(false, $code, $message, null);
        } catch (QueryException $exception) {
            $code = $exception->getCode();
            $message = $exception->getMessage();
            $response = APIHelpers::createAPIResponse(true, $code, $message, null);
        }

        return new JsonResponse($response, Response::HTTP_OK);
    }
}
