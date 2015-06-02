<?php
/**
 * This class wraps the database access functionalities for a PostgreSQL database
 *
 * @author Tong Liu
 */
require_once 'config.php';
class DBAccessObject 
{
    private $pgsql_connect;
    
	/**
	 * DatabaseObject constructor
	 */
	public function __construct() {
		$host = DB_HOSTNAME;
        $port = DB_PORT;
		$user = DB_USERNAME; 
		$pass = DB_PASSWORD; 
		$db = DB_NAME; 
		$this->pgsql_connect = pg_connect("host=$host port=$port dbname=$db user=$user password=$pass") or die (pg_result_error());
	}

    /**
     * Closes the non-persistent connection to a PostgreSQL database
     */
    public function closeConnection() {
        pg_close($pgsql_connect);
    }

	/**
     * Clean an array keys and values or a single data point.
     * @param mixed $data The data to clean
     * @return mixed The cleaned data
     */
    public function cleanData($data = null) {
        // If the data is an array.
        if (is_array($data)) {
            // Set up a new array to fill with the cleaned keys and values.
            $cleaned = array();
            // Get the keys.
            $keys = array_keys($data);
            // Clean keys and data.
            foreach ($keys as $key) {
                $cleaned[$this->cleanData($key)] = $this->cleanData($data[$key]);
            }
            // Return cleaned array.
            return $cleaned;
        }
        $data = str_replace("\n", "", $data);
        $data = str_replace("\r", "", $data);
        $data = str_replace("'", "'", $data); // Precaution
        $data = stripslashes($data);
        return pg_escape_string($this->pgsql_connect, $data);
    }

    /**
     * Build and execute SQL insert.
     * @param string $table The table to insert into
     * @param array $data The data in array form to insert
     * @return int mysql_insert_id()
     */
    public function insert($table, $data = null) {
        if (empty($table)) {
            throw new InvalidArgumentException('An INSERT query requires a table.');
        }
        // Build sql
        $data = $this->cleanData($data);
        $sql = "INSERT INTO " . $this->cleanData($table);
        $sql .= " (" . implode(",", array_keys($data)) . ") VALUES (";
        foreach ($data as $value) {
            $sql .= ($value == null ? "NULL," : "'" . $value . "',");
        }
        $sql = substr($sql, 0, -1) . ")";
        // Execute sql
        return $this->query($sql);
    }

    /**
     * Build and execute SQL select.
     * @param string $table The table to select from
     * @param array $keys The keys to select
     * @param string $condition The WHERE clause
     * @return string[]|boolean Returns the result set if successful, FALSE on failure
     */
    public function select($table, $keys = array("*"), $condition = null) {
        if (empty($table)) {
            throw new InvalidArgumentException('An autoconstructed SELECT query requires a table.');
        }
        $keys = $this->cleanData($keys);
        $sql = "SELECT " . implode(",", $keys) . " FROM " . $this->cleanData($table);
        if ($condition !== null) {
            $sql .= " WHERE " . $condition;
        }
        return $this->query($sql);
    }

    /**
     * Build and execute SQL update.
     * @param string $table The table to update
     * @param array $data The data in array form to update
     * @param string $condition The WHERE clause
     * @return boolean
     */
    public function update($table, $data = null, $condition = null) {
        if (empty($table)) {
            throw new InvalidArgumentException('A UPDATE query requires a table.');
        }
        $data = $this->cleanData($data);
        $set = "";
        foreach ($data as $key => $value) {
            $set .= " " . $key . "=" . ($value == null ? "NULL" : "'" . $value . "'") . ",";
        }
        $set = substr($set, 0, -1);
        $sql = "UPDATE " . $this->cleanData($table) . " SET" . $set;
        if ($condition !== null) {
            $sql .= " WHERE " . $condition;
        }
        // Execute query
        $result = pg_query($sql);
        if (!$result) {
            print_r($sql);
            print_r(pg_result_error());
        }
        return($result);
    }

    /**
     * Build and execute SQL delete
     * @param string $table The table to delete from
     * @param string $condition The WHERE clause
     * @return boolean
     */
    public function delete($table, $condition) {
        if (empty($table)) {
            throw new InvalidArgumentException('A DELETE query requires a table.');
        }
        if (empty($condition)) {
            throw new InvalidArgumentException('Unsafe DELETE query. A WHERE condition is required.');
        }
        $primary_key = $this->query("SELECT a.attname, format_type(a.atttypid, a.atttypmod) AS data_type
                            FROM   pg_index i
                            JOIN   pg_attribute a ON a.attrelid = i.indrelid
                                                 AND a.attnum = ANY(i.indkey)
                            WHERE  i.indrelid = '$table'::regclass
                            AND    i.indisprimary;");
        $primary_key = $primary_key[0]['attname'];
        $sql = "DELETE FROM " . $this->cleanData($table) . " WHERE " . $condition;
        // Execute query
        $result = pg_query($sql);
        if (!$result) {
            print_r($sql);
            print_r(pg_result_error());
        }
        return $primary_key;
    }

    /**
     * The general query function
     * @param string $sql The raw SQL query to execute
     * @return string[]|boolean Returns the result of the query
     */
    public function query($sql) {
        // Clean and execute query
        $result = pg_query($this->cleanData($sql));
        // If the query failed we return an error message 
        if (!$result) {
            print_r($sql);
            print_r(pg_result_error());
            return false;
        }
        // If the query result is a resource we set it up
        if (is_resource($result)) {
            // Set up return array and index
            $resultArray = array();
            while ($row = pg_fetch_assoc($result)) {
                $resultArray[] = $row;
            }
            // Return results
            return $resultArray;
        }
        return $result;
    }
}