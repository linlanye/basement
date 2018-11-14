<?php
/**
 * @Author:             林澜叶(linlanye)
 * @Contact:            <linlanye@sina.cn>
 * @Date:               2017-06-20 11:53:48
 * @Modified time:      2018-07-11 15:36:53
 * @Description:        配置类规范，建议实现本类时不调用任何basement类，防止出现间接递归
 */
namespace basement;

trait Config
{
    /**
     * 读取配置内容
     * @param  string $name 配置名
     * @return array|null   配置内容
     */
    public static function get(string $name):  ? array
    {}

    /**
     * 改变置配置内容
     * @param string $name     配置名
     * @param array  $content  配置内容
     */
    public static function set(string $name, array $content) : bool
    {}

    /**
     * 配置是否已加载
     * @param  string $name 配置名
     * @return bool         是否已加载
     */
    public static function exists(string $name): bool
    {}
}
