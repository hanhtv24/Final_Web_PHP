# Final_Web_PHP

## Installation
- Dowload PHPStorm: [PHPStorm](https://www.jetbrains.com/phpstorm/download/#section=windows)
- Dowload Xampp(7.4): [Xampp](https://download.com.vn/download/xampp-for-windows-14235?linkid=81502)
- Dowload Composer: [Composer](https://getcomposer.org/Composer-Setup.exe)

---
**NOTE**
* USE XAMPP 7.4
* Settings environments variables for Xampp:

  <img src="https://github.com/QuangHC/Final_Web_PHP/assets/106605829/c91a56dc-0c0d-45d3-a943-0dec54763ba6" alt="..." width="700" />
  <img src="https://github.com/QuangHC/Final_Web_PHP/assets/106605829/d7a7bd0f-85db-4570-87d1-19b6072c28c8" alt="..." width="700" />
---


# Step to build:
## Step 1: Setting run CLI in phpStorm, open phpStorm:
  <img src="https://github.com/QuangHC/Final_Web_PHP/assets/106605829/8f77a889-5028-4267-b4a5-324820406fc9" alt="..." width="500" />
  <img src="https://github.com/QuangHC/Final_Web_PHP/assets/106605829/605eb1c2-1b33-46e7-a428-cf8f13536d76" alt="..." width="500" />
  <img src="https://github.com/QuangHC/Final_Web_PHP/assets/106605829/2ba36c16-781d-47ac-8733-179da0f9c216" alt="..." width="500" />
  <img src="https://github.com/QuangHC/Final_Web_PHP/assets/106605829/94bc4dee-ae88-4f46-a357-a1bb6b732e63" alt="..." width="500" />

## Step 2: Initialize composer:

```bash
$ composer init
```

---
**NOTE**

Change `autoload` in: `composer.json` file:

```bash
    "autoload": {
        "psr-4": {
            "app\\": "./"
        }
    },
```
---


## Step 3: Settings vlucas/phpdotenv:
```bash
$ composer require vlucas/phpdotenv
```

---
**NOTE**

Open folder `vendor` if it has folder vlucas => OK, else REOPEN PHPSTORM

---

## Step 4: Start xampp and create DB 
- START XAMPP
- OPEN (http://localhost/phpmyadmin/index.php)
- CREATE DATABASE `mvc_framwork`
```bash
   CREATE DATABASE mvc_framwork
```

## Step 5: Add file `.env` 
---
**Content file `.env` in folder `Final_Web_PHP`**

DB_DSN = mysql:host=localhost;port=3306;dbname=mvc_framework<br>
DB_USER = root<br>
DB_PASSWORD =

---

## Step 6: Run
- Run migrations
```bash
$ php migrations.php   
```

- Open terminal in phpStorm:
```bash
$ cd .\public\    
$ php -S localhost:8080
```


