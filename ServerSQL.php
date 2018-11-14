<?php
/**
 * @Author:             林澜叶(linlanye)
 * @Contact:            <linlanye@sina.cn>
 * @Date:               2016-12-28 12:33:02
 * @Modified time:      2018-07-13 15:20:27
 * @Description:        操作关系型数据库服务器类规范
 */
namespace basement;

trait ServerSQL
{

    /**
     * 返回一条记录，并将指针指向下一条记录。返回的记录为关联数组，键名为列名
     * @return array|null 数组表示的记录，无数据或失败返回null
     */
    public function fetchAssoc():  ? array
    {}

    /**
     * 返回一条记录，并将指针指向下一条记录。返回的记录为对象，属性为列名
     * @param  string $className       记录对象名称，默认为stdClass
     * @param  array  $constructorArgs 对记录对象传入的构造参数，默认为空
     * @return object|null             对象表示的记录，无数据或失败返回null
     */
    public function fetchObject(string $className = 'stdClass', array $constructorArgs = []) :  ? object
    {}

    /**
     * 返回所有记录，数组中每一个元素都为一条用数组表示的记录
     * @return array|null 所有由数组表示的记录构成的数组，无数据或失败返回null
     */
    public function fetchAllAssoc() :  ? array
    {}

    /**
     * 返回所有记录，数组中每一个元素都为一条用对象表示的记录
     * @param  string $className       记录对象名称，默认为stdClass
     * @param  array  $constructorArgs 对记录对象传入的构造参数，默认为空
     * @return object|null             所有由对象表示的记录构成的数组，无数据或失败返回null
     */
    public function fetchAllObject(string $className = 'stdClass', array $constructorArgs = []) :  ? array
    {}

    /**
     * 获得最后插入记录的ID或序列值
     * @param  string $name 应该返回ID的那个序列对象的名称，见PDO::lastInsertId()说明
     * @return string       ID或序列值，数字自增主键应转为数字字符串，无数据或不支持该功能的数据库则返回null
     */
    public function lastID(string $name = '') :  ? string
    {}

    /**
     * 返回影响的记录数
     * @return int 影响的记录数
     */
    public function rowCount() : int
    {}

    /**
     * 执行SQL语句
     * @param  string $sql    sql语句
     * @param  array  $params sql语句中需要绑定的变量，可不绑定
     * @return bool           是否执行成功
     */
    public function execute(string $sql, array $params = []): bool
    {}

    /**
     * 开始事务
     * @return bool 是否开始成功
     */
    public function beginTransaction(): bool
    {}

    /**
     * 回滚事务
     * @return bool 是否回滚成功
     */
    public function rollBack(): bool
    {}

    /**
     * 提交事务
     * @return bool 是否提交成功
     */
    public function commit(): bool
    {}

    /**
     * 当前是否处于事务中
     * @return bool 是否处于事务中
     */
    public function inTransaction(): bool
    {}
}
