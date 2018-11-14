<?php
/**
 * @Author:             林澜叶(linlanye)
 * @Contact:            <linlanye@sina.cn>
 * @Date:               2017-06-20 11:53:48
 * @Modified time:      2018-07-13 15:48:30
 * @Description:        HTTP请求类规范。一次请求全局唯一，多个请求方法类型可以并存，但只有一个是当前
 *                     ，对请求中的某个方法携带的参数可以做读写
 */
namespace basement;

trait Request
{
    /**
     * 设置某个请求方法所携带的所有参数
     * @param string $method     该请求方法类型
     * @param array  $parameters 该请求方法携带的所有参数，数组键名为参数名，键值为参数值
     */
    public static function set(string $method, array $parameters): bool
    {}

    /**
     * 设置本次请求方法携带的所有参数
     * @param array $parameters 本次请求方法携带的所有参数，数组键名为参数名，键值为参数值
     */
    public static function setCurrent(array $parameters): bool
    {}

    /**
     * 获取某个请求方法所携带的所有参数
     * @param  string $method 该请求方法名
     * @return mixed|null     键名为参数名，键值为参数值构成的数组，无则返回null
     */
    public static function get(string $method):  ? array
    {}

    /**
     * 获取本次请求方法携带的所有参数
     * @return array|null 键名为参数名，键值为参数值构成的数组，无则返回null
     */
    public static function getCurrent() :  ? array
    {}

    /**
     * 获取本次请求的某个请求头值
     * @param  string $header 请求头名
     * @return string|null    请求头值，无则返回null
     */
    public static function getHeader(string $header) :  ? string
    {}

    /**
     * 获取本次请求的类型
     * @return string 请求类型
     */
    public static function getMethod() : string
    {}

    /**
     * 获取本次请求的相对URL地址，不应含有不含query string
     * @return string 请求的相对URL地址
     */
    public static function getURL(): string
    {}

    /**
     * 获取本次请求的协议
     * @return string 协议，如HTTP/1.1或HTTPS
     */
    public static function getProtocol(): string
    {}

    /**
     * 获取本次发起请求的客户端IP
     * @return string 客户端IP
     */
    public static function getIP(): string
    {}
}
