<?php
/**
 * @Author:             林澜叶(linlanye)
 * @Contact:            <linlanye@sina.cn>
 * @Date:               2016-11-04 15:07:30
 * @Modified time:      2018-12-07 11:26:48
 * @Description:        组件链接器，在根空间使用
 */
class Linker
{
    protected static $lists = []; //组件列表

    /*
    获得标准组件
     */
    public static function Config(bool $forInstance = false)
    {
        return self::get('Config', $forInstance);
    }
    public static function Debug(bool $forInstance = false)
    {
        return self::get('Debug', $forInstance);
    }
    public static function Event(bool $forInstance = false)
    {
        return self::get('Event', $forInstance);
    }
    public static function Exception(bool $forInstance = false)
    {
        return self::get('Exception', $forInstance);
    }
    public static function Lang(bool $forInstance = false)
    {
        return self::get('Lang', $forInstance);
    }
    public static function Log(bool $forInstance = false)
    {
        return self::get('Log', $forInstance);
    }
    public static function Request(bool $forInstance = false)
    {
        return self::get('Request', $forInstance);
    }
    public static function ServerFile(bool $forInstance = false)
    {
        return self::get('ServerFile', $forInstance);
    }
    public static function ServerKV(bool $forInstance = false)
    {
        return self::get('ServerKV', $forInstance);
    }
    public static function ServerLocal(bool $forInstance = false)
    {
        return self::get('ServerLocal', $forInstance);
    }
    public static function ServerQueue(bool $forInstance = false)
    {
        return self::get('ServerQueue', $forInstance);
    }
    public static function ServerSQL(bool $forInstance = false)
    {
        return self::get('ServerSQL', $forInstance);
    }

    //动态加载自定义组件
    public static function __callStatic($method, $args)
    {
        if (empty($args)) {
            return self::get($method);
        }
        return self::get($method, $args[0]);
    }
    /**
     * 注册组件
     * @param  array $array  键名为组件名，键值为具体类名或实例
     * @param  bool  $isCore 是否核心组件（也即是否不可覆盖）
     * @return bool
     */
    public static function register(array $array, bool $isCore = false): bool
    {
        //写入组件表
        foreach ($array as $component => $class) {
            $component = strtoupper($component);
            if (array_key_exists($component, self::$lists) && self::$lists[$component][1]) {
                throw new Exception("$component can not be overridden!"); //核心组件不可被替换
            }
            self::$lists[$component] = [$class, $isCore]; //写入组件列表
        }
        return true;
    }
    //组件是否已存在
    public static function exists(string $component): bool
    {
        $component = strtoupper($component);
        return array_key_exists($component, self::$lists);
    }
    //获取所有已注册组件，形式为['组件名'=>[类名, 是否为核心组件], ...]
    public static function getAll(): array
    {
        return self::$lists;
    }

    //获取原生支持的组件名称
    public static function getBasements(): array
    {
        return [
            'Config', 'Debug', 'Event', 'Exception', 'Lang', 'Log', 'Request',
            'ServerFile', 'ServerKV', 'ServerLocal', 'ServerQueue', 'ServerSQL',
        ];
    }

    //移除非核心组件
    public static function remove(string $component): bool
    {
        $component = strtoupper($component);
        if (!array_key_exists($component, self::$lists)) {
            return false;
        }
        if (self::$lists[$component][1]) {
            throw new Exception($component . 'can not be removed!');
        }
        unset(self::$lists[$component]);
        return true;
    }

    /**
     * 用于测试标准组件是否满足basement要求
     * @param  array  $components 待测试的组件
     * @return void
     */
    public static function test(array $components)
    {
        $basements = [
            'Config', 'Debug', 'Event', 'Exception', 'Lang', 'Log', 'Request',
            'ServerFile', 'ServerKV', 'ServerLocal', 'ServerQueue', 'ServerSQL',
        ];
        $check = array_change_key_case(array_flip($basements), CASE_UPPER);
        $dir   = dirname(dirname(__DIR__)) . '/tests/traits/';

        foreach ($components as $component => $class) {
            if (!isset($check[strtoupper($component)])) {
                echo "$component is not a basement built-in component, so skipped!" . PHP_EOL;
                continue;
            }
            if (!is_string($class)) {
                throw new Exception("class name must be string!");
            }
            //执行测试
            require_once "$dir${component}Test.php";
            Linker::register([$component => $class]);
            $Test = "basement\\tests\\${component}Test";
            $Test = (new $Test)->testRun();
            Linker::remove($component);
        }
    }

    /**
     * 获得具体组件类
     * @param  string $component    组件名称
     * @param  bool   $forInstance  是否返回实例
     * @return object|string        返回类名或实例
     */
    protected static function get(string $component, bool $forInstance = false)
    {
        //读取具体组件
        $component = strtoupper($component);
        if (array_key_exists($component, self::$lists)) {
            $Class = self::$lists[$component][0];
            if ($forInstance) {
                if (!is_object($Class)) {
                    $Class = new $Class;
                }
            } else {
                if (is_object($Class)) {
                    $Class = get_class($Class);
                }
            }
            return $Class;
        }
        throw new Exception("$component does not exist!"); //没有注册则抛出异常
    }
}
