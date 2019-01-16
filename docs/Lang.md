# trait Lang
namepsace: `basement`

简化并实现多语言映射中的常见功能。
核心思想如下：

* 语言映射的数据格式需为Key-Value型，key为原始语言，value为目标语言。
* 全局只有一个唯一的目标语言**i18n**，且只需设置一次。设置后，所有映射的语言都是这个目标语言。
* 提供一个自动加载机制，用于自动加载不同的语言包。
* 不同的语言包可以有一个独有的标识名。

注意：

* 一个实例有一个标识名（语言包名），用于标记不同的场景或者不同的开发者，或者隔离不同的组件在语言包上的差异，确保同一个标识下的语言字符集具有封闭性（不受其他语言包影响）。
* 组件开发者无需关心全局语言，甚至可以不用提供语言映射数据，只需设置自己的标识名和映射字符即可；而组件使用者则只需指定目标语言和设置正确的自动加载机制即可，甚至可以自己管理所有的语言映射数据。

---



## 使用方式

~~~php
<?php
//先注册
Linker::register([
    'Lang' => 'your_lang_class',
]);

//设置全局目标语言，如英文
Linker::Lang()::i18n('en'); //返回bool

//注册全局任一字符集的映射规则，入参为语言包和全局目标语言名
Linker::Lang()::autoload(function($name, $i18n){
    //映射逻辑
    return $chars; //返回该语言包下的目标语言的所有映射数据
});

//获得实例
$Lang = Linker::Lang(true);

//设置语言包名
$Lang->setName('name'); //返回bool

//获得语言包名
$Lang->getName(); //string

//获得目标i18n的映射语言字符
$Lang->map('原始语言'); //返回string
~~~

---



## API

#### 列表
~~~php
protected $__name = 'default';
protected static $__i18n;
public function setName(string $name): bool
{
    $this->__name = $name;
    return true;
}
public function getName(): string
{
    return $this->__name;
}
public function map(string $chars): string
public static function autoload(callable $callable): bool
public static function i18n(string $i18n): bool
{
    if (in_array($i18n, self::$__i18nLists)) {
        self::$__i18n = $i18n;
        return true;
    }
    return false;
}
~~~

#### 详细说明
**属性**:
```
protected static $__i18nLists=[
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
]; 所有可书写的i18n名，为只读属性。调用i18n()方法传入的参数必须位于其中。
protected $__name='default'; 当前语言包名，用于标识不同的字符集。
protected static $__i18n; 全局唯一目标语言名，也即一次运行只能有一个目标映射语言类型。
```

**setName()**: 设置当前语言包名，用于区分不同的映射场景，如不同的开发者可使用不同的语言包名来隔离自身语言包。
```php
params:
    string $name 语言包名
return:
    bool 是否设置成功
```

**getName()**: 获得当前语言包名
```php
params:
    void
return:
    string 语言包名
```

**map()**: 传入原字符获得目标语言的映射字符
```php
params:
    string $chars 需要映射的原字符
return:
    string 映射后的目标字符
```

**autoload()**: 注册全局任一字符集的自动加载规则，用于简化字符集数据加载，并实现惰性加载。
```php
params:
    callable $callable 自动加载规则，为回调方式。入参为$this->__name和self::$__i18n，返回该语言包下的所有目标语言字符集。
    如使用php数组存储的语言包，其文件名形如`name.i18n.php`这种命名方式，则规则可如`return include "$name.$i18n.php"`;
return:
    bool 是否注册成功
```