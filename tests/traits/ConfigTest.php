<?php
/**
 * @Author:             林澜叶(linlanye)
 * @Contact:            <linlanye@sina.cn>
 * @Date:               2018-12-07 09:01:07
 * @Modified time:      2018-12-07 10:56:59
 * @Description:        对Config组件进行测试
 */
namespace basement\tests;

use Linker;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{

    public function testRun()
    {
        $this->doMethodSetGetExists();
        $this->doMethodReplace();
    }

    //测试设置、读取、判断存在
    private function doMethodSetGetExists()
    {
        echo 'test Config with method: set(), get(), exists().' . PHP_EOL;
        $name = md5(mt_rand());
        $data = [md5(mt_rand())];

        //未设置前判断
        $this->assertFalse(Linker::Config()::exists($name));
        $this->assertNull(Linker::Config()::get($name));

        //设置后判断
        $this->assertTrue(Linker::Config()::set($name, $data));
        $this->assertTrue(Linker::Config()::exists($name));
        $this->assertSame(Linker::Config()::get($name), $data);

        //清除
        $this->assertTrue(Linker::Config()::set($name, []));
    }

    //测试替换
    private function doMethodReplace()
    {
        echo 'test Config with method: replace().' . PHP_EOL;
        $name         = md5(mt_rand());
        $key1         = md5(mt_rand());
        $key2         = md5(mt_rand());
        $v1           = md5(mt_rand());
        $v2           = md5(mt_rand());
        $data         = [$key1 => [$key1 => $v1, $key2 => $v1], $key2 => $v2];
        $replace_data = [$key1 => [$key1 => $v2]];

        //测试整体替换
        Linker::Config()::replace($name, $data); //不存在等效于set
        $this->assertSame(Linker::Config()::get($name), $data);

        Linker::Config()::replace($name, $replace_data);
        $this->assertSame(Linker::Config()::get($name), array_replace($data, $replace_data));

        //测试递归替换
        Linker::Config()::set($name, $data);
        Linker::Config()::replace($name, $replace_data, true);
        $this->assertSame(Linker::Config()::get($name), array_replace_recursive($data, $replace_data));
    }
}
