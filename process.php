<?php 
session_start();

$mysqli=new mysqli('localhost','root','','crud')or die(mysqli_error($mysqli));
$name='';
$location='';
$update=false;
$id=0;//to access the hidden input id required for update button
//when clicked will POST it to the database

if(isset($_POST['save'])){
    $name=$_POST['name'];
    $location=$_POST['location'];

    $mysqli->query("INSERT INTO data (name,location)VALUES ('$name','$location')")
    or die($mysql->error);

    $_SESSION['message']="Record has been saved successfuly!";
    $_SESSION['msg_type']="success";
    header("location: crud.php");
}
if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id")or die($mysqli->error());

    
    $_SESSION['message']="Record has been deleted!";
    $_SESSION['msg_type']="danger";
    header("location: crud.php");
}

if(isset($_GET['edit'])){
    $id=$_GET['edit'];
    $update=true;
    $result=$mysqli->query("SELECT * FROM data WHERE id=$id")or die($mysqli->error());
    
    if (array($result) !==null){
        
        $row=$result->fetch_array();
        $name=$row['name'];
        $location=$row['location'];
    }
}

if(isset($_POST['update'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $location=$_POST['location'];

    $mysqli->query("UPDATE  data SET name='$name',location='$location' WHERE id=$id")
    or die($mysql->error);

    $_SESSION['message']="Record has been updated successfuly!";
    $_SESSION['msg_type']="success";
    header("location: crud.php");
}

?>
