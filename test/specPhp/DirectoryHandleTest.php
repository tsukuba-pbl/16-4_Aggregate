<?php
    require_once(dirname(__FILE__).'/../../public/class/DirectoryHandle.php');
    use PHPUnit\Framework\TestCase;

    class DirectoryHandleTest extends PHPUnit_Framework_TestCase {
    /**
     * @var Arithmetic
     */
    protected $object;

    /**
     * setUpは各テストメソッドが実行される前に実行する
     */
    protected function setUp() {
        // テストするオブジェクトを生成する
        $this->object = new DirectoryHandle(dirname(__FILE__)."/resource/");
    }

    /*
        指定のファイルが取得できているかの検証
    */
    public function test_fileList(){
        $this->assertEquals(array("android1.csv", "android2.csv"), $this->object->fileList());
    }
}
