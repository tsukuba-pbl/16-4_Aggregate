<?php
    require_once(dirname(__FILE__).'/../../public/class/FileMake.php');
    use PHPUnit\Framework\TestCase;

    class FileMakeTest extends PHPUnit_Framework_TestCase {
    /**
     * @var Arithmetic
     */
    protected $object;

    private $oneFile = array(
        "hoge" => array(
            "user" => "hoge",
            "vote1" => "2",
            "vote2" => "5",
            "vote3" => "6",
            "date" => "2016/10/03 10:01:10"
        ),
        "foo" => array(
            "user" => "foo",
            "vote1" => "0",
            "vote2" => "2",
            "vote3" => "5",
            "date" => "2016/10/03 10:00:10"
        ),
        "bar" => array(
            "user" => "bar",
            "vote1" => "6",
            "vote2" => "7",
            "vote3" => "8",
            "date" => "2016/10/03 10:10:00"
        ),
        "ferret" => array(
            "user" => "ferret",
            "vote1" => "4",
            "vote2" => "6",
            "vote3" => "9",
            "date" => "2016/10/03 10:40:00"
        )
    );

    private $twoFiles = array(
        "hoge" => array(
            "user" => "hoge",
            "vote1" => "2",
            "vote2" => "5",
            "vote3" => "6",
            "date" => "2016/10/03 10:01:10"
        ),
        "foo" => array(
            "user" => "foo",
            "vote1" => "0",
            "vote2" => "2",
            "vote3" => "5",
            "date" => "2016/10/03 10:00:10"
        ),
        "bar" => array(
            "user" => "bar",
            "vote1" => "1",
            "vote2" => "2",
            "vote3" => "3",
            "date" => "2016/10/03 10:30:00"
        ),
        "ferret" => array(
            "user" => "ferret",
            "vote1" => "4",
            "vote2" => "6",
            "vote3" => "9",
            "date" => "2016/10/03 10:40:00"
        ),
        "test" => array(
            "user" => "test",
            "vote1" => "1",
            "vote2" => "6",
            "vote3" => "9",
            "date" => "2016/10/03 10:02:00"
        )
    );

    /**
     * setUpは各テストメソッドが実行される前に実行する
     */
    protected function setUp() {
        // テストするオブジェクトを生成する
        $this->object = new FileMake(dirname(__FILE__)."/resource/");
    }

    /*
        結果をファイルに書き込みする処理の検証
    */
    public function test_writeLatestUserData(){
        //ファイルへの書き込み
        $this->object->writeLatestUserData(dirname(__FILE__)."/resource/result.csv", $this->twoFiles);
        //書き込み出来たかのAssert
        $this->assertEquals(
            $this->object->read(dirname(__FILE__)."/resource/result.csv"),
            array(
                "hoge,2,5,6",
                "foo,0,2,5",
                "bar,1,2,3",
                "ferret,4,6,9",
                "test,1,6,9"
            )
        );

        // 結果の対象ファイルを削除
        unlink(dirname(__FILE__)."/resource/result.csv");
    }

    /*
        ファイル数が0つの場合の検証
    */
    public function test_getUserData_nothing(){
        $this->assertEquals(
            array(
            ),
            $this->object->getUserData(array())
        );
    }
    /*
        ファイル数が1つの場合の検証
    */
    public function test_getUserData_aFile(){
        $this->assertEquals(
            $this->oneFile,
            $this->object->getUserData(array("android1.csv"))
        );
    }
    /*
        ファイル数が2つの場合の検証
    */
    public function test_getUserData_Files(){
        $this->assertEquals(
            $this->twoFiles,
            $this->object->getUserData(array("android1.csv", "android2.csv"))
        );
    }
}
