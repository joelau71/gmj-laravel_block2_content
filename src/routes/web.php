<?php

use GMJ\LaravelBlock2Content\Http\Controllers\BlockController;

Route::group([
    "middleware" => ["web", "auth"],
    "prefix" => "admin/element/{element_id}/gmj/laravel_block2_content",
    "as" => "LaravelBlock2Content."
], function () {
    Route::get("index", [BlockController::class, "index"])->name("index");
    Route::get("create", [BlockController::class, "create"])->name("create");
    Route::post("create", [BlockController::class, "store"])->name("store");
    Route::get("edit", [BlockController::class, "edit"])->name("edit");
    Route::patch("edit", [BlockController::class, "update"])->name("update");
});

Route::group([
    "middleware" => ["api"],
    "prefix" => "admin/gmj/laravel_block2_content/api",
    "as" => "LaravelBlock2Content.api."
], function () {
    Route::post("upload", [BlockController::class, "upload"])->name("upload");
});
