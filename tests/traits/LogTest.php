<?php
/**
 * @Author:             林澜叶(linlanye)
 * @Contact:            <linlanye@sina.cn>
 * @Date:               2018-12-07 09:01:07
 * @Modified time:      2018-12-07 21:12:31
 * @Description:        对Log组件进行测试，对8个psr-3方法和record方法都不做测试，避免有异步或远程日志组件无法测试的情况。
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

}
