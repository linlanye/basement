# trait ServerFile
namepsace: `basement`

服务器访问系列，实现对远程文件服务器的常见读写访问。需要设置目录路径后，对该目录里的文件进行读写，如此可省去文件名的路径前缀。对于目录情况，应能兼容处理。

---



## 使用方式

~~~php
<?php
//先注册
Linker::register([
    'ServerFile' => 'your_file_class',
]);

//获得实例
$Server=Linker::ServerFile(true);

//设置当前文件读写路径
$Server->setPath('path'); //返回bool

//获得当前文件读写路径
$Server->getPath(); //返回string

//获得文件最后修改时间
$Server->getMTime('file'); //返回int或null

//获得文件最后访问时间
$Server->getATime('file'); //返回int或null

//获得文件创建时间
$Server->getCTime('file'); //返回int或null

//文件是否存在
$Server->exists('file'); //返回bool

//删除文件
$Server->remove('file'); //返回bool

//以某种模式写文件
$Server->write('file', 'content', $mode); //返回bool

//以某种模式读文件
$Server->read('file', $mode); //返回string或null

//上传本地文件到服务器
$Server->upload('local_file', 'server_file'); //返回bool

//下次服务器文件到本地
$Server->download('server_file', 'local_file'); //返回bool
~~~

---



## API

#### 列表
~~~php
    protected $__path = '/';
    public function setPath(string $path): bool
    {
        $this->__path = $path;
        return true;
    }
    public function getPath(): string
    {
        return $this->__path;
    }
    public function getMTime(string $fileName):  ? int
    public function getATime(string $fileName) :  ? int
    public function getCTime(string $fileName) :  ? int
    public function getSize(string $fileName) : int
    public function exists(string $fileName): bool
    public function remove(string $fileName): bool
    public function write(string $fileName, string $content, string $mode = 'a'): bool
    public function read(string $fileName, string $mode = 'r'):  ? string
    public function upload(string $localFile, string $serverFile) : bool
    public function download(string $serverFile, string $localFile): bool
~~~
#### 详细说明

**属性**:
```php
protected $__path='/' 当前文件夹路径
```


**setPath()**: 设置当前日志名
```php
params:
    string $name 日志名
return:
    bool 是否成功
```

**getName()**: 获得当前日志名
```php
params:
    void
return:
    bool 是否成功
```

**record()**: 自定义日志类型并记录日志
```php
params:
    string $content 日志内容
    string $type    日志类型
return:
    bool 是否成功
```

**info()**: psr-3方式，其他7个方法一致
```php
params:
    string $content 日志内容
return:
    bool 是否成功
```
