<?php

namespace App\Http\Controllers;

use App\Models\ServicesMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ServicesMenuController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/services_menu",
     *     tags={"Services menu"},
     *     summary="Get list of services menu",
     *     description="Services Menu",
     *     operationId="servicesMenu",
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
        $data = [];
        $default_locale = 'ru';
        $locale = app()->getLocale();

        $tmp = ServicesMenu::all();
        $tmp->load('translations');
//        Log::info($tmp);

        if ($locale === $default_locale) {
            foreach ($tmp as $key) {
//                Log::info($key['icon']);
                $data[] = (object)[
                    'path' => $key['path'],
                    'title' => $key['title'],
                    'icon' => str_replace('\\', '/', $key['icon'])
                ];
            }
        } else {
            foreach ($tmp as $key => $value) {
                $data[] = (object)[
                    'path' => $value['path'],
                    'title' => $value->translations[0]['value'],
                    'icon' => str_replace('\\', '/', $value['icon'])
                ];
            }
        }

        return response()->json(['status' => 200, 'data' => $data]);
    }
}
