###This package is designed for a single language and is not complete yet. Please do not download it or use it until this Readme is updated


## BgCountry
A Laravel 5.1 package for managing country, province/state, city selects

Collecting the country, state/province and city of your website users should be easy, but
if you're like me, almost every website you work on has slightly different requirements for it, and even when you have most of the information you need in your toolbox, you end up rewriting it for each website. 

BgCountry solves the problem (at least for Laravel) by :

1. using a common interface, and passing BOTH the selected value and displayed value
2. giving you migrations that can be customized so you only have the data you need.
3. Allowing you to choose a default language only, or several languages
4. If you don't have some data, the select turns into a text input



## Installation

1) For Laravel 5 instalation edit your project's `composer.json` file to require `bgies/bgcountry`.

    "require": {
      "bgies/bgcountry": "dev-master"
   }

## Note - Use only on Laravel 5.1 and up

2) Add the service provider by opening a `app/config/app.php` file, and adding a new item to the `providers` array.

    'Bgies\BgCountry\BgCountryServiceProvider'

3) Update Composer from the CLI:

    composer update

4) Publish the views: 
   Run the following command:

    php artisan vendor:publish


The views will be placed in the `resources/views/vendor/bgcountry folder`   


## Setup
The package includes a form you can publish and modify to suit your needs, an admin interface to help get it setup, and a routes file. 

First, you need to decide if you need a single language, or need to support multiple languages. I recommend you choose multi language when running the migration, even if you only need a single language now. That will give you the extra tables (empty so it takes almost no disk space) you need for multiple language support and you can still use it in single language mode. Later you have the option of seeding the data, and you can choose to only seed the languages and countries you require.  

 



## Usage



