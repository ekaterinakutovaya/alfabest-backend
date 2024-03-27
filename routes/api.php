<?php

use App\Http\Controllers\AboutCompanyContentController;
use App\Http\Controllers\HeroContentController;
use App\Http\Controllers\MainMenuController;
use App\Http\Controllers\OurAimController;
use App\Http\Controllers\OurAimItemController;
use App\Http\Controllers\ServicesMenuController;
use App\Http\Middleware\ChangeLocale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(ChangeLocale::class)->group(function(): void {
    Route::get('/main_menu', [MainMenuController::class, 'index']);
    Route::get('/services_menu', [ServicesMenuController::class, 'index']);
    Route::get('/hero_content', [HeroContentController::class, 'index']);
    Route::get('/about_company', [AboutCompanyContentController::class, 'index']);
    Route::get('/our_aim', [OurAimController::class, 'index']);
    Route::get('/our_aim_items', [OurAimItemController::class, 'index']);
    Route::get('/history', [\App\Http\Controllers\HistoryController::class, 'index']);
    Route::get('/mission', [\App\Http\Controllers\MissionController::class, 'index']);
    Route::get('/team', [\App\Http\Controllers\TeamController::class, 'index']);
    Route::get('/gallery', [\App\Http\Controllers\GalleryController::class, 'index']);
    Route::get('/career', [\App\Http\Controllers\CareerController::class, 'index']);
    Route::get('/vacancy', [\App\Http\Controllers\VacancyController::class, 'index']);
    Route::get('/purchase', [\App\Http\Controllers\PurchaseController::class, 'index']);
    Route::get('/cooperation', [\App\Http\Controllers\CooperationController::class, 'index']);
    Route::get('/outsourcing_advantages', [\App\Http\Controllers\OutsourcingAdvantagesController::class, 'index']);
    Route::get('/company_contacts', [\App\Http\Controllers\ContactsPageContentController::class, 'index']);
    Route::get('/services_page', [\App\Http\Controllers\ServicesPageController::class, 'index']);
    Route::get('/features', [\App\Http\Controllers\FeaturesController::class, 'index']);
});

Route::post('/services_query', [\App\Http\Controllers\ServiceQueryController::class, 'store']);
Route::post('/customer_contacts', [\App\Http\Controllers\CustomerContactsController::class, 'store']);
