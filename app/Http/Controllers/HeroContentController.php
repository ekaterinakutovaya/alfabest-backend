<?php

namespace App\Http\Controllers;

use App\Models\HeroContent;
use Illuminate\Http\Request;

class HeroContentController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/hero_content",
     *     tags={"Hero section content"},
     *     summary="Get Hero section content",
     *     description="Hero Content",
     *     operationId="heroContent",
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

        $tmp = HeroContent::all();
        $tmp->load('translations');
//        Log::info($tmp);

        if ($locale === $default_locale) {
            foreach ($tmp as $key) {
//                Log::info($key['icon']);
                $data[] = (object)[
                    'path' => $key['path'],
                    'title' => $key['title'],
                    'image' => str_replace('\\', '/', $key['image'])
                ];
            }
        } else {
            foreach ($tmp as $key => $value) {
                $data[] = (object)[
                    'path' => $value['path'],
                    'title' => $value->translations[0]['value'],
                    'image' => str_replace('\\', '/', $value['image'])
                ];
            }
        }

        return response()->json(['status' => 200, 'data' => $data]);
    }
}
