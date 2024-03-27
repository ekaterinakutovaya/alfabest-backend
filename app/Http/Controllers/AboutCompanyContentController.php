<?php

namespace App\Http\Controllers;

use App\Models\AboutCompanyContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AboutCompanyContentController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/about_company",
     *     tags={"About company"},
     *     summary="About company",
     *     description="About company",
     *     operationId="aboutCompany",
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

        $tmp = AboutCompanyContent::all();
        $tmp->load('translations');
//        Log::info($tmp);

        if ($locale === $default_locale) {
                $data[] = (object)[
                    'title' => $tmp[0]['title'],
                    'home_page_text' => $tmp[0]['home_page_text'],
                    'about_company_page_text' => $tmp[0]['about_company_page_text'],
                    'home_page_image' => str_replace('\\', '/', $tmp[0]['home_page_image']),
                    'about_company_page_image' => str_replace('\\', '/', $tmp[0]['about_company_page_image'])
                ];
        } else {
            $translations = json_decode($tmp[0]->translations, true);

                $data[] = (object)[
                    'title' => $translations[2]['value'],
                    'home_page_text' => $translations[1]['value'],
                    'about_company_page_text' => $translations[0]['value'],
                    'home_page_image' => str_replace('\\', '/', $tmp[0]['home_page_image']),
                    'about_company_page_image' => str_replace('\\', '/', $tmp[0]['about_company_page_image'])
                ];
        }

        return response()->json(['status' => 200, 'data' => $data]);
    }
}
