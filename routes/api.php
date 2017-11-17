<?php

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/posts", function () {
    return Post::all();
});
Route::post("/v1/ckeditor/images", function(Request $request) {
 try {
     $rel = 'storage/images';
     $name = $_FILES['upload']['name'];
     $request->upload->storeAs("public/images", $name);
     $file = $rel .'/'.$name;
     $funcNum = $_GET['CKEditorFuncNum'];
     $message = "File uploaded";
     $script = "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction(\"$funcNum\", \"$file\", \"$message\");</script>";
     return $script;
 } catch (\Exception $e) {
     dd($e->getMessage());
 }
});

