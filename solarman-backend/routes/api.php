<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VariableController;
use App\Mail\ClientCreated;
use App\Models\Client;
use App\Models\ClientEstimate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

Route::prefix('/users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::post('/', [UserController::class, 'store']);
    Route::put('/{id}', [UserController::class, 'update']);
});

Route::prefix('/clients')->group(function () {
    Route::get('/', [ClientController::class, 'index']);
    Route::post('/handle-client-estimate', [ClientController::class, 'handleClientEstimate']);
    Route::get('/{id}', [ClientController::class, 'show']);
    Route::delete('/{id}', [ClientController::class, 'destroy']);
});

Route::post('/login', [AuthController::class, 'login'])->name('login');

//Rotas protegidas para usuários autenticados
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::prefix('/reports')->group(function () {
        Route::post('/', [ReportController::class, 'handleReport']);
    });
});

Route::prefix('/variables')->group(function () {
    Route::get('/', [VariableController::class, 'index']);
    Route::put('/{id}', [VariableController::class, 'update']);
});

Route::get('/reports', [ReportController::class, 'index']);
Route::get('/reports/{id}', [ReportController::class, 'show']);

Route::post('/send-email', function () {

    function formatPhoneNumber($phone)
    {
        if (strlen($phone) == 11) {
            return '(' . substr($phone, 0, 2) . ') ' . substr($phone, 2, 5) . '-' . substr($phone, 7);
        }
        return $phone;
    }

    function formatCurrency($value)
    {
        return number_format($value, 2, ',', '.');
    }

    $client = new Client();
    $clientEstimate = new ClientEstimate();
    $client->name = 'João Silva Nascimento Nome Grande';
    $client->phone = formatPhoneNumber('41999999999');
    $clientEstimate->fatura_copel = formatCurrency(1000);
    $clientEstimate->final_value_discount = formatCurrency(800);


    Mail::to('agente@example.com')->send(new ClientCreated($client, $clientEstimate));
});
