<?php
// Конфигурация маршрутов URL проекта.
$routes = array
(
	// Главная страница сайта (http://localhost/)
	/*array(
		// паттерн в формате Perl-совместимого реулярного выражения
		'pattern' => '~^/$~',
		// HTTP метод
		'http_method' => 'GET',
		// Имя класса обработчика 
		'class' => 'Index',
		// Имя метода класса обработчика
		'method' => 'index'
	),*/
	
	// ----------Тестовый API URL----------
	array(
		'pattern' => '~^/tests$~',
		'http_method' => 'GET',
		'class' => 'TestRepository',
		'method' => 'getAll',
	)
);
