<?php
namespace Krokhmal\Soft\Data\Database;

class DbConfig
{
    // Global variable with main DB parameters for connection
    const DB_CONFIG_PARAMS = array(
        
        // Put here another connection params, like:
        /*
        
        // Name of db connection config
        'connect_name' => array(
        
            // Driver using for this connection ('pdo' or 'mysqli')
            'driver' => 'pdo',
            
            // Connection params for this connection
            'params' => array(
                'host'			=>	'hostname',
                'db_name'		=>	'db_name',
                'user'			=>	'db_user',
                'pass'			=>	'password',
                'persistant'	=>	true	// Persistant connection
            )
        )
        
        */
        
        // Name of db connection config
        'db' => array(
        
            // Driver using for this connection
            'driver' => 'pdo',
            
            // Connection params for this connection
            'params' => array(
                'host'			=>	'localhost',
                'db_name'		=>	'task_manager',
                'user'			=>	'tmuser',
                'pass'			=>	'SbuBtKlUXtncBeyD',
                'charset'		=>	'utf8',
                'persistant'	=>	true
            )
        )
    );
}
 