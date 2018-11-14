<?php
/**
 * @Author:             林澜叶(linlanye)
 * @Contact:            <linlanye@sina.cn>
 * @Date:               2017-06-20 11:53:48
 * @Modified time:      2018-07-13 15:20:09
 * @Description:        日志记录类规范，兼容psr-3，并可自定义日志类型
 */
namespace basement;

trait Log
{
    /**
     * 日志名，用于标记当前日志
     * @var string
     */
    protected $__name = 'default';

    /**
     * 设置当前日志名
     * @param string $name 日志名
     * @return bool        是否设置成功
     */
    public function setName(string $name): bool
    {
        $this->__name = $name;
        return true;
    }

    /**
     * 获得当前日志名
     * @return string 当前日志名
     */
    public function getName(): string
    {
        return $this->__name;
    }

    /**
     * 使用自定义的日志类型记录日志
     * @param  string $content 日志内容
     * @param  string $type    日志类型
     * @return bool            是否记录成功
     */
    public function record(string $content, string $type): bool
    {}

    /**
     * 兼容psr-3规划
     * @param  string $content 日志内容
     * @return bool            是否记录成功
     */
    public function debug(string $content): bool
    {}
    public function info(string $content): bool
    {}
    public function notice(string $content): bool
    {}
    public function warning(string $content): bool
    {}
    public function error(string $content): bool
    {}
    public function critical(string $content): bool
    {}
    public function alert(string $content): bool
    {}
    public function emergency(string $content): bool
    {}
}
