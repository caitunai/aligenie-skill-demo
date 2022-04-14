## 天猫精灵技能开发Demo
此项目是天猫精灵有屏幕技能开发演示Demo，基于Laravel框架开发技能后端，天猫精灵 TPL 2.0 作为显示前端。
需要开发者具备基础的PHP、Nodejs以及前端开发知识。

## 教学文章
[https://developer.aliyun.com/article/886345](https://developer.aliyun.com/article/886345)

## 下载代码

```shell
git clone https://github.com/caitunai/aligenie-skill-demo.git
```

## 安装PHP依赖

```shell
cd aligenie-skill-demo/
composer install
```

## 安装前端依赖
```shell
npm i waft-cli -g
cd waft/
npm install
```

## 运行
### 运行技能接口服务
```shell
php artisan serve
```
### 编译前端文件
```shell
npx waft build --aot=true
```
编译之后请上传文件到天猫精灵开发平台对应技能的屏显页面。
