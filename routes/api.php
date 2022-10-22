<?php

use App\Http\Controllers\Api\CategoryPeopleController;
use App\Http\Controllers\Api\CategoryPersonController;
use App\Http\Controllers\Api\CategoryPersonFieldController;
use App\Http\Controllers\Api\CategorySpaceController;
use App\Http\Controllers\Api\CategorySpaceFieldController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\PersonajeController;
use App\Http\Controllers\AuthSanctumController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PersonController;
use App\Http\Controllers\Api\SpaceController;
use App\Http\Controllers\Api\SeekerController;
use Illuminate\Support\Facades\Auth;

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

// Middleware SANCTUM
Auth::routes();
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['web']], function () {
    Route::get('token', ['uses' => 'App\Http\Controllers\AuthSanctumController@token']);
    Route::post('registro', ['uses' => 'App\Http\Controllers\AuthSanctumController@registro']);
    Route::post('login', ['uses' => 'App\Http\Controllers\Api\UserController@login']);
    
    Route::post('perfil', ['uses' => 'App\Http\Controllers\AuthSanctumController@perfil'], 'perfil');
    Route::post('logout', ['uses' => 'App\Http\Controllers\AuthSanctumController@logout'], 'logout');
    
    //Rutas para personas.
    Route::get('person/slug/{slug}', [PersonController::class, 'slug']);
    Route::get('person/id/{slug}', [PersonController::class, 'id']);
    Route::resource('person', PersonController::class)->except(["create", "edit"]);
    Route::get('person/buildSlug/{slug}', [PersonController::class, 'buildSlug']);
    Route::get('person/buscar/{palabra}', [PersonController::class, 'buscar']);
    Route::post('person/upload/{slug}', [PersonController::class, 'upload']);
    Route::get('seeker/buscar/{palabra}', [SeekerController::class, 'buscar']);
    
    //Rutas para espacios.
    Route::get('space/slug/{slug}', [SpaceController::class, 'slug']);
    Route::get('space/id/{slug}', [SpaceController::class, 'id']);
    Route::resource('space', SpaceController::class)->except(["create", "edit"]);
    Route::get('space/buildSlug/{slug}', [SpaceController::class, 'buildSlug']);
    
    
    //Rutas para las categorías de las personas
    Route::get('category/getPersonCategoriesFields/{id}', [CategoryPeopleController::class, 'getPersonCategoriesFields']);
    Route::get('category/getWorkCategoriesFields/{id}', [CategoryPeopleController::class, 'getWorkCategoriesFields']);
    Route::get('category/getPersonCategories', [CategoryPeopleController::class, 'getPersonCategories']);
    Route::get('category/getWorkCategories', [CategoryPeopleController::class, 'getWorkCategories']);
    Route::resource('category', CategoryPeopleController::class)->except(["create", "edit"]);
    Route::resource('categoryPersonFields', CategoryPersonFieldController::class)->except(["create", "edit"]);
    Route::delete('eliminarCategoriasPersonal/{id}', [CategoryPersonFieldController::class, 'eliminarCategoriasPersonal']);
    Route::delete('eliminarCategoriasLaboral/{id}', [CategoryPersonFieldController::class, 'eliminarCategoriasLaboral']);
    
    //Rutas para las categorías de los espacios
    Route::get('category/getSpaceCategoriesFields/{id}', [CategorySpaceController::class, 'getSpaceCategoriesFields']);
    Route::resource('categorySpace', CategorySpaceController::class)->except(["create", "edit"]);
    Route::resource('categorySpaceFields', CategorySpaceFieldController::class)->except(["create", "edit"]);
    
    Route::resource('image', ImageController::class)->except(["create", "edit"]);
    Route::get('image/getImage/{slug}', [ImageController::class, 'getImage']);
    //Rutas para usuarios autenticados
    Route::middleware('auth:sanctum')->group(function () {
    });
    
    Route::resource('personaje', PersonajeController::class)->except(["create", "edit"]);
    
});
//Rutas de autenticación
