<?php

use Illuminate\Http\Request;
use App\Client;
use App\Document;

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

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
 */

/**
 * просмотр списка
 */
Route::get('clients', function() {
   // TODO выводить в правильной кодировке
   return Client::all();
});

/**
 * получение одного
 */
Route::get('clients/{client_id}', function($client_id) {
    return Client::find($client_id);
});

/**
 * добавление
 */
Route::post('clients', function(Request $request) {
    // TODO валидация email
    $all = $request->all();
    $fio = $request->fio;
    return Client::create($request->all());
});

/**
 * изменение
 */
Route::post('clients/{client_id}', function(Request $request, $client_id) {
    $client = Client::findOrFail($client_id);
    $client->update($request->all());
    return $client;
});

/**
 * добавить документ
 */
Route::post('clients/add_document/{client_id}', function(Request $request, $client_id) {
    // TODO обработка ошибок
    // TODO переместить файлы из публичной директории
    if ($request->hasFile('document')) {
        $file = $request->file('document');
        $document = new Document();
        $document->name = $file->getFilename();
        $document->client_id = $client_id;
        if ($document->save()) {
            $file->move(storage_path() . '/documents/' . $document->document_id, $file->getClientOriginalName());
        }
    }
});

/**
 * удалить документ
 */
Route::post('clients/delete_document/{client_id}', function(Request $request, $client_id) {
    
});
