<?php
/**
 * @Author:             林澜叶(linlanye)
 * @Contact:            <linlanye@sina.cn>
 * @Date:               2017-06-20 11:53:48
 * @Modified time:      2018-11-20 11:03:40
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
     * @param bool   是否设置成功
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

    /**
     * 向已有的配置替换内容，若配置内容不存在，则等效于set方法
     * @param  string $name        配置名
     * @param  array  $content     替换内容
     * @param  bool   $isRecursive 是否递归替换，默认否
     * @return bool   是否替换成功
     */
    public static function replace(string $name, array $content, bool $isRecursive = false): bool
    {}
}
