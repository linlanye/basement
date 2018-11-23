# Basement
[![Latest Stable Version](https://poser.pugx.org/basement/basement/v/stable)](https://packagist.org/packages/basement/basement)
[![Latest Unstable Version](https://poser.pugx.org/basement/basement/v/unstable)](https://packagist.org/packages/basement/basement)

	版本1.0, 要求php>=7.2

### 介绍


Basement的目的是让常用的php组件功能可以通用化使用，由一套**Trait**和一个叫**Linker**的类共同构成。
例如当需要获得缓存时，只需一句 `Linker::ServerKV(true)->get($name)` 代码即可，而无需关注具体实现。
其中Trait算是一套扩展了的接口，任何人都可以用其实现basement所要求的类和方法名。这些方法有严格的入参和出参约束，在依靠php语法无法约束的场景，或有一定的文字约束甚至逻辑代码用于提醒实现者严格按照接口标准书写类。这些类被实现后，并不需要用户去特意引入，只需要通过**Linker**这个类的静态方法进行调用即可。如ServerKV()这个方法实则是返回实现了KV服务器访问约束的类的实例


# 具体用途如下：


* 精准抽象和简单访问。大部分web开发具有大量重复的地方，对这些地方进行抽象并提供一套最简单的访问模式。

* 统一规则和屏蔽区别。用相同的需求具有不同的实现，统一这些实现接口并将其特有的调用方式屏蔽掉，使其对开发者简单化、透明化。

* 对组件的替换可以无缝进行，若某个组件出现问题，只需更改所注册的组件名。

### Linker这个类

顾名思义，该类相当于链接不同的功能方法，访问所有basement功能的，定义在根命名空间，无需繁琐的命名空间前缀。

```sh
php composer.phar require "doctrine/instantiator:~1.0.3"
```

#注意：
所有函数接口返回的内容应该是独立的，不受环境影响，如不应该受配置文件等的影响
所有方法除返回布尔以外，失败或错误后都必须返回null。
不能用false代替null！