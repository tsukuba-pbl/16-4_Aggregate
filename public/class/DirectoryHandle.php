<?php
    class DirectoryHandle{
        private $dirname;
        public function __construct($dirname){
            $this->dirname = $dirname;
        }
        /*
            ディレクトリ内のファイル名を返すメソッド
        */
        public function fileList(){
            $files = [];
            if(is_dir($this->dirname) && $handle = opendir($this->dirname)){
                while(($file = readdir($handle)) !== false){
                    /*
                        ファイルのみ対象
                    */
                    if(filetype($path = $this->dirname . $file) == "file"){
                        //日本語からUTF-8に変換
                        $file = mb_convert_encoding($file, "UTF-8", "SJIS");
                        $files[] = $file;
                    }
                }
            }
            return $files;
        }
    }
