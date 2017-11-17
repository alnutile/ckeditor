<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FileUploadTest extends TestCase
{
    public function testFileUpload()
    {
        $stub = base_path('/tests/stubs/foo.png');
        $name = 'bar.png';
        $path = sys_get_temp_dir().'/'.$name;

        copy($stub, $path);

        $file = new UploadedFile($path, $name, filesize($path), 'image/png', null, true);
        $response = $this->call('POST', '/api/v1/ckeditor/images', [], [], ['upload' => $file], ['Accept' => 'application/json']);

        dd($response->getContent());

    }
}
