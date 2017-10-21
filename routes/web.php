<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\File;

Route::get('/', function () {
    $vue_source = File::get(base_path('node_modules/vue/dist/vue.runtime.common.js'));
    $renderer_source = File::get(base_path('node_modules/vue-server-renderer/basic.js'));
    $app_source = File::get(resource_path('assets/js/test.js'));

    $v8 = new V8Js();

    $v8->executeString('var process = { env: { VUE_ENV: "server", NODE_ENV: "production" }}; this.global = { process: process };');
    $v8->executeString($vue_source);
    $v8->executeString($renderer_source);
    $output = $v8->executeString($app_source);

    return view('welcome', ['ssr' => $output]);
});
