<?php

use Illuminate\Support\Facades\Route;


Route::get("ar", function () {
    session()->put("local", "ar");
    return redirect()->back();
})->name("language.ar");

Route::get("en", function () {
    session()->put("local", "en");
    return redirect()->back();
})->name("language.en");