<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Установка и запуск проекта

Следуйте этим шагам, чтобы развернуть проект на своем локальном компьютере:

1. **Клонируйте репозиторий**:
   ```bash
   git clone https://github.com/damert123/shop.git
   cd ваш_репозиторий
2. **Установите зависимости: Убедитесь, что у вас установлен Composer. Затем выполните:**
    ```bash
   composer install
   
3. **Создайте файл .env: Скопируйте файл .env.example в .env:**
   ```bash
   cp .env.example .env
   
4. **Настройте базу данных: В файле .env укажите параметры подключения к вашей базе данных:**
    ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=ваша_база_данных
   DB_USERNAME=ваш_пользователь
   DB_PASSWORD=ваш_пароль
   
5. **Создайте таблицы в базе данных: Выполните миграции для создания необходимых таблиц:**
    ```bash
   php artisan migrate
   
6. **Сгенерируйте ключ приложения:**
    ```bash
   php artisan key:generate

7. **Запустите сервер**
    ```bash
   php artisan serve
    ```

