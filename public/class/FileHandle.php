<?php
    class FileHandle{
        private $filehandler;
        private $filename;

        public function __construct($filename = ""){
            $this->filename = $filename;
        }
        /*
            ファイルを読み取り専用でオープン
            return 配列
        */
        public function read($filename){
            $fileData = []; //ファイルのデータを1行ごとに保持する配列
            try{
                if(file_exists($filename)){
                    $this->filehandler = fopen($filename, "r");
                } else {
                    throw new Exception("Error: " . $filename . " doesn't exist.", 1);
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            //ファイルの内容を1行ずつ配列に格納
            while($line = fgets($this->filehandler)){
                $fileData[] = $line;
            }
            fclose($this->filehandler);
            return $fileData;
        }

        /*
            ファイルに新規書き込み(上書きしない)
        */
        public function initWrite($filename, $data){
            if(!file_exists($filename)){
                touch($filename);
            }
            file_put_contents($filename, $data);
        }
    }
