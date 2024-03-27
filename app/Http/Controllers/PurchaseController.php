<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/purchase",
     *     tags={"Purchase"},
     *     summary="Purchase",
     *     description="Purchase",
     *     operationId="purchase",
     *     @OA\Parameter(
     *         name="Accept-Language",
     *         in="header",
     *         description="Set language parameter by typing uz, ru",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example="200"),
     *             @OA\Property(property="data",type="object")
     *          )
     *       )
     * )
     */
    public function index()
    {
        $default_locale = 'ru';
        $locale = app()->getLocale();

        $tmp = Purchase::all();
//        Log::info($tmp);

        if ($locale === $default_locale) {
            $data[] = (object)[
                'title' => $tmp[0]['title'],
                'text' => $tmp[0]['text']
            ];
        } else {
            $tmp->load('translations');
            $translations = json_decode($tmp[0]->translations, true);

            $data[] = (object)[
                'title' => $translations[1]['value'],
                'text' => $translations[0]['value']
            ];
        }

        return response()->json(['status' => 200, 'data' => $data]);
    }
}
