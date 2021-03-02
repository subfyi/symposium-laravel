<?php

namespace App\Http\Controllers\Apim;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ServerInfoController extends Controller
{
    public function get() {
        return [
            "phpversion" => phpversion(),
            "file" => dirname(__FILE__),
            "max_execution_time" => ini_get('max_execution_time'),
            "max_file_uploads" => ini_get('max_file_uploads'),
            "max_input_time" => ini_get('max_input_time'),
            "max_input_vars" => ini_get('max_input_vars'),
            "memory_limit" => ini_get('memory_limit'),
            "post_max_size" => ini_get('post_max_size'),
            "upload_max_filesize" => ini_get('upload_max_filesize')
        ];
    }

    public function databank() {
        $tables = DB::select("show table status");

        return [
            "data" => $tables
        ];
    }
}
