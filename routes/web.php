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


use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});



Route::get("/editor", function(Request $request) {
    
    return "At vero eos et accusam et justo duo dolores et ea rebum. Consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
    
    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat.";
});


Route::post("/editor", function(Request $request) {

        $post = \App\Post::create($request->all());
        return $post;
});

Route::get("/api/v1/ckeditor/gallery", function() {

    $rel = '/storage/images';
    $dir = public_path() . '/storage/images';
    $files_getter = \File::files($dir);
    $files = [];
    $count = 0;
    foreach($files_getter as $file) {
        $name = $file->getFileName();
        $files[$count]['thumb'] = $rel . '/' . $name;
        $files[$count]['image'] = $rel . '/' . $name;
        $files[$count]['title'] = $name;
        $count ++;
    }

    return Response::json($files);

});