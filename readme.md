# A2ZCMS
![logo](http://i44.tinypic.com/igi5uq.jpg)

======
<!-- DONATE/ -->
[![Gittip donate button](http://img.shields.io/gittip/mrakodol.png)](https://www.gittip.com/mrakodol/ "Donate weekly to this project using Gittip")
[![Flattr donate button](http://api.flattr.com/button/flattr-badge-large.png)](https://flattr.com/submit/auto?user_id=mrakodol&url=https%3A%2F%2Fgithub.com%2Fmrakodol%2FA2ZCMS)
[![BitCoin donate button](http://img.shields.io/bitcoin/donate.png?color=yellow)](https://coinbase.com/checkouts/4d0769619eaebde35c378920a895596e "Donate once-off to this project using BitCoin")
<!-- /DONATE -->
##[Demo](http://a2zcms.mrakodol.info)
======
## A2Z CMS based on Laravel 4.2
* [A2Z CMS Features](#feature1)
* [Requirements](#feature2)
* [How to install](#feature3)
* [Application Structure](#feature4)
* [Production Launch](#feature5)
* [Troubleshooting](#feature6)
* [Included Package Information](#feature7)
* [License](#feature8)
* [Additional information](#feature9)
* [How CMS is look like](#feature10)

<a name="feature1"></a>
## A2Z CMS Features:
* Laravel 4.2
* Twitter Bootstrap 3.0.0
* Custom Error Pages
	* 403 for forbidden page accesses
	* 404 for not found pages
	* 500 for internal server errors
* [Confide](#confide) for Authentication and Authorization
* Back-end
	* Automatic install and settup website.
	* User and Role management.
	* View user login history.
	* Manage blog posts and comments.
	* Manage gallery pictures and comments.
	* Manage custom forms.
	* Manage pages aranged into cateogry and possition.
	* Manage to-do list.
	* Manage polls.
	* Manage plugins(install/uninstall).
	* Set would be use gravatar or avatar users.
    * DataTables dynamic table sorting and filtering.
    * Colorbox Lightbox jQuery modal popup.
    * Add Summernote WYSIWYG in textareas.
    * soon will be more...
* Front-end
	* User login, registration, forgot password
	* Blog,Gallery,Messages and more functionality
	* Voting content(Blog,Gallery,Page)
	* Custom themes
	* Voting on active polls
	* User can use avatar
	* Add Summernote WYSIWYG in textareas
	* soon will be more...
* Packages included:
	* [Confide](#confide)
	* [Entrust](#entrust)
	* [Ardent](#ardent)
	* [Carbon](#carbon)
	* [Presenter](#presenter)
	* [JeffreyWay Laravel 4 Generators](#generators)
	* [Summernote](#summernote)
	* [Application specific modules in Laravel 4] (#modules)

-----
<a name="feature2"></a>
##Requirements

	PHP >= 5.4.0 (Entrust requires 5.4, this is an increase over Laravel's 5.3.7 requirement)
	MCrypt PHP Extension
	Enable creating triger in database
	SQL server(for example MySQL)

-----
<a name="feature3"></a>
##How to install:
* [Step 1: Get the code](#step1)
* [Step 2: Use Composer to install dependencies](#step2)
* [Step 3: Configure Environments(optional)](#step3)
* [Step 4: Configure Mailer](#step4)
* [Step 5: Create database and create Encryption Key](#step5)
* [Step 6: Install CMS](#step6)
* [Step 7: Make sure app/storage is writable by your web server](#step7)
* [Step 8: Start Page](#step8)

-----
<a name="step1"></a>
### Step 1: Get the code
#### Option 1: Git Clone

	git clone git://github.com/mrakodol/A2ZCMS.git a2zcms

#### Option 2: Download the repository

    https://github.com/mrakodol/A2ZCMS/archive/master.zip

-----
<a name="step2"></a>
### Step 2: Use Composer to install dependencies

Laravel utilizes [Composer](http://getcomposer.org/) to manage its dependencies. First, download a copy of the composer.phar. 
Once you have the PHAR archive, you can either keep it in your local project directory or move to 
usr/local/bin to use it globally on your system. On Windows, you can use the Composer [Windows installer](https://getcomposer.org/Composer-Setup.exe).

#### Option 1: Composer is not installed globally

    cd a2zcms
	curl -s http://getcomposer.org/installer | php
	php composer.phar install --dev
#### Option 2: Composer is installed globally

    cd a2zcms
	composer install --dev

Please note the use of the `--dev` flag.

Some packages used to preprocess and minify assests are required on the development environment.

When you deploy your project on a production environment you will want to upload the ***composer.lock*** file used on the development environment and only run `php composer.phar install` on the production server.

This will skip the development packages and ensure the version of the packages installed on the production server match those you developped on.

NEVER RUN `php composer.phar update` ON YOUR PRODUCTION SERVER.

If you haven't already, you might want to make composer be installed globally:

    $ curl -s http://getcomposer.org/installer | php
    $ sudo mv composer.phar /usr/local/bin/composer

Now I can use composer by invoking just the composer command.

Optional way to do it, is to set up an alias:
    alias composer='/location/of/the/composer.phar'

-----
<a name="step3"></a>
### Step 3: Configure Environments(optional)

Laravel 4 will load configuration files depending on your environment. Basset will also build collections depending on this environment setting.

Open ***bootstrap/start.php*** and edit the following lines to match your settings. You want to be using your machine name in Windows and your hostname in OS X and Linux (type `hostname` in terminal). Using the machine name will allow the `php artisan` command to use the right configuration files as well.

    $env = $app->detectEnvironment(array(

        'local' => array('your-local-machine-name'),
        'staging' => array('your-staging-machine-name'),
        'production' => array('your-production-machine-name'),

    ));    
-----
<a name="step4"></a>
### Step 4: Configure Mailer

In the same fashion, copy the ***app/config/mail.php*** configuration file in ***app/config/local/mail.php***. Now set the `address` and `name` from the `from` array in ***config/mail.php***. Those will be used to send account confirmation and password reset emails to the users.
If you don't set that registration will fail because it cannot send the confirmation email.

-----
<a name="step5"></a>
### Step 5: Create database and create Encryption Key

If you finished first four steps, now you can create database on your database server(MySQL). You must create database
with utf-8 collation(uft8_general_ci), to install and application work perfectly.

The configuration option that we need is create the encryption key that is used within the framework. 
To do this, all we need to do is to run:

    php artisan key:generate

-----
<a name="step6"></a>
### Step 6: Install CMS

Now that you have the environment configured, you need to create a database configuration for it. 
If you install A2ZCMS on your localhost in folder a2zcms, you can type on web browser: 
	http://localhost/a2zcms/
And than finish the installation. Instalation would populate a database with tables and start-up data(you can delete that data later).

Now inside ***app/config*** that corresponds to the environment the code is deployed in. This will most likely be ***local***  or ***production***  when you first start a project.

You may setup your timezone:

    <?php
		/*
		|--------------------------------------------------------------------------
		| Application Timezone
		|--------------------------------------------------------------------------
		|
		| Here you may specify the default timezone for your application, which
		| will be used by the PHP date and date-time functions. We have gone
		| ahead and set this to a sensible default for you out of the box.
		|
		*/
	
		'timezone' => 'UTC',
    );

-----
<a name="step7"></a>
### Step 7: Make sure app/storage is writable by your web server.

If permissions are set correctly:

    chmod -R 775 app/storage

Should work, if not try

    chmod -R 777 app/storage

-----
<a name="step8"></a>
### Step 8: Start Page

####Admin login
You can login to admin part of A2ZCMS:

    username: username_from_install_proces
    password: password_from_install_proces


-----
<a name="feature4"></a>
## Application Structure

The structure of this starter site is the same as default Laravel 4 with one exception.
This starter site adds a `library` folder. Which, houses application specific library files.
The files within library could also be handled within a composer package, but is included here as an example.

A2Z CMS-LF use modular structure to implementation. Base controller folder have a two controller: BaseController to extends in site part modules controllers and AdminController to extends in admin part modules controllers.
Controllers which show content to public site have name as module and placed in modules controller, and controllers which show admin content you can named as you like, my recommendation is name start with "Admin". Affter add controller/module you must refresh autoload.

-----
<a name="feature5"></a>
### Production Launch

By default debugging is enabled. Before you go to production you should disable debugging in `app/config/app.php`

```
    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => false,
```

-----
<a name="feature6"></a>
## Troubleshooting

### Site loading very slow

		composer dump-autoload --optimize

### If A2Z CMS did not want to get dependesy

For some Windows people they have had to manually adjust the path in composer because composer is looking in 
ITS root folder (C:\ProgramData\Composer\Bin....etc...) for artisan instead of the root folder you are 
currently working from.
In your composer.json change the lines to reflect the full path to artisan and remember to escape the slash.
For example, assuming a Windows PC with XAMPP installed on D disk :

		"pre-update-cmd": [
			"php artisan clear-compiled"
		],
		"post-install-cmd": [
			"php artisan optimize"
		],
		"post-update-cmd": [
			"php artisan optimize"
		]

Note : This will change your composer.json to only work on your current PC (or any with a similar path). 
If you use github or something to work on another system, this will need to be changed to reflect the new 
environment.


-----
<a name="feature7"></a>
## Included Package Information
<a name="confide"></a>
## Confide Authentication Solution

Used for the user auth and registration. In general for user controllers you'll want to use something like the following:

    <?php

    use Zizaco\Confide\ConfideUser;

    class User extends ConfideUser {

    }

For full usage see [Zizaco/Confide Documentation](https://github.com/zizaco/confide)

<a name="entrust"></a>
## Entrust Role Solution

Entrust provides a flexible way to add Role-based Permissions to Laravel4.

    <?php

    use Zizaco\Entrust\EntrustRole;

    class Role extends EntrustRole
    {

    }

For full usage see [Zizaco/Entrust Documentation](https://github.com/zizaco/entrust)

<a name="ardent"></a>
## Ardent - Used for handling repetitive validation tasks.

Self-validating, secure and smart models for Laravel 4's Eloquent ORM

For full usage see [Ardent Documentation](https://github.com/laravelbook/ardent)

<a name="carbon"></a>
## Carbon

A fluent extension to PHPs DateTime class.

```php
<?php
printf("Right now is %s", Carbon::now()->toDateTimeString());
printf("Right now in Vancouver is %s", Carbon::now('America/Vancouver'));  //implicit __toString()
$tomorrow = Carbon::now()->addDay();
$lastWeek = Carbon::now()->subWeek();
$nextSummerOlympics = Carbon::createFromDate(2012)->addYears(4);

$officialDate = Carbon::now()->toRFC2822String();

$howOldAmI = Carbon::createFromDate(1975, 5, 21)->age;

$noonTodayLondonTime = Carbon::createFromTime(12, 0, 0, 'Europe/London');

$worldWillEnd = Carbon::createFromDate(2012, 12, 21, 'GMT');
```

For full usage see [Carbon](https://github.com/briannesbitt/Carbon)

<a name="presenter"></a>
## Presenter

Simple presenter to wrap and render objects. Think of it of a way to modify an asset for the view layer only.
Control the presentation in the presentation layer not in the model.

The core idea is the relationship between two classes: your model full of data and a presenter which works as a sort of wrapper to help with your views.
For instance, if you have a `User` object you might have a `UserPresenter` presenter to go with it. To use it all you do is `$userObject = new UserPresenter($userObject);`.
The `$userObject` will function the same unless a method is called that is a member of the `UserPresenter`. Another way to think of it is that any call that doesn't exist in the `UserPresenter` falls through to the original object.

For full usage see [Presenter Readme](https://github.com/robclancy/presenter)

<a name="generators"></a>
## Laravel 4 Generators

Laravel 4 Generators package provides a variety of generators to speed up your development process. These generators include:

- `generate:model`
- `generate:seed`
- `generate:test`
- `generate:view`
- `generate:migration`
- `generate:resource`
- `generate:scaffold`
- `generate:form`
- `generate:test`
- `generate:pivot <-- NEW!!`

For full usage see [Laravel 4 Generators Readme](https://github.com/JeffreyWay/Laravel-4-Generators/blob/master/readme.md)

<a name="modules"></a>
##Application specific modules in Laravel 4
Modules in Laravel 4 by Boris Strahinja
For full ussage see [MOdules in Laravel] (https://github.com/creolab/laravel-modules)

<a name"summernote"></a>
## Summernote

Summernote is a javascript program that helps you to create WYSIWYG Editor on web. Super Simple WYSIWYG Editor on Bootstrap(3.0 and 2.x).

[Demo Page](http://hackerwins.github.io/summernote/)

For full usage see [Summernote Readme](https://github.com/hackerwins/summernote)



-----
<a name="feature8"></a>
## License

This is free software distributed under the terms of the MIT license

-----
<a name="feature9"></a>
## Additional information

Inspired by and based on [andrew13's Laravel-4-Bootstrap-Starter-Site](https://github.com/andrew13/Laravel-4-Bootstrap-Starter-Site)

<a name="feature10"></a>
##How CMS is look like

![Install](http://oi41.tinypic.com/2my907n.jpg)
![First page](http://oi39.tinypic.com/15661qw.jpg)
![Messages](http://oi39.tinypic.com/2ajdwl2.jpg)
![Admin dashboard](http://oi44.tinypic.com/2870ry0.jpg)
![Admin page](http://oi44.tinypic.com/eu2ffc.jpg)

