<?php
/**
 * @Author:             林澜叶(linlanye)
 * @Contact:            <linlanye@sina.cn>
 * @Date:               2018-12-07 09:01:07
 * @Modified time:      2018-12-07 20:29:06
 * @Description:        对Event组件进行测试
 */
namespace basement\tests;

use Linker;
use PHPUnit\Framework\TestCase;

class EventTest extends TestCase
{

    //测试事件绑定
    public function testOnOffExists()
    {
        $name = 'basement_test_' . md5(mt_rand());
        $this->assertFalse(Linker::Event()::exists($name));

        //绑定
        $this->assertTrue(Linker::Event()::on($name, function () {}));
        $this->assertTrue(Linker::Event()::exists($name));

        //解绑
        $this->assertTrue(Linker::Event()::off($name));
        $this->assertFalse(Linker::Event()::exists($name));
    }

    //测试事件执行
    public function testTrigger()
    {
        $name = 'basement_test_' . md5(mt_rand());
        $r    = md5(mt_rand());

        $this->assertNull(Linker::Event()::trigger($name)); //不存在事件

        Linker::Event()::on($name, function () use ($r) {return $r;}, 1); //绑定一次
        $this->assertSame(Linker::Event()::trigger($name), $r);
        $this->assertNull(Linker::Event()::trigger($name)); //不存在事件
        $this->assertFalse(Linker::Event()::exists($name));
    }
}
