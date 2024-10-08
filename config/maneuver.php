<?php


return array(

    /*
    |--------------------------------------------------------------------------
    | Ignored Files
    |--------------------------------------------------------------------------
    |
    | Maneuver will check .gitignore for ignore files, but you can conveniently
    | add here additional files to be ignored.
    |
    */
    'ignored' => array(),

    /*
    |--------------------------------------------------------------------------
    | Default server
    |--------------------------------------------------------------------------
    |
    | Default server to deploy to when running 'deploy' without any arguments.
    | If this options isn't set, deployment will be run to all servers.
    |
    */
    'default' => 'production',

    /*
    |--------------------------------------------------------------------------
    | Connections List
    |--------------------------------------------------------------------------
    |
    | Servers available for deployment. Specify one or more connections, such
    | as: 'deployment', 'production', 'stating'; each with its own credentials.
    |
    */

    'connections' => array(

        'development' => array(
            'scheme'    => 'ftp',
            'host'      => 'ftp.gamerdad.net',
            'user'      => 'gamerdad',
            'pass'      => 'Dm4ba1nd!',
            'path'      => '/path/to/server/',
            'port'      => 21,
            'passive'   => true
        ),

        'production' => array(
            'scheme'    => 'ftp',
            'host'      => 'ftp.gamerdad.net',
            'user'      => 'gamerdad',
            'pass'      => 'Dm4ba1nd!',
            'path'      => '/sharpnready.jexly.net/',
            'port'      => 21,
            'passive'   => true
        ),

        'beta' => array(
            'scheme'    => 'ftp',
            'host'      => 'ftp.gamerdad.net',
            'user'      => 'gamerdad',
            'pass'      => 'Dm4ba1nd!',
            'path'      => '/jexly.beta/',
            'port'      => 21,
            'passive'   => true
        ),

    ),

);
