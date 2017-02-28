<?php
namespace Krokhmal\Soft\Data\Database;

use \PDO;

// Implementation of DbDriver with PDO dirver
class DbDriverPdo extends DbDriver{
	
	const MEMORY_USAGE_LOW = 0;		// Low memory usage for some functions
	const MEMORY_USAGE_HIGH = 1;	// High memory usage
	
	private $dbh;	//PDO data base driver handler
	
	// Initialize connection params with input params variable
	// and create connection to DB by this params
	public function __construct($params){
		
		// Initialize connection params
		$this->params = $params;
		$this->host = $params['host'];
		$this->db_name = $params['db_name'];
		$this->user = $params['user'];
		$this->pass = $params['pass'];
		$this->charset = $params['charset'];
		
		// Create connection to DB by params
		$this->createConnection();
	}
	
	// Get and return assoc array of select query by sql_query with correction of memory usage.
	// memory_usage can be MEMORY_USAGE_LOW, MEMORY_USAGE_HIGH
	public function selectArray($sql_query, $memory_usage = self::MEMORY_USAGE_LOW){
		$arr = array();									// Result array
		$this->sql_query = $sql_query;					// Save sql query
		$this->resource = $this->query($sql_query);		// Execute sql_query 
		switch($memory_usage){							// Switch memory usage
		
			// If high usage of memory (but faster for large record's number)
			case self::MEMORY_USAGE_HIGH:							
				// Fetch all records fast with pdo's fetchAll but use maximum of memory
				$arr = $this->resource->fetchAll(PDO::FETCH_ASSOC);
			break;
			
			// If low usage of memory or default (but slower for small record's number)
			case self::MEMORY_USAGE_LOW:							
			default:
				// Fetch all records little slow using pdo's fetch in loop but use minimum of memory
				while ($row = $this->row($this->resource)) {
					$arr[] = $row;
				}
		}
		return $arr;
	}
	
	// Get next row of statement resource 
	public function nextRow($resource){
		$this->resource = $resource;	// Save statement resource
		return $this->row($resource);	// Fetch row
	}
	
	// Get row number of last executed query 
	public function rowCount($resource = null){
		if (isset($resource)){
			$this->resource = $resource;
		}
		return $this->resource->rowCount();
	}
	
	// Get last Id
	public function lastId($resource){
		return $this->dbh->lastInsertId();
	}
	
	// Fetch and return one row from query statement resource
	protected function row($resource){
		$this->resource = $resource;	// Save statement resource
		// Fetch row as assoc array .FETCH_ASSOC give assoc format
		return $this->resource->fetch(PDO::FETCH_ASSOC);
	}
	
	// Concrete pdo implementation of single sql query
	protected function query($sql_query){
		$this->sql_query = $sql_query;						// Save sql query
		$this->resource = $this->dbh->prepare($sql_query);	// Check query for errors
		$done = $this->resource->execute();					// Execute checked query
		return $this->resource;
	}
	
	// Create DB connection
	public function createConnection(){
		$this->dbh = new PDO(
			"mysql:host=".$this->host.	// Set db host
			";dbname=".$this->db_name.	// Set db name
			";charset=".$this->charset,	// Set db charset
			$this->user,				// Set db user
			$this->pass,				// Set password
			array(
				// Usage of persistent connection (true - yes, false - no)
				PDO::ATTR_PERSISTENT => 
                    isset($this->params['persistent']) ? $this->params['persistent']: false
			)
		);
	}
	
	// Close curent DB connection
	public function closeConnection(){
		unset($this->resource);	// Unset statement resource
		unset($this->dbh);		// Unset PDO handler
	}
}
