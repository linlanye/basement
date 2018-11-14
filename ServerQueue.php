<?php
/**
 * @Author:             林澜叶(linlanye)
 * @Contact:            <linlanye@sina.cn>
 * @Date:               2017-05-03 10:29:05
 * @Modified time:      2018-07-13 15:20:24
 * @Description:        操作队列服务器类规范
 */
namespace basement;

trait ServerQueue
{
    /**
     * 当前队列名
     * @var string
     */
    protected $__name = 'default';

    /**
     * 设置当前队列名
     * @param string $name 队列名
     * @return bool        是否设置成功
     */
    public function setName(string $name): bool
    {
        $this->__name = $name;
        return true;
    }

    /**
     * 获得当前队列名
     * @return string 队列名
     */
    public function getName(): string
    {
        return $this->__name;
    }

    /**
     * 往队列末尾放入一个元素
     * @param  mixed $data 放入的元素
     * @return bool        是否成功
     */
    public function push($data): bool
    {}

    /**
     * 往队列末尾放入多个元素
     * @param  array $data 数组的每一个元素为方入的元素
     * @return bool        是否成功
     */
    public function multiPush(array $data): bool
    {}

    /**
     * 弹出元素
     * @param   int $amount 需要弹出的元素数量
     * @return  array       成功则以数组形式返回，键值为每一个弹出的元素，格式如array($data_1,...$data_n)，失败或无数据则返回null
     */
    public function pop(int $amount = 1):  ? array
    {}

    /**
     * 当前队列是否为空
     * @return bool 是否为空
     */
    public function isEmpty() : bool
    {}

    /**
     * 获得队列中元素个数
     * @return int 元素个数
     */
    public function getSize(): int
    {}
}
