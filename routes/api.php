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
 * 
 * параметры запроса:
 * page - номер страницы
 */
Route::get('clients', function(Request $request) {
   $RECORDS_ON_PAGE = 5;
   $pageNumber = $request->page;
   $collection = Client::all();
   $collectionForPage = $collection->forPage($pageNumber, $RECORDS_ON_PAGE);
   return $collectionForPage;
});

/**
 * получение одного
 */
Route::get('clients/{client_id}', function($client_id) {
    return Client::with('documents')->find($client_id);
});

/**
 * добавление
 * 
 * параметры запроса:
 * fio
 * email
 * phone
 * status
 */
Route::post('clients', function(Request $request) {
    $validator = Validator::make($request->all(), ['email' => 'email']);
    if ($validator->fails()) {
        return 'error: email not valid';
    }
    return Client::create($request->all());
});

/**
 * изменение
 * 
 * параметры запроса:
 * fio
 * email
 * phone
 * status
 */
Route::post('clients/{client_id}', function(Request $request, $client_id) {
    $validator = Validator::make($request->all(), ['email' => 'email']);
    if ($validator->fails()) {
        return 'error: email not valid';
    }
    $client = Client::findOrFail($client_id);
    $client->update($request->all());
    return $client;
});

/**
 * добавить документ
 * 
 * параметры запроса:
 * document - файл документа
 */
Route::post('clients/add_document/{client_id}', function(Request $request, $client_id) {
    if ($request->hasFile('document')) {
        $file = $request->file('document');
        $document = new Document();
        $document->name = $file->getClientOriginalName();
        $document->client_id = $client_id;
        if ($document->save()) {
            $file->move(storage_path() . '/documents/' . $document->document_id, $file->getClientOriginalName());
        }
    }
});

/**
 * удалить документ
 */
Route::post('clients/detach_document/{document_id}', function(Request $request, $document_id) {
    $document = Document::find($document_id);
    $document->client_id = null;
    $document->save();
});
