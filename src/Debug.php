<?php
/**
 * @Author:             林澜叶(linlanye)
 * @Contact:            <linlanye@sina.cn>
 * @Date:               2017-07-06 13:54:12
 * @Modified time:      2019-01-16 14:30:13
 * @Description:        调试类规范，用于收集调试或系统信息
 */
namespace basement;

trait Debug
{
    /**
     * 当前调试名或标识名，用于标识一个信息容器
     * @var string
     */
    protected $__name = 'default';

    /**
     * 设置当前实例的标识名
     * @param  string $name 调试名或标识
     * @return bool         是否设置成功
     */
    public function setName(string $name): bool
    {
        $this->__name = $name;
        return true;
    }

    /**
     * 获得当前实例的标识名
     * @return bool 标识名
     */
    public function getName(): string
    {
        return $this->__name;
    }

    /**
     * 在当前标识名下，读取目标键名中的信息
     * @param  string $key 目标键名
     * @return mixed|null  读取的信息，失败或无时返回null
     */
    public function get(string $key)
    {}

    /**
     * 在当前标识名下，对目标键名写入信息
     * @param  string $key  目标键名
     * @param  mixed  $info 写入的信息内容
     * @return bool         是否设置成功
     */
    public function set(string $key, $info): bool
    {}

    /**
     * 在当前标识名下，对目标键中的末尾追加信息
     * @param  string $key  目标键名
     * @param  mixed  $info 追加的信息内容
     * @return bool         是否追加成功
     */
    public function append(string $key, $info): bool
    {}

    /**
     * 一次性写入当前标识名下的所有信息
     * @param array $data 所有要写入的信息，会覆盖老信息
     * @return bool       是否写入成功
     */
    public function setAll(array $data): bool
    {}

    /**
     * 一次性读取当前标识名下的所有信息
     * @return array|null 由键值对构成的信息，失败或无时返回null
     */
    public function getAll():  ? array
    {}

    /**
     * 打印变量信息
     * @param  mixed $arg      需打印的变量
     * @param  array $moreArgs 多个变量同时打印
     * @return bool            是否打印成功
     */
    public static function dump($arg, ...$moreArgs) : bool
    {}

    /**
     * 设置某个旗帜起点，用于收集系统信息（位于该旗帜的起点和结束点之间）
     * @param  string $flag 旗帜名，用于标记唯一一个旗帜
     * @return bool         起点设置是否成功
     */
    public static function beginFlag(string $flag = 'default'): bool
    {}

    /**
     * 设置某个旗帜结束点，用于收集系统信息（位于该旗帜的起点和结束点之间）
     * @param  string $flag 旗帜名，用于标记唯一一个旗帜
     * @return bool         结束点设置是否成功
     */
    public static function endFlag(string $flag = 'default'): bool
    {}

    /**
     * 获得目标旗帜收集的系统信息
     * @param  string $flag 旗帜名
     * @return mixed|null   该旗帜下收集的信息，失败或无时返回null
     */
    public static function getFlag(string $flag = 'default')
    {}
}
