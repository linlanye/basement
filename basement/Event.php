<?php
/**
 * @Author:             林澜叶(linlanye)
 * @Contact:            <linlanye@sina.cn>
 * @Date:               2017-07-07 14:55:37
 * @Modified time:      2018-06-11 14:44:46
 * @Description:        事件类规范，用于设置和执行事件
 */
namespace basement;

trait Event
{
    /**
     * 绑定目标事件的执行规则
     * @param  string   $event    目标事件名
     * @param  callable $Callback 目标事件的执行规则，使用回调执行
     * @param  int      $times    该事件可执行的次数，0为无限次
     * @return bool               是否绑定成功
     */
    public static function on(string $event, callable $Callback, int $times = 0): bool
    {}

    /**
     * 释放绑定的事件名
     * @param  string $event 事件名
     * @return bool          是否释放成功
     */
    public static function off(string $event): bool
    {}

    /**
     * 目标事件名是否已绑定规则
     * @param  string $event 目标事件名
     * @return bool          该事件是否已绑定规则
     */
    public static function exists(string $event): bool
    {}

    /**
     * 触发某个事件名
     * @param  string $event  事件名
     * @param  array  $params 依次传入该事件回调规则的参数，数组顺序为入参顺序
     * @return mixed|null     绑定事件执行后的返回值，执行失败返回null
     */
    public static function trigger(string $event, ...$params)
    {}
}
