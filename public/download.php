<?php
    //ダウンロードさせるファイル名
    $tmp_file = "./csv/target.csv";
    //保存させる際のファイル名
    $j_file = "投票結果.csv";
    //日本語対応
    $tmp_file = mb_convert_encoding($tmp_file, "SJIS", "AUTO");
    //日本語対応
    $j_file = mb_convert_encoding($j_file, "SJIS", "AUTO");
    // ヘッダ
    header("Content-Type: application/octet-stream");
    // ダイアログボックスに表示するファイル名
    header("Content-Disposition: attachment; filename=$j_file");
    // 対象ファイルを出力する。
    readfile($tmp_file);
    exit;
?>