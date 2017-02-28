<?php
namespace Krokhmal\Soft\Data\Database;

abstract class DbDriver
{
	// -Data-
	
	protected $user;	// DB User
	protected $pass;	// Password
	protected $db_name;	// Name
	protected $host;	// Host name 
	protected $params;	// Array of all input params
	
	protected $resource;	// Resource of query execution result
	protected $sql_query;	// Query
	protected $last_error;	// Last SQL error
	protected $connection;	// DB connection
	
	// -Behavior-
	
	// Construct the DBDriver
	public function __construct($params)
    {
    }
	
	// Execute user sql query to DB with return of result resource
	public function run($sql_query)
    {
		$this->sql_query = $sql_query;		// Save last user sql query
		return $this->query($sql_query);	// Execute query and return query resource
	}
	
	// Get first select row of sql_query as assoc array
	public function selectFirst($sql_query)
    {
		$this->executeQuery($sql_query); // Execute query
		return $this->row($this->resource);			// Get one next row (first) and return it
	}
	
	// Get assoc array of select result assoc rows 
    // by sql query (not best implementation, may to override)
	public function selectArray($sql_query)
    {
		$this->executeQuery($sql_query); // Execute query
		$arr = array();								// Result array
		while ($row = $this->row($this->resource)) {	// Fetch evry row and push to result array
			$arr[] = $row;
		}
		return $arr;
	}
	
	public function selectKeyArray($sql_query, $key)
    {
		$this->executeQuery($sql_query); // Execute query
		$arr = array();
		while ($row = $this->row($this->resource)) {
			$arr[$row[$key]] = $row;
		}
		return $arr;
	}
	
	public function selectValueArray($sql_query, $value)
    {
		$this->executeQuery($sql_query); // Execute query
		$arr = array();
		while ($row = $this->row($this->resource)) {
			$arr[] = $row[$value];
		}
		return $arr;
	}
	
	public function selectKeyValueArray($sql_query, $key, $value)
    {
		$this->executeQuery($sql_query); // Execute query
		$arr = array();
		while ($row = $this->row($this->resource)) {
			$arr[$row[$key]] = $row[$value];
		}
		return $arr;
	}
	
	// Execute query with saving sql_query and result resource
	protected function executeQuery($sql_query)
    {
		$this->sql_query = $sql_query;				// Save last user sql query
		$this->resource = $this->query($sql_query); // Execute query
	}
	
	// Get next row of statement resource 
	abstract public function nextRow($resource);
	
	// Get total count of select rows by query resource
	abstract public function rowCount($resource);
	
	// Get last Id
	abstract public function lastId($resource);
	
	// Get last executed query
	public function lastQuery(){
		return $this->sql_query;
	}
	
	// Fetch select row as assoc array
	abstract protected function row($resource);
	
	// Abstract query to DB
	abstract protected function query($sql_query);
	
	// Abstract function of connection create
	abstract public function createConnection();
	
	// Abstract closing of connection
	abstract public function closeConnection();
}
