<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Parameters;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;
use Illuminate\Support\Facades\Storage;

class ParameterService
{
    public function parse($input) {
        if(empty($input)) return [];

        $chunks = array_chunk(preg_split('/(=|\|)/', $input), 2);
        $result = array_combine(array_column($chunks, 0), array_column($chunks, 1));
        return $result;
    }

    public function get($input, $param) {
        $array = $this->parse($input);
        if(isset($array[$param]))
            return $array[$param];

        return NULL;
    }

    function makestring($array) {
        if(empty($array)) return ;
        $str = "";
        foreach($array as $key => $value) {

            $str.=$key."=".$value;
            $str.='|';
        }
        return substr($str, 0, strlen($str) - 1);
    }

    function faktorbul($faktor) {
        $faktorler = Parameters::where('type', 'stdcon');

        if($faktor1 = $faktorler->where('value', $faktor)->first()) {
            return $faktor1->factor;
        }

        return $faktor;
    }
}
