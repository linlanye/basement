<?php
/**
 * @Author:             林澜叶(linlanye)
 * @Contact:            <linlanye@sina.cn>
 * @Date:               2018-12-06 15:53:59
 * @Modified time:      2018-12-06 17:32:54
 * @Description:        测试Linker
 */

namespace basement\tests;

use Exception;
use Linker;
use PHPUnit\Framework\TestCase;

class LinkerTest extends TestCase
{
    /**
     * 测试访问未注册抛出异常
     * @expectedException Exception
     */
    public function testNotRegistered()
    {
        $Component = md5(mt_rand());
        Linker::$Component();
    }

    //测试基础功能
    public function testCommon()
    {
        //是否存在
        $Component = md5(mt_rand());
        $class     = md5(mt_rand());
        $this->assertFalse(Linker::exists($Component));

        //注册后存在
        Linker::register([
            $Component => $class,
        ]);
        $this->assertTrue(Linker::exists($Component));
        $this->assertSame(Linker::$Component(), $class); //动态获得组件名
        $this->assertSame(Linker::getAll(), [strtoupper($Component) => [$class, false]]); //获取所有

        //移除
        $this->assertTrue(Linker::remove($Component));
        $this->assertFalse(Linker::exists($Component));
        $this->assertSame(Linker::getAll(), []); //获取所有
    }

    /**
     * 测试注册核心组件，普通移除抛出异常
     * @expectedException Exception
     */
    public function testRegisterCore()
    {
        $Component = md5(mt_rand());
        $class     = md5(mt_rand());
        Linker::register([
            $Component => $class,
        ], true);

        $this->assertTrue(Linker::exists($Component));
        $this->assertSame(Linker::$Component(), $class); //动态获得组件名
        $this->assertSame(Linker::getAll(), [strtoupper($Component) => [$class, true]]); //获取所有

        $this->assertTrue(Linker::remove($Component));
    }

    //常规测试
    public function testGeneral()
    {
        //所有标准组件
        $basement = [
            'Config', 'Debug', 'Event', 'Exception', 'Lang', 'Log', 'Request',
            'ServerFile', 'ServerKV', 'ServerLocal', 'ServerQueue', 'ServerSQL',
        ];
        Linker::register([
            'ServerSQL'   => 'stdclass',
            'ServerKV'    => 'stdclass',
            'ServerLocal' => 'stdclass',
            'ServerQueue' => 'stdclass',
            'Exception'   => 'stdclass',
            'Log'         => 'stdclass',
            'Debug'       => 'stdclass',
            'Lang'        => 'stdclass',
            'Config'      => 'stdclass',
            'Request'     => 'stdclass',
            'Event'       => 'stdclass',
        ]);

        $all = array_keys(Linker::getAll());
        sort($all);
        sort($basement);
        $this->assertSame($all, $basement);

        //访问标准方法
        $this->assertSame(Linker::Config(), 'stdclass');
        $this->assertSame(Linker::Debug(), 'stdclass');
        $this->assertSame(Linker::Event(), 'stdclass');
        $this->assertSame(Linker::Exception(), 'stdclass');
        $this->assertSame(Linker::Lang(), 'stdclass');
        $this->assertSame(Linker::Log(), 'stdclass');
        $this->assertSame(Linker::ServerFile(), 'stdclass');
        $this->assertSame(Linker::ServerKV(), 'stdclass');
        $this->assertSame(Linker::ServerLocal(), 'stdclass');
        $this->assertSame(Linker::ServerQueue(), 'stdclass');
        $this->assertSame(Linker::ServerSQL(), 'stdclass');

        //返回对象
        $this->assertSame(get_class(Linker::Config(true)), 'stdclass');
        $this->assertSame(get_class(Linker::Debug(true)), 'stdclass');
        $this->assertSame(get_class(Linker::Event(true)), 'stdclass');
        $this->assertSame(get_class(Linker::Exception(true)), 'stdclass');
        $this->assertSame(get_class(Linker::Lang(true)), 'stdclass');
        $this->assertSame(get_class(Linker::Log(true)), 'stdclass');
        $this->assertSame(get_class(Linker::ServerFile(true)), 'stdclass');
        $this->assertSame(get_class(Linker::ServerKV(true)), 'stdclass');
        $this->assertSame(get_class(Linker::ServerLocal(true)), 'stdclass');
        $this->assertSame(get_class(Linker::ServerQueue(true)), 'stdclass');
        $this->assertSame(get_class(Linker::ServerSQL(true)), 'stdclass');

    }
}
