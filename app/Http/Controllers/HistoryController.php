<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HistoryController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/history",
     *     tags={"History"},
     *     summary="History",
     *     description="History",
     *     operationId="history",
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

        $tmp = History::all();

        if ($locale === $default_locale) {
            foreach ($tmp as $key) {
                $data[] = (object)[
                    'year' => $key['year'],
                    'text' => $key['text'],
                    'image' => str_replace('\\', '/', $key['image'])
                ];
            }
        } else {
            $tmp->load('translations');

            foreach ($tmp as $key => $value) {
                $data[] = (object)[
                    'year' => $value['year'],
                    'text' => $value->translations[0]['value'],
                    'image' => str_replace('\\', '/', $value['image'])
                ];
            }
        }

        return response()->json(['status' => 200, 'data' => $data]);
    }
}
