<?php
/**
 * @Author:             林澜叶(linlanye)
 * @Contact:            <linlanye@sina.cn>
 * @Date:               2017-08-03 10:29:05
 * @Modified time:      2019-01-16 16:04:36
 * @Description:        操作本地文件类规范，若对文件夹进行操作，文件名可传入空字符
 */
namespace basement;

trait ServerLocal
{
    /**
     * 当前文件操作的路径(所处文件夹)，用于统一管理文件读写根目录
     * @var string
     */
    protected $__path = '/';

    /**
     * 设置当前文件操作的路径
     * @param string $path 是否设置成功
     */
    public function setPath(string $path): bool
    {
        $this->__path = $path;
        return true;
    }

    /**
     * 获得当前文件操作的路径
     * @return string 当前文件操作路径
     */
    public function getPath(): string
    {
        return $this->__path;
    }

    /**
     * 获得目标文件最后修改时间
     * @param  string $fileName 文件名
     * @return int|null         文件最后修改时间，错误或失败返回null
     */
    public function getMTime(string $fileName):  ? int
    {}

    /**
     * 获得目标文件最后访问时间
     * @param  string $fileName 文件名
     * @return int|null         文件最后访问时间，错误或失败返回null
     */
    public function getATime(string $fileName) :  ? int
    {}

    /**
     * 获得目标文件最后修改时间
     * @param  string $fileName 文件名
     * @return int|null         文件最后修改时间，错误或失败返回null
     */
    public function getCTime(string $fileName) :  ? int
    {}

    /**
     * 获得目标文件大小
     * @param  string $fileName 文件名
     * @return int              文件大小，错误或失败返回null
     */
    public function getSize(string $fileName) :  ? int
    {}

    /**
     * 目标文件是否存在
     * @param  string $fileName 文件名
     * @return bool             文件是否存在
     */
    public function exists(string $fileName) : bool
    {}

    /**
     * 删除目标文件
     * @param  string $fileName 文件名
     * @return bool             是否删除成功
     */
    public function remove(string $fileName): bool
    {}

    /**
     * 对目标文件写
     * @param  string $fileName 文件名
     * @param  string $content  文件内容
     * @param  string $mode     写方式，同fopen的mode参数
     * @return bool             是否写成功
     */
    public function write(string $fileName, string $content, string $mode = 'a'): bool
    {}

    /**
     * 对目标文件读
     * @param  string $fileName 文件名
     * @param  string $mode     读方式，同fopen的mode参数
     * @return string           读取到的内容，错误或失败返回null
     */
    public function read(string $fileName, string $mode = 'r'):  ? string
    {}

    /**
     * 目标文件是否可写
     * @param  string $fileName 文件名
     * @return bool             是否可写
     */
    public function isWritable(string $fileName) : bool
    {}

    /**
     * 目标文件是否可读
     * @param  string $fileName 文件名
     * @return bool             是否可读
     */
    public function isReadable(string $fileName): bool
    {}

    /**
     * 读取php脚本返回的内容
     * @param  string $fileName php脚本名
     * @return mixed|null       php脚本返回的内容，失败或错误时返回null
     */
    public function getContents(string $fileName)
    {
        if (!file_exists($this->__path . $fileName)) {
            return null;
        }
        $r = include $this->__path . $fileName;
        return $r === false ? null : $r;
    }
}
