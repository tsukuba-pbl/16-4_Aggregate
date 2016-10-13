<?php
    use PHPUnit\Framework\TestCase;
    require_once('../public/class/DirectoryHandle.php');

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
        $this->object = new DirectoryHandle("./csv/");
    }

    /**
     * 足し算関数の検証
     */
    public function testAdd() {
        // 引数に3,5を渡すと8が返ってくることを確認する
        $this->assertEquals(8, 3+5);
        // 引数に15,30を渡すと45が返ってくることを確認する
        $this->assertEquals(45, 15 + 20);
    }
}
