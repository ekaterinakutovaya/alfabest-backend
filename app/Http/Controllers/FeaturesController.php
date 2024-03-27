<?php

namespace App\Http\Controllers;

use App\Models\ServicesFeature;
use App\Models\ServicesMenu;

class FeaturesController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/features",
     *     tags={"Features"},
     *     summary="Get list of feature",
     *     description="Features",
     *     operationId="features",
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

        $features_tmp = ServicesFeature::all();
        $features_collection = collect($features_tmp);
        $filtered_features = $features_collection->where('services_category_id', 3);
//        Log::info($tmp);

        if ($locale === $default_locale) {
            foreach ($filtered_features as $key) {
//                Log::info($key['icon']);
                $data[] = (object)[
                    'id' => $key['id'],
                    'text' => $key['text'],
                    'icon' => str_replace('\\', '/', $key['icon']),
                    'services_category_id' => $key['services_category_id']
                ];
            }
        } else {
            $features_tmp->load('translations');

            foreach ($features_tmp as $key => $value) {
                $data[] = (object)[
                    'id' => $value['id'],
                    'text' => $value->translations[0]['value'],
                    'icon' => str_replace('\\', '/', $value['icon']),
                    'services_category_id' => $value['services_category_id']
                ];
            }
        }

        return response()->json(['status' => 200, 'data' => $data]);
    }
}
