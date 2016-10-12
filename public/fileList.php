<?php
    ini_set('display_errors', 1);
    include_once("DirectoryHandle.php");
    //CSVファイルのあるディレクトリ
    define("TARGET_DIR", "./csv/");

    $dh = new DirectoryHandle(TARGET_DIR);
    //JSONで返却
    echo json_encode($dh->fileList());
