<?php
/**
 * @Author:             林澜叶(linlanye)
 * @Contact:            <linlanye@sina.cn>
 * @Date:               2018-12-06 15:53:59
 * @Modified time:      2018-12-07 15:52:13
 * @Description:        测试Linker
 */

namespace basement\tests;

require dirname(dirname(__DIR__)) . '/boot.php'; //引入Linker类

use Exception;
use Linker;
use PHPUnit\Framework\TestCase;

class LinkerTest extends TestCase
{

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

        //替换
        $class2 = md5(mt_rand());
        Linker::register([
            $Component => $class2,
        ]);
        $this->assertSame(Linker::$Component(), $class2);

        //移除
        $this->assertTrue(Linker::remove($Component));
        $this->assertFalse(Linker::exists($Component));
        $this->assertSame(Linker::getAll(), []); //获取所有
    }

    //测试basement自带组件
    public function testBasementComponents()
    {
        //所有标准组件
        Linker::register([
            'ServerSQL'   => 'stdClass',
            'ServerKV'    => 'stdClass',
            'ServerLocal' => 'stdClass',
            'ServerQueue' => 'stdClass',
            'ServerFile'  => 'stdClass',
            'Exception'   => 'stdClass',
            'Log'         => 'stdClass',
            'Debug'       => 'stdClass',
            'Lang'        => 'stdClass',
            'Request'     => 'stdClass',
            'Config'      => 'stdClass',
            'Event'       => 'stdClass',
        ]);
        $all      = array_flip(array_keys(Linker::getAll()));
        $basement = array_flip(Linker::getBasements());
        $basement = array_change_key_case($basement, CASE_UPPER);
        sort($basement);
        sort($all);
        $this->assertSame($all, $basement);

        //访问标准方法
        $this->assertSame(Linker::Config(), 'stdClass');
        $this->assertSame(Linker::Debug(), 'stdClass');
        $this->assertSame(Linker::Event(), 'stdClass');
        $this->assertSame(Linker::Exception(), 'stdClass');
        $this->assertSame(Linker::Lang(), 'stdClass');
        $this->assertSame(Linker::Log(), 'stdClass');
        $this->assertSame(Linker::ServerFile(), 'stdClass');
        $this->assertSame(Linker::ServerKV(), 'stdClass');
        $this->assertSame(Linker::ServerLocal(), 'stdClass');
        $this->assertSame(Linker::ServerQueue(), 'stdClass');
        $this->assertSame(Linker::ServerSQL(), 'stdClass');

        //返回对象
        $this->assertSame(get_class(Linker::Config(true)), 'stdClass');
        $this->assertSame(get_class(Linker::Debug(true)), 'stdClass');
        $this->assertSame(get_class(Linker::Event(true)), 'stdClass');
        $this->assertSame(get_class(Linker::Exception(true)), 'stdClass');
        $this->assertSame(get_class(Linker::Lang(true)), 'stdClass');
        $this->assertSame(get_class(Linker::Log(true)), 'stdClass');
        $this->assertSame(get_class(Linker::ServerFile(true)), 'stdClass');
        $this->assertSame(get_class(Linker::ServerKV(true)), 'stdClass');
        $this->assertSame(get_class(Linker::ServerLocal(true)), 'stdClass');
        $this->assertSame(get_class(Linker::ServerQueue(true)), 'stdClass');
        $this->assertSame(get_class(Linker::ServerSQL(true)), 'stdClass');

        Linker::remove('ServerSQL');
        Linker::remove('ServerKV');
        Linker::remove('ServerLocal');
        Linker::remove('ServerQueue');
        Linker::remove('ServerFile');
        Linker::remove('Exception');
        Linker::remove('Log');
        Linker::remove('Debug');
        Linker::remove('Lang');
        Linker::remove('Request');
        Linker::remove('Config');
        Linker::remove('Event');

        $this->assertSame(Linker::getAll(), []);
    }

    /**
     * 测试访问未注册抛出异常
     * @expectedException Exception
     */
    public function testRegistereException1()
    {
        $Component = md5(mt_rand());
        Linker::$Component();
    }

    /**
     * 测试注册核心组件，普通移除抛出异常
     * @expectedException Exception
     */
    public function testRegistereException2()
    {
        $Component = 'testLinker_adgi1829';
        $class     = md5(mt_rand());
        Linker::register([
            $Component => $class,
        ], true);

        $this->assertTrue(Linker::exists($Component));
        $this->assertSame(Linker::$Component(), $class); //动态获得组件名
        $this->assertSame(Linker::getAll(), [strtoupper($Component) => [$class, true]]); //获取所有

        $this->assertTrue(Linker::remove($Component));
    }

    /**
     * 测试重复注册核心组件，抛出异常
     * @expectedException Exception
     */
    public function testRegistereException3()
    {
        $Component = 'testLinker_adgi1829';
        Linker::register([
            $Component => '',
        ]);

    }
}
