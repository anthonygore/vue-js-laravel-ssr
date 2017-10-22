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
    $vue_source = File::get(base_path('node_modules/vue/dist/vue.runtime.js'));
    $renderer_source = File::get(base_path('node_modules/vue-server-renderer/basic.js'));
    $app_source = File::get(public_path('js/entry-server.js'));

    $v8 = new V8Js();

    ob_start();

    $v8->executeString('var process = { env: { VUE_ENV: "server", NODE_ENV: "production" }}; this.global = { process: process };');
    $v8->executeString($vue_source);
    $v8->executeString($renderer_source);
    $v8->executeString($app_source);

    $output = ob_get_clean();

    return view('welcome', ['ssr' => $output]);
});
