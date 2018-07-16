# 变量名转换器
###  [功能描述]：将变量名或类名由中文翻译成对应的英文（支持驼峰和下划线命名）
###  [开发环境]：php7.0+ python3支持jieba分词模块
### [项目结构简介]：项目模块结构目录树
├── README.md<br>
├── app<br>
│   ├── controllers 控制器<br>
│   ├── models 模块<br>
│   ├── providers <br>
│   ├── service 逻辑层<br>
│   └── views 视图层<br>
├── command 命令行模式<br>
│   └── translateCommand.php<br>
├── common 通用函数<br>
│   ├── di.php<br>
│   └── helper<br>
├── composer.json 包管理文件<br>
├── composer.lock<br>
├── config 配置文件 用户可根据自己的环境配置<br>
│   ├── database.php<br>
│   ├── redis.php<br>
│   ├── routes.php<br>
│   └── youdao.php<br>
├── public<br>
│   └── index.php 单入口文件<br>
├── python python脚本 <br>
│   └── trans.py<br>
├── storage 临时文件<br>
│   └── log<br>
└── vendor<br>

###  [使用方式]
推荐安装anaconda<br>
安装结巴分词pip3 install jieba<br>
<br>
浏览器方式：<br>
nginx配置文件根目录为public<br>
浏览器get方式访问：http://localhost/translate<br>
<br>
命令行cli方式：<br>
php translateCommand.php<br>

###  [使用参数]
| 参数名称  | 参数类型  | 备注  |
| ------------ | ------------ | ------------ |
| words  | string  | 需要转换的中文变量名  |
| word_mode  | int  | 选词模式1是最精确 2是单词数最短 默认为1  |
| mode  | int  | 命名模式 1是驼峰命名用于类名和方法名 2是下划线分割用于变量名  |
| words_limit  | int  | 限定每个单词最长长度 默认为0 不限制 |

###  [效果图]
![image](https://github.com/HarryYanHao/translate/blob/master/screeshots/1.jpg)


###  [作者列表]：harry.yan

### [联系方式]：393464654@qq.com
