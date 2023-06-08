<?php
class DB
{

    //  // Here We are declared variables for Db Connection
    private $hostname;
    private $dbname;
    private $username;
    private $password;

    private $conn;

    public function connect()
    {
        $this->hostname ="localhost"; 
        $this->dbname = "auction_db";
        $this->username = "root";
        $this->password = "";
 
      $this->conn = new mysqli($this->hostname, $this->username, $this->password, $this->dbname);
      
        if ($this
            ->conn
            ->connect_errno)
        {
            // if it is true then its means there is an error in the connection
            print_r($this
                ->conn
                ->connect_error);
            exit();
        }
        else
        {
            //No error in Connection and return Conn Variable Here
            return $this->conn;
            // print_r($this->conn);
            
        }
    }

    public function add($table, $values)
    {
        $columns = implode(", ", array_keys($values));
        $escaped_values = array_map(function ($value)
        {
            if (is_string($value))
            {
                return "'" . $this->connect()
                    ->real_escape_string($value) . "'";
            }
            if (is_null($value))
            {
                return 'null';
            }
            return $value;
        }
        , array_values($values));
        $values = implode(", ", $escaped_values);
        $user_query = "INSERT INTO " . $table . " ($columns) VALUES ($values)";

        $result = $this->connect()
            ->query($user_query);
        return $result;

    }
    public function edit($table, $values, $id)
    {
        $updates = array();
        foreach ($values as $key => $value)
        {
            if (is_string($value))
            {
                $updates[] = "$key='" . $this->connect()->real_escape_string($value) . "'";
            }
            elseif (is_null($value))
            {
                $updates[] = "$key=null";
            }
            else
            {
                $updates[] = "$key=$value";
            }
        }
        $updates_str = implode(", ", $updates);
        $query = "UPDATE $table SET $updates_str WHERE id=?";
        $stmt = $this->connect()->prepare($query);
        $stmt->bind_param("i", $id);
        if ($stmt->execute())
        {
            return true;
        }
        return false;
    }
    
 
    public function check_user($table, $value)
    {
        $email_query = "SELECT * from " . $table . " where email =?";
        $usr_obj = $this->connect()
            ->prepare($email_query);
        $usr_obj->bind_param("s", $value);
        if ($usr_obj->execute())
        {
            $data = $usr_obj->get_result();
            return $data->fetch_assoc();

        }
        return array();
    }
    public function check_user_id($table, $value)
    {
        $email_query = "SELECT * from " . $table . " where id =?";
        $usr_obj = $this->connect()
            ->prepare($email_query);
        $usr_obj->bind_param("s", $value);
        if ($usr_obj->execute())
        {
            $data = $usr_obj->get_result();
            return $data->fetch_assoc();

        }
        return array();
    }
    public function get_user($table)
    {
        $query = "SELECT * FROM $table";
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute())
        {
            $result = $stmt->get_result();
            $users = array();
            while ($row = $result->fetch_assoc())
            {
                $users[] = $row;
            }
            return $users;
        }
        return array();
    }
    public function delete_user($table, $id)
    {
        $query = "DELETE FROM $table WHERE id = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->bind_param("i", $id);
        if ($stmt->execute())
        {
            return true;
        }
        return false;
    }


}

?>
