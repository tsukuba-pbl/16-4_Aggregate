<?php
    //保存先のディレクトリ
    $target_dir = "./csv/";
    //保存先のパス(ファイル名含む)
    $target_path = $target_dir.basename($_FILES['file']['name']);
    //保存する際に日本語であると文字化けするのでその対処
    $target_path = mb_convert_encoding($target_path, "SJIS", "AUTO");
    //tmp_nameの場所から保存先のパスにファイルを移動(アップロード)
    if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)){
        echo "The file ". basename($_FILES['file']['name']). " has been uploaded";
    }else{
        echo "error";
    }
?>