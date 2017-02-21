<?php

// Ultra compose core file for DB
require_once("config.php");

foreach($db_config_params as $connect){
		switch($connect['driver']){
			case 'pdo':
				require_once('DbDrivers/DbDriverPdo.php');
			break;
			default:
			
			break;
		}
	}
	
?>