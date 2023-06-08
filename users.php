<?php
include_once '../config/database.php';
class Users extends DB
{
//    abc
    public $first_name;
    public $name;
    public $description;
    public $price;
    public $status;
    public $last_name;
    public $email;
    public $password;
    public $username;
    public $phone_number;
    public $address;
    public $image;
    public $id;
    public function register()
    {
        $User_Arr["first_name"] = $this->first_name;
        $User_Arr["last_name"] = $this->last_name;
        $User_Arr["username"] = $this->username;
        $User_Arr["phone_number"] = $this->phone_number;
        $User_Arr["address"] = $this->address;
        $User_Arr["email"] = $this->email;
        $User_Arr["password"] = $this->password;
        $result = $this->check_user("users", $User_Arr["email"]);
        if (!empty($result))
        {
            http_response_code(409);
            echo json_encode(array(
                "status" => false,
                "message" => "Email already Exist,Try Another Email"
            ));
        }
        else
        {
            $result = $this->add("users", $User_Arr);
            if ($result)
            {
                http_response_code(200);
                echo json_encode(array(
                    "status" => true,
                    "message" => "Registered Successfully",
                ));
            }
            else
            {
                 http_response_code(500);
                 echo json_encode(array(
                    "status" => false,
                    "message" => "Registered Failed"
                ));

            }

        }

    }
    public function update_users()
    {
        $id= $this->id;
        $User_Arr["first_name"] = $this->first_name;
        $User_Arr["last_name"] = $this->last_name;
        $User_Arr["username"] = $this->username;
        $User_Arr["phone_number"] = $this->phone_number;
        $User_Arr["address"] = $this->address;
        $User_Arr["email"] = $this->email;
        $User_Arr["password"] = $this->password;
        $result = $this->check_user_id("users", $id);
        if (empty($result))
        {
            http_response_code(409);
            echo json_encode(array(
                "status" => false,
                "message" => "User Not Exist"
            ));
        }
        else
        {
            $result = $this->edit("users", $User_Arr,$id);
            if ($result)
            {
                http_response_code(200);
                echo json_encode(array(
                    "status" => true,
                    "message" => "Updated Successfully",
                ));
            }
            else
            {
                 http_response_code(500);
                 echo json_encode(array(
                    "status" => false,
                    "message" => "Update Failed"
                ));

            }

        }

    }
    public function get_users()
    {
            $result = $this->get_user("users");
            $object = json_decode(json_encode($result), FALSE);
            if($object)
            {
             
             http_response_code(200);
             echo json_encode(array(
             "status" => true,
             "Data"=> $object
                 ));

            }
            else
            {
                http_response_code(404);
                echo json_encode(array(
                    "status" => false,
                    "message" => "Data Not Found"
                ));
            }
    
  
}  
public function delete_users()
{
       $id=$this->id;
        $result = $this->delete_user("users",$id);
        if($result)
        {
         
         http_response_code(200);
         echo json_encode(array(
         "status" => true,
         "message"=> "User Deleted Successfully"
             ));

        }
        else
        {
            http_response_code(404);
            echo json_encode(array(
                "status" => false,
                "message" => "Fialed To Delete User"
            ));
        }


}  
public function item_register()
{
    $Items["name"] = $this->name;
    $Items["description"] = $this->description;
    $Items["price"] = $this->price;
    $Items["status"] = $this->status;
    $Items["image"] = $this->image;

    $result = $this->add("items", $Items);
    if ($result) {
        http_response_code(200);
        echo json_encode(array(
            "status" => true,
            "message" => "Item added Successfully",
        ));
    } else {
        http_response_code(500);
        echo json_encode(array(
            "status" => false,
            "message" => "Item Failed To Added"
        ));
    }
}

public function update_items()
{
    $id= $this->id;
    $Items["name"] = $this->name;
    $Items["description"] = $this->description;
    $Items["price"] = $this->price;
    $Items["status"] = $this->status;
    $result = $this->check_user_id("items", $id);
    if (empty($result))
    {
        http_response_code(409);
        echo json_encode(array(
            "status" => false,
            "message" => "Item Not Exist"
        ));
    }
    else
    {
        $result = $this->edit("items", $Items,$id);
        if ($result)
        {
            http_response_code(200);
            echo json_encode(array(
                "status" => true,
                "message" => "Updated Successfully",
            ));
        }
        else
        {
             http_response_code(500);
             echo json_encode(array(
                "status" => false,
                "message" => "Update Failed"
            ));

        }

    }

}
public function get_items()
{
        $result = $this->get_user("items");
        $object = json_decode(json_encode($result), FALSE);
        if($object)
        {
         
         http_response_code(200);
         echo json_encode(array(
         "status" => true,
         "Data"=> $object
             ));

        }
        else
        {
            http_response_code(404);
            echo json_encode(array(
                "status" => false,
                "message" => "Data Not Found"
            ));
        }


}  
public function delete_items()
{
   $id=$this->id;
    $result = $this->delete_user("items",$id);
    if($result)
    {
     
     http_response_code(200);
     echo json_encode(array(
     "status" => true,
     "message"=> "Item Deleted Successfully"
         ));

    }
    else
    {
        http_response_code(404);
        echo json_encode(array(
            "status" => false,
            "message" => "Fialed To Delete Item"
        ));
    }


}  
}
?>

