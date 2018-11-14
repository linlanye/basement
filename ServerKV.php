<?php
/**
 * @Author:             林澜叶(linlanye)
 * @Contact:            <linlanye@sina.cn>
 * @Date:               2017-08-03 10:29:05
 * @Modified time:      2018-07-13 15:20:18
 * @Description:        操作KV型服务器类规范
 */
namespace Basement;

trait ServerKV
{

    /**
     * 读取目标键值
     * @param  string $key 键名
     * @return mixed|null  读取的键值，错误或失败时返回null
     */
    public function get(string $key)
    {}

    /**
     * 设置目标键值
     * @param  string $key   键名
     * @param  mixed  $value 键值
     * @param  int    $life  该键有效时长(以秒为单位)，为0则不过期
     * @return bool          是否设置成功
     */
    public function set(string $key, $value, int $life = 0): bool
    {}

    /**
     * 删除目标键
     * @param  string $key 键名
     * @return bool        是否删除成功
     */
    public function delete(string $key): bool
    {}

    /**
     * 目标键是否存在
     * @param  string $key 键名
     * @return bool        是否存在
     */
    public function exists(string $key): bool
    {}

    /**
     * 清空删除所有键值
     * @return bool 是否清空成功
     */
    public function flush(): bool
    {}
}
