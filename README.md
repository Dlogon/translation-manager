# laravel Translation manager

[![Latest Version on Packagist](https://img.shields.io/packagist/v/dlogon/translation-manager.svg?style=flat-square)](https://packagist.org/packages/dlogon/translation-manager)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/dlogon/translation-manager/run-tests?label=tests)](https://github.com/dlogon/translation-manager/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/dlogon/translation-manager/Check%20&%20fix%20styling?label=code%20style)](https://github.com/dlogon/translation-manager/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/dlogon/translation-manager.svg?style=flat-square)](https://packagist.org/packages/dlogon/translation-manager)

Manage your translations in your laravel proyect with a web interface.

This package has been inspired by [barryvdh/laravel-translation-manager](https://github.com/barryvdh/laravel-translation-manager)

## Installation

You can install the package via composer:

```bash
composer require dlogon/translation-manager
```

You can run the migrations with:

```bash
php artisan vendor:publish --tag="translation-manager-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="translation-manager-config"
```


Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="translation-manager-views"
```

## Usage

To access the web manager, access to the url "yourproject"/translations, if you want to change the route prefix of the manager, publish the config file (translation-manager.php) and change "prefix" inside the "route" array,
therefore, if you are not using auth, comment the "auth" middleware inside the route array

```php
 'route' => [
        'prefix' => 'translations',
        'middleware' => [
	        'web',
	        'auth',
		],
    ],
```

This is that you will see when enter to the manager

![](https://user-images.githubusercontent.com/26014056/197062911-c0bc31a0-6406-4807-ba81-997585395e4d.png)

When you add a new Lang, you'll see the lang in the bellow section (ADD NEW KEY) 
and in the table on the bottom


![](https://user-images.githubusercontent.com/26014056/197084487-d01f2616-478c-4f1e-b58b-cdaed67faba4.png)

Then, you should add a group in the Groups tab, groups are intended to create diferent files if you work with the "php array" aproach, or for "enhance" the visual presentation if you use the "json" aproach.

Now, you can add a key, with a value for every lang that you have been created.
when you press add, you will see the added key in the bottom table, if you do not see the key, ensure that you select the group where you store the key in the above dropdown.

if you want to change any translation, just click the translation and you will see an input to put the new translation, if you click the Ok button, you will see a notifications saying that the translation updated successfully

![](https://user-images.githubusercontent.com/26014056/197087089-b086ecc1-708a-4154-a8fa-b4fb8c20067d.png)

### Model translations

Maybe you noticed the Model translations tab, here, you can generate a group for every model in your app, and this will generate a key for every column in you model.

For example, if we have a Post model, and we already run the migration with some columns.

![](https://user-images.githubusercontent.com/26014056/197088317-f1efde53-003e-4f2d-95d6-eca73f1b2f61.png)


If you want to avoid some columns, you can add it into the config file, there are a default ignored columns of the User model, and there are a default columns ignored from all models


```php
'ignore_columns' => [
        "id",
        "created_at",
        "updated_at",
        "deleted_at"
    ],
'ignore_model_columns' => [
        "users" => [
            "email_verified_at",
            "remember_token"
        ]
    ],
```

### Generating the translation files

Once you are ready and you have created your translations, is time to create the translations files, above all you will see the big orange button Generate translations, below you will see a radio where you can select the aproach.

If you select the php aproach, your translation files will have the structure
    
    rootapp/<your lang folder>/<lang1>/
                                    group1.php
                                    group2.php
    rootapp/<your lang folder>/<lang2>/
                                    group1.php
                                    group2.php

If you select the JSON aproach, you will see a property in your generated json, this property has the structure
        
    "//GROUP<group-name>" = "///////////////GROUP-<group-name>/////////////////////"

for example:

en.json

```json
{
    "\/\/GROUPapp": "\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/GROUP-app\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/",
    "Welcome": "Welcome",
    "\/\/GROUPlanding": "\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/GROUP-landing\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/",
    "\/\/GROUPPost": "\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/GROUP-Post\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/",
    "autor_name": "Autor Name",
    "title": "Title",
    "\/\/GROUPUser": "\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/GROUP-User\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/",
    "email": "",
    "name": "",
}
```

es.json
```json
{
    "\/\/GROUPapp": "\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/GROUP-app\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/",
    "Welcome": "Bienvenido",
    "\/\/GROUPlanding": "\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/GROUP-landing\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/",
    "\/\/GROUPPost": "\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/GROUP-Post\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/",
    "autor_name": "Nombre del autor",
    "title": "Titulo",
    "\/\/GROUPUser": "\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/GROUP-User\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/",
    "name": " ",
    "email": " "
}
```



## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.


## Credits

- [Diego](https://github.com/Dlogon)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## TODO

    - Read and store lang files in database
    - Filter keys
    - Read lang and add to database on install package
