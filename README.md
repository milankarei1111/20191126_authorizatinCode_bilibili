# OAuth 2.0 passport(授權碼模式) 
----
## 影片教學
 [laravel6 授权码 1 配置]
(https://www.bilibili.com/video/av74879198?p=7)

[laravel6 授权码 2 ]
(https://www.bilibili.com/video/av74879198?p=8)

----
### 實作:第三方應用程序(嗶哩嗶哩 bilibili)

時間 06:42

http://localhost:9987

----
## 準備工作
1. 建立專案
2. 安裝Guzzle套件包發送http請求 

        composer require guzzlehttp/guzzle

----
## 建立相關的view

* login.blade.php
* callback.blade.php 06:10 前端取得令牌
* refresh.blade.php 08:47 前端刷新令牌
----
## 配置路由 web.php
** (影片統一用路由方式講解,若正式應將功能寫在控制器中)

* bili登入

* 第三方登入重定向

* 回調地址 獲取code 隨後發出獲取token請求

* 取得token 06:36 
* 刷新token 08:47 
