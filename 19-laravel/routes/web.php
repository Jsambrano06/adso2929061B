<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('sayhello/{name}', function() {
    return "<h1>Hello: ".request()->name." 🚀</h1>";
});

Route::get('show/pet/{id}', function() {
    $pet = App\Models\pet::find(request()->id);
    dd($pet->toArray());
    });