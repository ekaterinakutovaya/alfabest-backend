<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VacancyController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/vacancy",
     *     tags={"Vacancy"},
     *     summary="Vacancy",
     *     description="Vacancy",
     *     operationId="vacancy",
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

        $tmp = Vacancy::all();

        if ($locale === $default_locale) {
            foreach ($tmp as $key) {
                $data[] = (object)[
                    'id' => $key['id'],
                    'position' => $key['position'],
                    'requirements' => $key['requirements']
                ];
            }
        } else {
            $translated = $tmp->load('translations');

            foreach ($translated as $key => $value) {
                $data[] = (object)[
                    'id' => $value['id'],
                    'position' => $value->translations[1]['value'],
                    'requirements' => $value->translations[0]['value']
                ];
            }
        }

        return response()->json(['status' => 200, 'data' => $data]);
    }
}
