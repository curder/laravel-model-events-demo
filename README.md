## 介绍
Laravel Model Event 顾名思义，Laravel 模型事件。



## 安装

```bash
git clone https://github.com/curder/laravel-model-events-demo && cd laravel-model-events-demo

cp .env.example .env

touch database/database.sqlite
composer install
php artisan key:generate
```

## 配置

打开 `.env` 文件，修改里面的数据库配置信息。

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

修改为

```dotenv
DB_CONNECTION=sqlite
```

修改完之后使用数据库迁移文件安装所需的数据表。

```bash
php artisan migrate
```

事件文件在[这里](https://curder.gitbooks.io/laravel_study/content/model/laravel-model-event.html)
