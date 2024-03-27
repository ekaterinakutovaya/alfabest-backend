<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GalleryController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/gallery",
     *     tags={"Gallery"},
     *     summary="Gallery",
     *     description="Gallery",
     *     operationId="gallery",
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
    public function index() {
        $tmp = Gallery::all();
        $data = [];

        foreach ($tmp as $key) {
            array_push($data, str_replace('\\', '/', $key['image']));
        }

        return response()->json(['status' => 200, 'data' => $data]);
    }
}
