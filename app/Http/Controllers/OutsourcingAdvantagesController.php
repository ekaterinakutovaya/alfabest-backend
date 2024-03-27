<?php

namespace App\Http\Controllers;

use App\Models\OutsourcingAdvantage;
use App\Models\OutsourcingAdvantagesItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OutsourcingAdvantagesController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/outsourcing_advantages",
     *     tags={"Outsourcing Advantages"},
     *     summary="Outsourcing Advantages",
     *     description="Outsourcing Advantages",
     *     operationId="outsourcingAdvantages",
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
        $data_items = [];
        $default_locale = 'ru';
        $locale = app()->getLocale();

        $tmp = OutsourcingAdvantage::all();
        $items = OutsourcingAdvantagesItem::all();

        if ($locale === $default_locale) {
            foreach ($items as $key) {
                $data_items[] = $key['text'];
            }

            $data['title'] = $tmp[0]['title'];
            $data['advantages'] = $data_items;
        } else {
            $tmp->load('translations');
            $items->load('translations');

            $data['title'] = $tmp[0]->translations[0]['value'];

            foreach ($items as $key => $value) {
                $data_items[] = $value->translations[0]['value'];
            }

            $data['advantages'] = $data_items;
        }

        return response()->json(['status' => 200, 'data' => $data]);
    }
}
