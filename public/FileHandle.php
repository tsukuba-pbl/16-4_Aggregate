<?php
    class FileHandle{
        private $filehandler;
        private $filename;
        private $dirname;
        public function __construct($dirname, $filename){
            $this->filename = $filename;
            $this->dirname = $dirname;
        }
        private function fopenRead($filename = $this->filename){
            try{
                if(file_exists($filename)){
                    $this->filehandler = fopen($filename, "r");
                } else {
                    throw new Exception("Error: " . $filename . " doesn't exist.", 1);
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        public function read(){
            private $fileData = [];
            while($line = fgets($this->filehandler)){
                $fileData[] = $line;
            }
            reutrn $fileData;
        }
    }
