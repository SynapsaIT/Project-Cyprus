<?php
class MySQL {

    function connect()
    {
        // connect to mysql
        $this->link = mysql_connect($this->db_host, $this->db_user, $this->db_pwd)
        or die("Could not connect to mysql server: " . mysql_error());
        // connect to the database
        mysql_query('SET character_set_connection=utf8_polish_ci');
        mysql_query('SET character_set_client=utf8_polish_ci');
        mysql_query('SET character_set_results=utf8_polish_ci');
        mysql_query(' SET NAMES utf8 ');
        mysql_select_db($this->db_name, $this->link)
        or die("Database: database not found");
        $this->connections++;
	mysql_query ('SET NAMES utf8',$this->link);
	mysql_query ('SET CHARACTER_SET utf8_unicode_ci',$this->link);
        // return $db_link for other functions
        // return $link;
    }

    function query($sql)
    {
	//echo $sql . "<br>";
        if (!isset($this->link)) {
            $this->connect();
        }

        $result = mysql_query($sql, $this->link)
        or die("Invalid query: " . mysql_error());
        // used for other functions
        $this->queries++;
		$this->sql_debug[] = $sql;
        return $result;
    }

    function fetch_array($result)
    {
        // create an array called $row
        $row = mysql_fetch_array($result);
        // return the array $row or false if none found
        return $row;
    }

    function num_rows($result)
    {
        // determine row count
        $num_rows = mysql_num_rows($result);
        // return the row count or false if none foune
        return $num_rows;
    }

    function insert_id()
    {
        // connect to the database
        // $link = $this->connect();
        // Get the ID generated from the previous INSERT operation
        $last_id = mysql_insert_id($this->link);
        // return last ID
        return $last_id;
    }

    function num_fields($result)
    {
        $result = mysql_num_fields($result);
        return $result;
    }
}

?>
