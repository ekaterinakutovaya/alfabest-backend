<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TeamController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/team",
     *     tags={"Our Team"},
     *     summary="Our Team",
     *     description="Our Team",
     *     operationId="ourTeam",
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

        $tmp = Team::all();

        if ($locale === $default_locale) {
            foreach ($tmp as $key) {
                $data[] = (object)[
                    'id' => $key['id'],
                    'full_name' => $key['full_name'],
                    'position' => $key['position'],
                    'photo' => str_replace('\\', '/', $key['photo'])
                ];
            }
        } else {
            $tmp->load('translations');

            foreach ($tmp as $key => $value) {
                $data[] = (object)[
                    'id' => $value['id'],
                    'full_name' => $value->translations[0]['value'],
                    'position' => $value->translations[1]['value'],
                    'photo' => str_replace('\\', '/', $value['photo'])
                ];
            }
        }

        return response()->json(['status' => 200, 'data' => $data]);
    }
}
