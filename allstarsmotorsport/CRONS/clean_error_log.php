<?php

/**
 * Procura dentro do directorio ($dir) recebido se existe algum ficheiro com o nome $filename.
 * Se existir, remove o.
 */
function deleteFileFrom($dir, $filename, &$results = array()){

    $files = scandir($dir);

    foreach($files as $key => $value){

        $path = realpath($dir.DIRECTORY_SEPARATOR.$value);

        if(!is_dir($path)) {

            $path_array = explode("/", $path);

            if(!strcmp( end($path_array), $filename)) {
                //echo '<br>' . filesize ( $dir . '/' . $filename );
                unlink($path);
            }

        } else if($value != "." && $value != "..") {
            deleteFileFrom($path, $filename, $results);
            $results[] = $path;
        }
    }
}

set_time_limit(3600);

$dir = '../../';

deleteFileFrom($dir, 'error_log');
deleteFileFrom($dir, 'error_log_bak');

echo '<br><br>Fim de limpeza de ficheiro:';
echo '<br> - error_log';
echo '<br> - error_log_bak';