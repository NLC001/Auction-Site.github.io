<?php
include_once '../classes/users.php';
    $user = new Users();
    $request = $_SERVER["REQUEST_URI"]; 
    $parts = explode('/', $request);
    $word = end($parts);
switch ($word)
{
    case "register":
      
        $user->first_name = $_POST["first_name"];
        $user->last_name = $_POST["last_name"];
        $user->username = $_POST["username"];
        $user->email = $_POST["email"];
        $user->password = $_POST["password"];
        $user->phone_number = $_POST["phone_number"];
        $user->address = $_POST["address"];
        return $user->register();
    break;

case "get-user":
     $user->get_users();
break;
case "delete-user":
    $user->id=$_POST['id'];
    $user->delete_users();
break;
case "update-user":
    $user->id=$_POST['id'];
    $user->first_name = $_POST["first_name"];
    $user->last_name = $_POST["last_name"];
    $user->username = $_POST["username"];
    $user->email = $_POST["email"];
    $user->password = $_POST["password"];
    $user->phone_number = $_POST["phone_number"];
    $user->address = $_POST["address"];
    $user->update_users();
break;
case "item-register":
    $user->name = $_POST["name"];
    $user->description = $_POST["description"];
    $user->price = $_POST["price"];
    $user->status = $_POST["status"];
    // Handle image upload
        $imageName = "";
        if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
            $imageName = $_FILES["image"]["name"];
            $imagePath = "../item-img/" . $imageName;
            if (file_exists($_FILES["image"]["tmp_name"])) {
                move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
            } else {
               echo "Not Found";
            }
        }
        

        $user->image = $imageName;
        return $user->item_register(); 
  
break;

case "get-item":
 $user->get_items();
break;
case "delete-item":
$user->id=$_POST['id'];
$user->delete_items();
break;
case "update-item":
$user->id=$_POST['id'];
$user->name = $_POST["name"];
$user->description = $_POST["description"];
$user->price = $_POST["price"];
$user->status = $_POST["status"];
$user->update_items();
break;

    default:
        die("Permission denied E-2");
    break;
}

?>
