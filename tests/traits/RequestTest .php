<?php
/**
 * @Author:             林澜叶(linlanye)
 * @Contact:            <linlanye@sina.cn>
 * @Date:               2018-12-07 09:01:07
 * @Modified time:      2018-12-07 21:29:34
 * @Description:        对Request组件进行测试，由于无法得知具体的实现通过获取哪些信息来确定Request方法的返回值，所以只测试返回是否正确
 */
namespace basement\tests;

use Linker;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    //测试读写参数
    public function testGetSet()
    {
        $method = 'basement_test_' . md5(mt_rand());
        $this->assertNull(Linker::Request()::get($method));

        $params = [md5(mt_rand())];
        $this->assertTrue(Linker::Request()::set($method, $params));
        $this->assertSame(Linker::Request()::get($method), $params);

        //无法确定setCurrent是否成功
        $this->assertTrue(is_bool(Linker::Request()::setCurrent($params)));

        $r = Linker::Request()::getCurrent();
        $this->assertTrue(is_null($r) || is_array($params));
    }

    //测试其他方法，只测试返回类型是否一致
    public function testOthers()
    {
        $header = Linker::Request()::getHeader(md5(mt_rand()));
        $this->assertTrue(is_null($header) || is_string($header));

        $method = Linker::Request()::getMethod();
        $this->assertTrue(is_null($method) || is_string($method));

        $host = Linker::Request()::getHost();
        $this->assertTrue(is_null($host) || is_string($host));

        $port = Linker::Request()::getPort();
        $this->assertTrue(is_null($port) || is_int($port));

        $url = Linker::Request()::getURL();
        $this->assertTrue(is_null($url) || is_string($url));

        $protocol = Linker::Request()::getProtocol();
        $this->assertTrue(is_null($protocol) || is_string($protocol));

        $IP = Linker::Request()::getIP();
        $this->assertTrue(is_null($IP) || is_string($IP));
    }
}
