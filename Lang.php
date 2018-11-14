<?php
/**
 * @Author:             林澜叶(linlanye)
 * @Contact:            <linlanye@sina.cn>
 * @Date:               2017-06-20 11:53:48
 * @Modified time:      2018-07-13 15:20:06
 * @Description:        语言映射类规范，通过注册全局自动映射规则，将任一字符集映射为全局唯一目标语言
 */
namespace basement;

trait Lang
{
    /**
     * 目标语言名规范，设置的目标语言名应为下列内容之一，参见各国语言代码简写
     * @var array
     */
    protected static $__i18nLists = [
        'af', 'ar-ae', 'ar-bh', 'ar-dz', 'ar-eg', 'ar-iq', 'ar-jo', 'ar-kw', 'ar-lb', 'ar-ly',
        'ar-ma', 'ar-om', 'ar-qa', 'ar-sa', 'ar-sy', 'ar-tn', 'ar-ye', 'be', 'bg', 'ca',
        'cs', 'da', 'de', 'de-at', 'de-ch', 'de-li', 'de-lu', 'el', 'en',
        'en-au', 'en-bz', 'en-ca', 'en-gb', 'en-ie', 'en-jm', 'en-nz', 'en-tt', 'en-us', 'en-za',
        'es', 'es-ar', 'es-bo', 'es-cl', 'es-co', 'es-cr', 'es-do', 'es-ec', 'es-gt', 'es-hn',
        'es-mx', 'es-ni', 'es-pa', 'es-pe', 'es-pr', 'es-py', 'es-sv', 'es-uy', 'es-ve', 'et',
        'eu', 'fa', 'fi', 'fo', 'fr', 'fr-be', 'fr-ca', 'fr-ch', 'fr-lu', 'ga',
        'gd', 'he', 'hi', 'hr', 'hu', 'id', 'is', 'it', 'it-ch', 'ja',
        'ji', 'ko', 'ko', 'lt', 'lv', 'mk', 'ms', 'mt', 'nl', 'nl-be',
        'no', 'no', 'pl', 'pt', 'pt-br', 'rm', 'ro', 'ro-mo', 'ru', 'ru-mo',
        'sb', 'sk', 'sl', 'sq', 'sr', 'sr', 'sv', 'sv-fi', 'sx', 'sz',
        'th', 'tn', 'tr', 'ts', 'uk', 'ur', 've', 'vi', 'xh', 'zh-cn',
        'zh-hk', 'zh-sg', 'zh-tw', 'zu',
    ];

    /**
     * 当前字符集的标识名
     * @var string
     */
    protected $__label = 'default';

    /**
     * 全局唯一目标语言名，一次生命期只能有一个目标语言，所有字符集都映射为该语言
     * @var string
     */
    protected static $__i18n;

    /**
     * 设置当前字符集的标示名，用于确定唯一一个源字符集
     * @param string $label 当前字符集标示名
     * @return bool         是否设置成功
     */
    public function setLabel(string $label): bool
    {
        $this->__label = $label;
        return true;
    }

    /**
     * 获取当前字符集的标识名
     * @return string 当前字符集的标识名
     */
    public function getLabel(): string
    {
        return $this->__label;
    }

    /**
     * 将当前源字符映射为全局目标语言字符
     * @param  string $chars 源字符
     * @return string        目标语言字符
     */
    public function map(string $chars): string
    {}

    /**
     * 设置全局目标语言
     * @param  string $i18n 各国语言缩写代码，需存在于self::$__i18nLists中
     * @return bool         是否设置成功
     */
    public static function i18n(string $i18n): bool
    {
        if (in_array($i18n, self::$__i18nLists)) {
            self::$__i18n = $i18n;
            return true;
        }
        return false;
    }

    /**
     * 注册全局任一字符集的自动映射规则
     * @param  callable  $callable 自动映射规则，入参为当前标示名$this->__label，当前目标语言名self::__i18n
     * @return bool                是否注册成功
     */
    public static function autoload(callable $callable): bool
    {}

}
