<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CareerController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/career",
     *     tags={"Career"},
     *     summary="Career",
     *     description="Career",
     *     operationId="career",
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

        $tmp = Career::all();

        if ($locale === $default_locale) {
            $data[] = (object)[
                'title' => $tmp[0]['title'],
                'motto' => $tmp[0]['motto'],
                'text' => $tmp[0]['text'],
                'image' => str_replace('\\', '/', $tmp[0]['image']),
                'hh_link' => $tmp[0]['hh_link']
            ];
        } else {
            $tmp->load('translations');
            $translations = json_decode($tmp[0]->translations, true);

            $data[] = (object)[
                'title' => $translations[2]['value'],
                'motto' => $translations[0]['value'],
                'text' => $translations[1]['value'],
                'image' => str_replace('\\', '/', $tmp[0]['image']),
                'hh_link' => $tmp[0]['hh_link']
            ];
        }

        return response()->json(['status' => 200, 'data' => $data]);
    }
}
