<?php
    include_once("FileHandle.php");

    //csvのあるフォルダ
    define("TARGET_DIR", "./csv/");
    class FileMake extends FileHandle {
        public function __construct(){
            parent::__construct();
        }
        /*
            ファイルから全ユーザの最新データを取得する
        */
        public function getUserData($files){
            $usersData = [];
            $fileData = [];
            //対象のファイルのデータをすべて読込
            foreach($files as $key => $val){
                $fileData = parent::read(TARGET_DIR.$val);
                foreach ($fileData as $k => $value) {
                    list($user, $vote1, $vote2, $vote3, $date) = explode(",", $value);
                    //ユーザのデータがなければデータを挿入 OR ユーザの投票データがあって、今回のデータの方が最新の場合、データの更新
                    if(!isset($usersData[$user]) || (isset($usersData[$user]) && strtotime($date) > strtotime($usersData[$user]["date"]))){
                        $usersData[$user] =  array("user" => $user, "vote1" => $vote1, "vote2" => $vote2, "vote3" => $vote3, "date" => $date);
                    }
                }
            }
            return $usersData;
        }

        /*
            ユーザ毎のデータをファイルに書き込む用に、1つの変数にまとめる
        */
        private function makeFileContent($usersData){
            $content = "";
            foreach ($usersData as $key => $value) {
                $content .= $value["user"] . "," . $value["vote1"] . "," . $value["vote2"] . "," . $value["vote3"] . "\n";
            }
            return $content;
        }
        /*
            最新のユーザのデータをファイルに書き込み
        */
        public function writeLatestUserData($filename, $usersData){
            parent::initWrite($filename, $this->makeFileContent($usersData));
        }
    }
