<?php

namespace App\Http\Controllers;

use App\Models\OurAdvantage;
use App\Models\ServicesFeature;
use App\Models\ServicesGallery;
use App\Models\ServicesPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ServicesPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $default_locale = 'ru';
        $locale = app()->getLocale();
        $services_page = [];

        $services_page_tmp = ServicesPage::all();
        $services_features_tmp = ServicesFeature::all();
        $advantages_tmp = OurAdvantage::all();
        $gallery_tmp = ServicesGallery::all();

        $features_collection = collect($services_features_tmp);
        $advantages_collection = collect($advantages_tmp);
        $gallery_collection = collect($gallery_tmp);


        if ($locale === $default_locale) {
            foreach ($services_page_tmp as $key) {
                $features_data = [];
                $filtered_features = $features_collection->where('services_category_id', $key['id']);

                foreach ($filtered_features as $feature_key) {
                    $features_data[] = (object)[
                        'id' => $feature_key['id'],
                        'text' => $feature_key['text'],
                        'icon' => str_replace('\\', '/', $feature_key['icon']),
                        'services_category_id' => $feature_key['services_category_id']
                    ];
                }

                $filtered_advantages = $advantages_collection->where('services_category_id', $key['id']);
                $advantages = [];

                foreach ($filtered_advantages as $advantage_key => $advantage_value) {
                    $advantages[] = $advantage_value['text'];
                }

                $filtered_gallery = $gallery_collection->where('services_category_id', $key['id']);
                $gallery = [];

                foreach ($filtered_gallery as $gallery_key => $gallery_value) {
                    $gallery[] = str_replace('\\', '/', $gallery_value['image']);
                }

                $services_page[] = (object)[
                    'services_category_id' => $key['id'],
                    'title' => $key['title'],
                    'text' => $key['text'],
                    'image' => str_replace('\\', '/', $key['image']),
                    'features' => $features_data,
                    'advantages' => $advantages,
                    'gallery' => $gallery
                ];
            }
        } else {
            $services_page_tmp->load('translations');
            $services_features_tmp->load('translations');
            $advantages_tmp->load('translations');
            $features_collection = collect($services_features_tmp);
            $advantages_collection = collect($advantages_tmp);

            foreach ($services_page_tmp as $key => $value) {

                $filtered_features = $features_collection->where('services_category_id', $value['id']);
                $filtered_advantages = $advantages_collection->where('services_category_id', $value['id']);
                $features_translated = [];
                $advantages_translated = [];

                foreach ($filtered_features as $translation_key => $translated_value) {
                    $features_translated[] = (object)[
                        'id' => $translated_value['id'],
                        'text' => $translated_value->translations[0]['value'],
                        'icon' => str_replace('\\', '/', $translated_value['icon']),
                        'services_category_id' => $translated_value['services_category_id']
                    ];
                }

                foreach ($filtered_advantages as $translation_key => $translated_value) {
                    $advantages_translated[] = $translated_value->translations[0]['value'];
                }

                $filtered_gallery = $gallery_collection->where('services_category_id', $value['id']);
                $gallery = [];

                foreach ($filtered_gallery as $gallery_key => $gallery_value) {
                    $gallery[] = str_replace('\\', '/', $gallery_value['image']);
                }

                $services_page[] = (object)[
                    'services_category_id' => $value['id'],
                    'title' => $value->translations[1]['value'],
                    'text' => $value->translations[0]['value'],
                    'image' => str_replace('\\', '/', $value['image']),
                    'features' => $features_translated,
                    'advantages' => $advantages_translated,
                    'gallery' => $gallery
                ];
            }
            return response()->json(['status' => 200, 'data' => $services_page]);
        }

        return response()->json(['status' => 200, 'data' => $services_page]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\ServicesPage $servicesPage
     * @return \Illuminate\Http\Response
     */
    public function show(ServicesPage $servicesPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\ServicesPage $servicesPage
     * @return \Illuminate\Http\Response
     */
    public function edit(ServicesPage $servicesPage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ServicesPage $servicesPage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServicesPage $servicesPage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\ServicesPage $servicesPage
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServicesPage $servicesPage)
    {
        //
    }
}
