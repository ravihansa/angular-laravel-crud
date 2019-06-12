<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'API'], function () {

    Route::post('/savecompany', 'CompanyController@saveCompanyData');
    Route::get('/getcompany/{id}', 'CompanyController@getCompanyData');
    Route::get('/loadcompany', 'CompanyController@loadAllCompanies');
    Route::post('/updatecompany', 'CompanyController@updateCompanyData');
    Route::delete('/deletecompany/{id}', 'CompanyController@deleteCompany');

});
