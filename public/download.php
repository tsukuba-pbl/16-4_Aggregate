<?php
    //結果を書き込むファイル
    define("DIST_FILE", "./csv/result.csv");
    include_once("FileMake.php");

    $fm = new FileMake();

    //ファイルが選択されていない場合
    if(!isset($_POST["file"])){
        header('location: index.html');
        exit;
    }

    if(isset($_POST["file"])){
        $result = array();
        //ファイルの中の全ユーザの最新データ取得
        $result = $fm->getUserData($_POST["file"]);

        //ダウンロードしてもらうためのファイルの作成(最新のユーザのデータをファイルに書き込み)
        $fm->writeLatestUserData(DIST_FILE, $result);

        //保存させる際のファイル名
        $j_file = "投票結果.csv";
        //日本語対応
        $tmp_file = mb_convert_encoding(DIST_FILE, "SJIS", "AUTO");
        //日本語対応
        $j_file = mb_convert_encoding($j_file, "SJIS", "AUTO");

        // ヘッダ
        header("Content-Type: application/octet-stream");
        // ダイアログボックスに表示するファイル名
        header("Content-Disposition: attachment; filename=$j_file");
        // 対象ファイルを出力する。
        readfile($tmp_file);
        // 結果のファイルを削除
        unlink(DIST_FILE);
        exit;
    }
?>
