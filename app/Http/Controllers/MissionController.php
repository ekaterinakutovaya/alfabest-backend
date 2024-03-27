<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/mission",
     *     tags={"Mission"},
     *     summary="Mission",
     *     description="Mission",
     *     operationId="mission",
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

        $tmp = Mission::all();
        $tmp->load('translations');

        if ($locale === $default_locale) {
            $data[] = (object)[
                'title' => $tmp[0]['title'],
                'text' => $tmp[0]['text'],
                'moto' => $tmp[0]['moto']
            ];
        } else {
            $tmp->load('translations');
            $translations = json_decode($tmp[0]->translations, true);

            $data[] = (object)[
                'title' => $translations[2]['value'],
                'text' => $translations[1]['value'],
                'moto' => $translations[0]['value']
            ];
        }

        return response()->json(['status' => 200, 'data' => $data]);
    }
}
