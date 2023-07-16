<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Routes group config
    |--------------------------------------------------------------------------
    |
    | The default group settings for the routes.
    |
    */
    'route' => [
        'prefix' => 'translations',
        'middleware' => [
	        'web',
	        'auth',
		],
    ],

    /*
    |--------------------------------------------------------------------------
    | database prefix
    |--------------------------------------------------------------------------
    |
    |
    |
    */
    'db_prefix' => "translations",

    /*
    |--------------------------------------------------------------------------
    | models folder
    |--------------------------------------------------------------------------
    |
    | define folders where models are stored, define the key as the namespace and the value as the model folder container
    |
    */
    'models_folder' => [
        "App\\Models\\" => app_path("Models"),
    ],

     /**
     * Exclude specific models

     */
    'exclude_models' => [],

    /**
     * ignored columns when generate the model translations
     *
     * @type array
     */
    'ignore_columns' => [
        "id",
        "created_at",
        "updated_at",
        "deleted_at"
    ],

    /**
     * ignored columns from specific model, put the model table name
     *
     * @type array
     */
    'ignore_model_columns' => [
        "users" => [
            "email_verified_at",
            "remember_token"
        ]
    ],


    'exclude_groups' => [],
];
