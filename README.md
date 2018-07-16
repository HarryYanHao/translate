# 变量名转换器
#### ##### ###### # [功能描述]：将变量名或类名由中文翻译成对应的英文（支持驼峰和下划线命名）
##### ###### ##### ### [开发环境]：php7.0+ python3支持jieba分词模块
[项目结构简介]：项目模块结构目录树
├── README.md
├── app
│   ├── controllers 控制器
│   ├── models 模块
│   ├── providers 
│   ├── service 逻辑层
│   └── views 视图层
├── command 命令行模式
│   └── translateCommand.php
├── common 通用函数
│   ├── di.php
│   └── helper
├── composer.json 包管理文件
├── composer.lock
├── config 配置文件 用户可根据自己的环境配置
│   ├── database.php
│   ├── redis.php
│   ├── routes.php
│   └── youdao.php
├── public
│   └── index.php 单入口文件
├── python python脚本 
│   └── trans.py
├── storage 临时文件
│   └── log
└── vendor


##### [作者列表]：harry.yan

##### [联系方式]：393464654@qq.com