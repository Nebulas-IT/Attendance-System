<?php

function csvToAssocArray($filename = '', $delimiter = ',') {
    if (!file_exists($filename) || !is_readable($filename))
        return false;

    $header = null;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== false) {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
            if (!$header)
                $header = $row;
            else
                $data[] = array_combine($header, $row);
        }
        fclose($handle);
    }

    return $data;
}

function csvToArray($filename = '', $delimiter = ','){
    if ($delimiter == "\t"){
        $data = array_map(function($v){return str_getcsv($v, "\t");}, file($filename));
    }else {
        $data = array_map(function($v){return str_getcsv($v, ",");}, file($filename));
    }
    return $data;
}
