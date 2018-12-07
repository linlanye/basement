<?php
/**
 * @Author:             林澜叶(linlanye)
 * @Contact:            <linlanye@sina.cn>
 * @Date:               2018-12-07 09:01:07
 * @Modified time:      2018-12-07 21:35:34
 * @Description:        对Log组件进行测试，对8个psr-3方法和record方法都不做具体测试，避免有异步或远程日志组件无法测试的情况。
 */
namespace basement\tests;

use Linker;
use PHPUnit\Framework\TestCase;

class LogTest extends TestCase
{
    //测试日志名读写
    public function testName()
    {
        $Log  = Linker::Log(true);
        $name = 'basement_test_' . md5(mt_rand());
        $this->assertTrue($Log->setName($name));
        $this->assertSame($Log->getName(), $name);
    }

    //只测试9个写方法是否存在
    public function testRecord()
    {
        $Log = Linker::Log(true);
        $this->assertTrue(method_exists($Log, 'record'));
        $this->assertTrue(method_exists($Log, 'debug'));
        $this->assertTrue(method_exists($Log, 'info'));
        $this->assertTrue(method_exists($Log, 'notice'));
        $this->assertTrue(method_exists($Log, 'warning'));
        $this->assertTrue(method_exists($Log, 'error'));
        $this->assertTrue(method_exists($Log, 'critical'));
        $this->assertTrue(method_exists($Log, 'alert'));
        $this->assertTrue(method_exists($Log, 'emergency'));
    }
}
