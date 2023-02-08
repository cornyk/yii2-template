# Yii2 Template

## 使用本项目
```bash
composer create-project cornyk/yii2-template:dev-master
```

## 项目依赖说明
  + PHP最低环境要求7.4
  + PHP 7.4 ~ 8.2 验证可使用
  + 其他PHP依赖扩展参照Composer的依赖

## 项目结构说明
```
├─bootstrap/                              //Web应用初始化目录
│  ├─app.php                              //Web应用初始化文件
│  ├─constants.php                        //项目常量定义
│  ├─functions.php                        //项目工具类函数定义
│  └─components/                          //项目组件目录，命名空间为'components'
│     ├─RequestLogEvent.php               //请求日志记录事件
│     ├─SmartyTranslationExtension.php    //Smarty翻译标签扩展
│     └─TranslationEvent.php              //翻译监听事件
├─build/                                  //项目构建配置目录
│  ├─env/                                 //环境分离配置
│  ├─nginx/                               //Nginx配置文件
│  └─sql/                                 //数据库结构sql文件
├─config/                                 //配置文件目录
│  ├─app_params.php                       //应用参数定义配置文件
│  ├─web_routes.php                       //Web应用路由配置文件
│  ├─base/                                //基础配置项目录
│  │  ├─console.php                       //命令行应用配置文件
│  │  └─web.php                           //Web应用配置文件
│  └─items/                               //细分配置项目录
│     ├─db.php                            //数据库配置文件
│     ├─dev_tools.php                     //开发工具配置文件，仅在dev环境下有效
│     ├─i18n.php                          //国际化配置文件
│     ├─log.php                           //日志配置文件
│     ├─queue.php                         //队列配置文件
│     ├─redis.php                         //Redis配置文件
│     └─view.php                          //Web应用视图模板配置文件
├─public/                                 //WebRoot根目录
│  ├─index.php                            //Web应用入口
│  ├─.htaccess                            //Apache配置文件
│  └─static/                              //公开静态资源文件夹
├─resources/                              //项目资源目录
│  ├─lang/                                //语言包
│  └─views/                               //视图模板目录
├─runtime/                                //应用运行临时目录
├─src/                                    //应用代码文件目录，命名空间为'app'
│  ├─commands/                            //命令行应用控制器
│  ├─commons/                             //应用公共文件
│  ├─controllers/                         //web应用控制器
│  ├─jobs/                                //异步队列作业层
│  ├─models/                              //数据库模型层
│  ├─services/                            //应用逻辑层
│  └─utils/                               //工具类
├─tests/                                  //单元测试文件目录，命名空间为'tests'
└─yii                                     //命令行应用执行入口
```
