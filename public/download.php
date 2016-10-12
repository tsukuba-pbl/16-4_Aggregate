<?php
    //csvのあるフォルダ
    define("TARGET_DIR", "./csv/");
    //結果を書き込むファイル
    define("DIST_FILE", "./csv/result.csv");
    /*
        1行のCSVデータを分割し、整形したデータを返却
    */
    function dataAnalyze($data){
        // ','でデータが区切ってあるので、データを分割
        list($user, $vote1, $vote2, $vote3, $date) = explode(",", $data);
        //ユーザのデータがなければデータを挿入 OR ユーザの投票データがあって、今回のデータの方が最新の場合、データの更新
        if(!isset($result[$user]) || (isset($result[$user]) && strtotime($date) > strtotime($result[$user]["date"]))){
            echo "update: ". $user . ", " . $vote1 . ", " . $vote2 . ", " . $vote3 . ", " . $date . "<br>";
            return array("user" => $user, "vote1" => $vote1, "vote2" => $vote2, "vote3" => $vote3, "date" => $date);
        }
    }

    //ファイルが選択されていない場合
    if(!isset($_POST["file"])){
        header('location: index.html');
        exit;
    }

    if(isset($_POST["file"])){
        $result = array();
        //ファイルの数だけループを回し、$resultにユーザのデータを格納していく
        foreach($_POST["file"] as $key => $val){
            $file = fopen(TARGET_DIR.$val, "r");
            //ファイルがある場合は、1行ずつ読込
            if($file){
                while($line = fgets($file)){
                    // ','でデータが区切ってあるので、データを分割
                    list($user, $vote1, $vote2, $vote3, $date) = explode(",", $line);
                    //ユーザのデータがなければデータを挿入 OR ユーザの投票データがあって、今回のデータの方が最新の場合、データの更新
                    if(!isset($result[$user]) || (isset($result[$user]) && strtotime($date) > strtotime($result[$user]["date"]))){
                        $result[$user] =  array("user" => $user, "vote1" => $vote1, "vote2" => $vote2, "vote3" => $vote3, "date" => $date);
                    }
                }
            }
            fclose($file);
        }
        touch(DIST_FILE);
        $current = "";
        //データの取得
        foreach ($result as $key => $value) {
            $current .= $value["user"] . "," . $value["vote1"] . "," . $value["vote2"] . "," . $value["vote3"] . "\n";
        }
        //ファイルに書き込み
        file_put_contents(DIST_FILE, $current);

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
