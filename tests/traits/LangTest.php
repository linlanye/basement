<?php
/**
 * @Author:             林澜叶(linlanye)
 * @Contact:            <linlanye@sina.cn>
 * @Date:               2018-12-07 09:01:07
 * @Modified time:      2018-12-07 20:48:46
 * @Description:        对Lang组件进行测试
 */
namespace basement\tests;

use Linker;
use PHPUnit\Framework\TestCase;

class LangTest extends TestCase
{
    //测试标识
    public function testName()
    {
        $Lang = Linker::Lang(true);
        $name = 'basement_test_' . md5(mt_rand());
        $this->assertTrue($Lang->setName($name));
        $this->assertSame($Lang->getName(), $name);
    }

    //测试正确映射
    public function testMapI18nAutoload()
    {
        $chars = md5(mt_rand());

        //注册自动加载
        $r = Linker::Lang()::autoload(function ($name, $i18n) use ($chars) {
            return [$chars => [$name, $i18n]];
        });
        $this->assertTrue($r);

        //设置全局目标语言
        $this->assertTrue(Linker::Lang()::i18n('zh-cn'));

        $Lang = Linker::Lang(true);
        $name = 'basement_test_' . md5(mt_rand());
        $Lang->setName($name);

        //映射测试
        $this->assertSame($Lang->map($chars), [$name, 'zh-cn']);
    }
}
