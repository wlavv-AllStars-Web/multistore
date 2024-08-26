<?php

/** Cria um array com todos os ficheiros dentro do directorio seleccionado **/
function getDirContents($dir, &$results = array()){

    $files = scandir($dir);

    foreach($files as $key => $value){

        $path = realpath($dir.DIRECTORY_SEPARATOR.$value);

        if(!is_dir($path)) {
            $results[] = $path;
        } else if($value != "." && $value != "..") {
            getDirContents($path, $results);
            $results[] = $path;
        }
    }
    return $results;
}

/**
 * Percorre o array $paths.
 * Para cada $path, verifica:
 *    - Se n達o s達o imagens nem videos
 *    - Se o conteudo do ficheiro possui alguma string com "$search".
 * Se existir, substitui pela "$toReplace" e volta a guardar o ficheiro
 **/
function checkString($paths, $search, $toReplace){

    foreach ($paths AS $path){

        $file_parts = pathinfo($path);

        if( (isset($file_parts['extension']))
            && ($file_parts['extension'] != 'jpg')
            && ( $file_parts['extension'] != 'JPG')
            && ( $file_parts['extension'] != 'jpeg')
            && ( $file_parts['extension'] != 'JPEG')
            && ( $file_parts['extension'] != 'png')
            && ( $file_parts['extension'] != 'PNG')
            && ( $file_parts['extension'] != 'gif')
            && ( $file_parts['extension'] != 'GIF')
            && ( $file_parts['extension'] != 'mp4')
            && ( $file_parts['extension'] != 'MP4') ){

            $content = file_get_contents($path);

            if( strpos($content,$search) !== false) {
                echo '<br>FIXED: ' . $path;
                file_put_contents($path, str_replace($search, $toReplace, $content));
            }
        }
    }
}

set_time_limit(3600);

$dir = '../../';

$array[] = 'h';
$array[] = 't';
$array[] = 't';
$array[] = 'p';
$array[] = ':';
$array[] = '//';

$searchFor = implode('', $array);
$replaceWith = 'https://';

checkString(getDirContents($dir), $searchFor, $replaceWith);