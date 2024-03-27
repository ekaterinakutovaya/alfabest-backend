<?php

namespace App\Http\Controllers;

use App\Models\MainMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MainMenuController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/main_menu",
     *     tags={"Main menu"},
     *     summary="Get list of main menu",
     *     description="Main Menu",
     *     operationId="mainMenu",
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

        $tmp = MainMenu::all();
        $tmp->load('translations');
//        Log::info($tmp);

        if ($locale === $default_locale) {
            foreach ($tmp as $key) {
                $data[] = (object)[
                    'path' => $key['path'],
                    'title' => $key['title']
                ];
            }
        } else {
            foreach ($tmp as $key => $value) {
                $data[] = (object)[
                    'path' => $value['path'],
                    'title' => $value->translations[0]['value']
                ];
            }
        }

        return response()->json(['status' => 200, 'data' => $data]);
    }
}
