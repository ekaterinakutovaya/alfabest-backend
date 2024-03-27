<?php

namespace App\Http\Controllers;

use App\Models\ServiceQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ServiceQueryController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/services_query",
     *     tags={"Services Query"},
     *     summary="Submit a new service query",
     *     description="Allows submission of a new service query with service details and contact information.",
     *     operationId="servicesQuery",
     *     @OA\Parameter(
     *         name="Accept-Language",
     *         in="header",
     *         required=false,
     *         description="Language preference (e.g., 'uz', 'ru').",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         description="Service Query Details",
     *         required=true,
     *         @OA\JsonContent(
     *             required={"services_id", "full_name", "phone_number"},
     *             @OA\Property(property="services_id", type="integer", example=1),
     *             @OA\Property(property="full_name", type="string", example="John Doe"),
     *             @OA\Property(property="phone_number", type="string", example="+1234567890")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=200),
     *             @OA\Property(property="message", type="string", example="Success")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=400),
     *             @OA\Property(property="message", type="string", example="Invalid input")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=500),
     *             @OA\Property(property="message", type="string", example="An unexpected error occurred")
     *         )
     *     )
     * )
     */
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $incomingFields = [];

        Log::info($request);

        $incomingFields['services_id'] = (int)$request['services_id'];
        $incomingFields['full_name'] = strip_tags($request['full_name']);
        $incomingFields['phone_number'] = strip_tags($request['phone_number']);

        ServiceQuery::create($incomingFields);
        return response()->json(['status' => 200, 'message' => 'Success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceQuery  $serviceQuery
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceQuery $serviceQuery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceQuery  $serviceQuery
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceQuery $serviceQuery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServiceQuery  $serviceQuery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServiceQuery $serviceQuery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceQuery  $serviceQuery
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceQuery $serviceQuery)
    {
        //
    }
}
