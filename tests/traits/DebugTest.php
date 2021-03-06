<?php
/**
 * @Author:             林澜叶(linlanye)
 * @Contact:            <linlanye@sina.cn>
 * @Date:               2018-12-07 09:01:07
 * @Modified time:      2018-12-07 20:42:39
 * @Description:        对Debug组件进行测试
 */
namespace basement\tests;

use Linker;
use PHPUnit\Framework\TestCase;

class DebugTest extends TestCase
{
    //测试调试名设置
    public function testName()
    {
        $Debug = Linker::Debug(true);
        $name  = 'basement_test_' . md5(mt_rand());
        $this->assertTrue($Debug->setName($name));
        $this->assertSame($Debug->getName(), $name);
    }

    //测试读写
    public function testSetGetAppend()
    {
        $Debug = Linker::Debug(true);
        $name  = 'basement_test_' . md5(mt_rand());
        $Debug->setName($name);

        $key1 = md5(mt_rand());
        $key2 = md5(mt_rand());
        $v1   = md5(mt_rand());
        $v2   = md5(mt_rand());

        //set, get
        $this->assertNull($Debug->getAll()); //无数据
        $this->assertNull($Debug->get($key1)); //无数据

        $this->assertTrue($Debug->set($key1, $v1));
        $this->assertTrue($Debug->set($key2, $v2));

        $this->assertSame($Debug->get($key1), $v1);
        $this->assertSame($Debug->get($key2), $v2);
        $this->assertSame($Debug->getAll(), [$key1 => $v1, $key2 => $v2]);

        $this->assertTrue($Debug->setAll([$key1 => $v1]));
        $this->assertSame($Debug->getAll(), [$key1 => $v1]);

        $this->assertNull($Debug->get($key2)); //无数据

        //append
        $Debug->set($key1, $v1); //非数组情况
        $this->assertTrue($Debug->append($key1, $v2));
        $this->assertSame($Debug->get($key1), [$v1, $v2]);

        $Debug->set($key1, [$v1]); //数组情况
        $Debug->append($key1, $v1);
        $this->assertSame($Debug->get($key1), [$v1, $v1]);
    }

    //测试打印
    public function testDump()
    {
        $var1 = 'basement_var_' . md5(mt_rand());
        $var2 = 'basement_var_' . md5(mt_rand());
        $var3 = 'basement_var_' . md5(mt_rand());

        ob_start();
        Linker::Debug()::dump($var1, $var2, $var3);
        $content = ob_get_clean();

        $this->assertRegExp("/$var1/", $content);
        $this->assertRegExp("/$var2/", $content);
        $this->assertRegExp("/$var3/", $content);
    }

    //测试flag
    public function testFlag()
    {
        $name = 'basement_test_' . md5(mt_rand());

        $this->assertNull(Linker::Debug()::getFlag($name)); //未开始

        $this->assertTrue(Linker::Debug()::beginFlag($name));
        //模拟执行的代码
        for ($i = 0; $i < 100000; $i++) {
        }
        $this->assertTrue(Linker::Debug()::endFlag($name));

        $this->assertFalse(empty(Linker::Debug()::getFlag($name))); //收集完毕后存在信息
    }
}
