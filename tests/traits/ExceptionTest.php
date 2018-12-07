<?php
/**
 * @Author:             林澜叶(linlanye)
 * @Contact:            <linlanye@sina.cn>
 * @Date:               2018-12-07 09:01:07
 * @Modified time:      2018-12-07 20:41:12
 * @Description:        对Exception组件进行测试
 */
namespace basement\tests;

use Exception;
use Linker;
use PHPUnit\Framework\TestCase;

class ExceptionTest extends TestCase
{
    /**
     * 测试抛出异常
     * @expectedException Exception
     */
    public function testThrow()
    {
        $Exception = Linker::Exception();
        throw new $Exception("testThrow");
    }
    /**
     * 测试抛出异常方法
     * @expectedException Exception
     */
    public function testMethodThrow()
    {
        Linker::Exception()::throw ("testMethodThrow");
    }

    //测试获得类型和次级消息
    public function testTypeSecondmessage()
    {
        $type   = md5(mt_rand());
        $submsg = md5(mt_rand());

        //通过throw方法扔出
        try {
            Linker::Exception()::throw ('msg', 1, $type, $submsg);
        } catch (Exception $e) {
            $this->assertSame($e->getType(), $type);
            $this->assertSame($e->getSecondMessage(), $submsg);
        }

        //通过实例化扔出
        try {
            $Exception = Linker::Exception();
            throw new $Exception('msg', 1, $type, $submsg);
        } catch (Exception $e) {
            $this->assertSame($e->getType(), $type);
            $this->assertSame($e->getSecondMessage(), $submsg);
        }

    }
}
