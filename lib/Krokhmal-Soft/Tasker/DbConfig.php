<?php
namespace Krokhmal\Soft\Tasker;

class DbConfig
{
    // Global variable with main DB parameters for connection
    const DB_CONFIG_PARAMS = array
    (
        // Put here another connection params, like:
        /*
        'host'			=>	'hostname',
        'db_name'		=>	'db_name',
        'user'			=>	'db_user',
        'pass'			=>	'password',
        'persistant'	=>	true	// Persistant connection
        */
        
        'host' => 'localhost',
        'db_name' => 'task_manager',
        'user' => 'tmuser',
        'pass' => 'SbuBtKlUXtncBeyD',
        'charset' => 'utf8',
        'persistant' => true
    );
}
 