<?php

use App\Task;
use Illuminate\Http\Request;

Route::get('clients', function() {
   return 'test'; 
});

Route::get('clients/{client_id}', function($client_id) {
    
});

Route::post('clients', function(Request $resuest) {
    
});

Route::post('clients/{client_id}', function(Request $request, $client_id) {
    
});

Route::post('clients/add_doucment/{client_id}', function(Request $request, $client_id) {
    
});

Route::post('clients/delete_document/{client_id}', function(Request $request, $client_id) {
    
});