<?php
/**
 * @Author:             林澜叶(linlanye)
 * @Contact:            <linlanye@sina.cn>
 * @Date:               2017-06-20 11:53:48
 * @Modified time:      2018-12-07 20:31:37
 * @Description:        对异常类的兼容性扩展，增加异常类型和异常补充信息，宿主类需继承\Exception类
 */
namespace basement;

trait Exception
{
    /**
     * 当前异常类型
     * @var string
     */
    protected $__type = '';

    /**
     * 用于补充的或次级信息
     * @var string
     */
    protected $__secondMessage = '';

    /**
     * 扩展兼容异常类构造函数
     * @param  string $message        异常信息
     * @param  int    $code           异常代码
     * @param  string $type           异常类型,用于标识异常的种类，类似于使用异常类名标识异常一样
     * @param  string $secondMessage  补充信息,可用于主信息一致，但带有变量消息的情况
     * @return void
     */
    public function __construct(string $message, int $code = 1, string $type = '', string $secondMessage = '')
    {
        $this->__type          = $type;
        $this->__secondMessage = $secondMessage;
        parent::__construct($message, $code);
    }

    /**
     * 获得当前异常类型
     * @return string 异常类型
     */
    public function getType(): string
    {
        return $this->__type;
    }

    /**
     * 获得补充的或次级信息
     * @return string 补充的或次级信息
     */
    public function getSecondMessage(): string
    {
        return $this->__secondMessage;
    }

    /**
     * 封装throw语句，抛出自身
     * @param  string $message       异常信息
     * @param  int    $code          异常代码
     * @param  string $type          异常类型,用于标识异常的种类，类似于使用异常类名标识异常一样
     * @param  string $secondMessage 补充信息,可用于主信息一致，但带有变量消息的情况
     * @return void
     */
    public static function throw(string $message, int $code = 1, string $type = '', string $secondMessage = '') {
        throw new static($message, $code, $type, $secondMessage);
    }
}
