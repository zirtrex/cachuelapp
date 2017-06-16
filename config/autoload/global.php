<?php
return [
    
    'db' => array(
		'driver' 	=> 'Pdo',
    	'dsn' 		=> 'mysql:dbname=cachuelapp; host=localhost',
    	'driver_options' => array(
    		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
    	)
	),
    
    'session_validators' => [
        \Zend\Session\Validator\RemoteAddr::class,
        \Zend\Session\Validator\HttpUserAgent::class,
    ],
    
    'session_config' => [
        'remember_me_seconds' => 604800,
        'use_cookies' => true,
        'cookie_lifetime' => 604800,
        'name' => 'session',
    ],
    
    'session_storage' => [
        'type' => \Zend\Session\Storage\SessionArrayStorage::class,
    ],    
];


