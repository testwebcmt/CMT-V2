<?php





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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//LoginPage @ UserController
Route::post('register', 'App\Http\Controllers\UserController@register');

Route::post('login', 'App\Http\Controllers\UserController@login');

Route::get('profile', 'App\Http\Controllers\UserController@getAuthenticatedUser');

Route::post('register1', 'App\Http\Controllers\test2@register');

Route::post('irf', 'App\Http\Controllers\test@irf');

Route::GET('irfsearch', 'App\Http\Controllers\Irfsearch@irfsearch');
