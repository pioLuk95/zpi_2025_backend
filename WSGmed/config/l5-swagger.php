<?php

return [
    'default' => 'default',
    'documentations' => [
        'default' => [
            'api' => [
                'title' => 'API Documentation',
                'description' => 'Documentation for the API endpoints of the project.',
            ],

            'routes' => [
                /*
                 * Route for accessing API documentation interface
                 */
                'api' => 'api/documentation',
            ],

            'paths' => [
                /*
                 * Edit to include full URL in UI for assets
                 */
                'use_absolute_path' => env('L5_SWAGGER_USE_ABSOLUTE_PATH', true),

                /*
                 * File name of the generated JSON documentation file
                 */
                'docs_json' => 'api-docs.json',

                /*
                 * File name of the generated YAML documentation file
                 */
                'docs_yaml' => 'api-docs.yaml',

                /*
                 * Set this to `json` or `yaml` to determine which documentation file to use in UI
                 */
                'format_to_use_for_docs' => env('L5_FORMAT_TO_USE_FOR_DOCS', 'json'),

                /*
                 * Absolute paths to directory containing the swagger annotations
                 */
                'annotations' => [
                    base_path('app'), // Skanuj katalog `app` w poszukiwaniu adnotacji OpenAPI
                ],
            ],

            // Dodano klucz proxy
            'proxy' => null, // Brak proxy, ustawiono na null
        ],
    ],

    'defaults' => [
        'routes' => [
            /*
             * Route for accessing parsed swagger annotations.
             */
            'docs' => 'docs',

            /*
             * Route for OAuth2 authentication callback.
             */
            'oauth2_callback' => 'api/oauth2-callback',

            /*
             * Middleware allows to prevent unexpected access to API documentation
             */
            'middleware' => [
                'api' => [],
                'asset' => [],
                'docs' => [],
                'oauth2_callback' => [],
            ],

            /*
             * Route Group options
             */
            'group_options' => [],
        ],

        'paths' => [
            /*
             * Absolute path to location where parsed annotations will be stored
             */
            'docs' => storage_path('api-docs'),

            /*
             * Absolute path to directory where to export views
             */
            'views' => base_path('resources/views/vendor/l5-swagger'),

            /*
             * Edit to set the API's base path
             */
            'base' => env('L5_SWAGGER_BASE_PATH', '/api'),

            /*
             * Absolute path to directories that should be excluded from scanning
             */
            'excludes' => [],
        ],

        /*
         * API security definitions. Will be generated into documentation file.
         */
        'securityDefinitions' => [
            'securitySchemes' => [
                'bearerAuth' => [
                    'type' => 'http',
                    'scheme' => 'bearer',
                    'bearerFormat' => 'JWT',
                    'description' => 'Enter your JWT token in the format: Bearer {token}',
                ],
            ],
            'security' => [
                [
                    'bearerAuth' => [],
                ],
            ],
        ],

        /*
         * Set this to `true` in development mode so that docs would be regenerated on each request
         * Set this to `false` to disable swagger generation on production
         */
        'generate_always' => env('L5_SWAGGER_GENERATE_ALWAYS', false),

        /*
         * Set this to `true` to generate a copy of documentation in YAML format
         */
        'generate_yaml_copy' => env('L5_SWAGGER_GENERATE_YAML_COPY', false),

        /*
         * Swagger UI configuration parameters
         */
        'ui' => [
            'display' => [
                'doc_expansion' => env('L5_SWAGGER_UI_DOC_EXPANSION', 'none'),
                'filter' => env('L5_SWAGGER_UI_FILTERS', true),
            ],

            'authorization' => [
                'persist_authorization' => env('L5_SWAGGER_UI_PERSIST_AUTHORIZATION', false),
            ],
        ],

        /*
         * Constants which can be used in annotations
         */
        'constants' => [
            'L5_SWAGGER_CONST_HOST' => env('L5_SWAGGER_CONST_HOST', 'http://127.0.0.1:8000'),
        ],

        // Dodano klucz proxy
        'proxy' => null, // Brak proxy, ustawiono na null
    ],
];