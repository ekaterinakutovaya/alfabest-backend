<?php

namespace App\Http\Controllers;

use App\Models\OurAimItem;
use Illuminate\Http\Request;

class OurAimItemController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/our_aim_items",
     *     tags={"Our Aim Items"},
     *     summary="Our Aim Items",
     *     description="Our Aim Items",
     *     operationId="ourAimItems",
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

        $tmp = OurAimItem::all();

        if ($locale === $default_locale) {
            foreach ($tmp as $key) {
                $data[] = (object)[
                    'title' => $key['title'],
                    'image' => str_replace('\\', '/', $key['image'])
                ];
            }
        } else {
            $tmp->load('translations');

            foreach ($tmp as $key => $value) {
                $data[] = (object)[
                    'title' => $value->translations[0]['value'],
                    'image' => str_replace('\\', '/', $value['image'])
                ];
            }
        }

        return response()->json(['status' => 200, 'data' => $data]);
    }
}
