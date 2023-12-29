![image](https://github.com/QuangHC/Final_Web_PHP/assets/106605829/f79c5cbc-6b14-418b-9da8-23827ac44706)# Final_Web_PHP
## Installation
- PHPStorm: [PHPStorm](https://www.jetbrains.com/phpstorm/download/#section=windows)
- Xampp: [Xampp](https://download.com.vn/download/xampp-for-windows-14235?linkid=81502)
- Composer: [Composer](https://getcomposer.org/Composer-Setup.exe)

<!> Note:  
* USE XAMPP 7.4
* Settings environments variables for Xampp:
  ![stepBuild1](https://github.com/QuangHC/Final_Web_PHP/assets/106605829/c91a56dc-0c0d-45d3-a943-0dec54763ba6)
  ![StepBuild2](https://github.com/QuangHC/Final_Web_PHP/assets/106605829/d7a7bd0f-85db-4570-87d1-19b6072c28c8)

# Step to build:
Step 1: Setting run CLI in phpStorm, open phpStorm:
![phpStorm1](https://github.com/QuangHC/Final_Web_PHP/assets/106605829/8f77a889-5028-4267-b4a5-324820406fc9)
![phpStorm2](https://github.com/QuangHC/Final_Web_PHP/assets/106605829/605eb1c2-1b33-46e7-a428-cf8f13536d76)
![php3](https://github.com/QuangHC/Final_Web_PHP/assets/106605829/2ba36c16-781d-47ac-8733-179da0f9c216)
![php4](https://github.com/QuangHC/Final_Web_PHP/assets/106605829/94bc4dee-ae88-4f46-a357-a1bb6b732e63)

Step 2: Init composer:
```bash
$ composer init
```
<!> Change `autoload` in: `composer.json` file: 
```bash
    "autoload": {
        "psr-4": {
            "app\\": "./"
        }
    },
```

Step 3: Settings vlucas/phpdotenv:
```bash
$ composer require vlucas/phpdotenv
```
<!> Open folder `vendor` if it has folder vlucas => OK, else REOPEN PHPSTORM

Step 4: Start xampp and create DB
- START XAMPP
- OPEN localhost:phpmyadmin
- CREATE DATABASE `mvc_framwork`

Step 5: Run 
- Open terminal in phpStorm:
```bash
$ php -S localhost:8080
```


