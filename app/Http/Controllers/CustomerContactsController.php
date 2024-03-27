<?php

namespace App\Http\Controllers;

use App\Models\CustomerContacts;
use Illuminate\Http\Request;

class CustomerContactsController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/customer_contacts",
     *     tags={"Customer contacts"},
     *     summary="Submit a new customer contact query",
     *     description="Allows submission of a new contact query with contact information.",
     *     operationId="addCustomerContact",
     *     @OA\Parameter(
     *         name="Accept-Language",
     *         in="header",
     *         required=false,
     *         description="Language preference (e.g., 'uz', 'ru').",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         description="Contact Information",
     *         required=true,
     *        @OA\JsonContent(
     *             required={"full_name", "phone_number", "email"},
     *             @OA\Property(property="full_name", type="string", example="John Doe"),
     *             @OA\Property(property="phone_number", type="string", example="+1234567890"),
     *             @OA\Property(property="email", type="string", format="email", example="john.doe@example.com")
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
        //
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $incomingFields = $request->validate([
            'full_name' => 'required',
            'phone_number' => 'required',
            'email' => ['required', 'email']
        ]);

        $incomingFields['full_name'] = strip_tags($request['full_name']);
        $incomingFields['phone_number'] = strip_tags($request['phone_number']);
        $incomingFields['email'] = strip_tags($request['email']);

        try {
            CustomerContacts::create($incomingFields);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }


        return response()->json(['status' => 200, 'message' => 'Success']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\CustomerContacts $customerContacts
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerContacts $customerContacts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\CustomerContacts $customerContacts
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerContacts $customerContacts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CustomerContacts $customerContacts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerContacts $customerContacts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\CustomerContacts $customerContacts
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerContacts $customerContacts)
    {
        //
    }
}
