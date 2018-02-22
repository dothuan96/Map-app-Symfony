# Map-app-Symfony

- This Map application include some google map function that allows user:
  + Geocoding a location by address that user input and mark it
  + Change the marker to others custom one and change it color
  + Find direction between 2 loation and calculate its distance
  + Allow user add some infomation for specific location and save to database (MySQL)
- The project is coded based on PHP language and Symfony 4 framework.  

## Install

- PHP development environment 
- [Symfony 4 & Composer](https://symfony.com/doc/current/setup.html)

## Get start

- Install sever:
  + `cd my-project`
  + `composer require server --dev`
- Run sever: `php bin/console server:run`
- `http://localhost:8000/`

## Database

In order to user code for database, you should:
- [Create a database and database table](https://developers.google.com/maps/documentation/javascript/info-windows-to-db)
- Put file `phase4_addrow.php` and `phase4_info.php` to your server
- Change the user information in file `phase4_info.php`
- Change the url to your server url

Contact: Developer: Do Thuan
Email: dov.thuan96@gmail.com
Git: https://github.com/dothuan96/

Credit: This project is developed by Do Thuan.
It's free for use and edit for learning and reference.
