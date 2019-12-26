<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  
    <title>APP CRUD</title>
</head>
<body>
<div class="header mt-3 ml-3">
<h2> PHP and MySQL CRUD Application </h2>
</div>
<?php require_once 'process.php'; ?>

<?php 
    if (isset($_SESSION['message'])):;
?>
<div class="alert alert-<?=$_SESSION['msg_type']?>">

<?php 
    echo $_SESSION['message'];
    unset($_SESSION['message']);
?>

</div>

<?php endif  ?>

<?php 
    $mysqli=new mysqli('localhost','root','','crud')or die(mysqli_error($mysqli));
    $result=$mysqli->query("SELECT * FROM data") or die(mysqli_error($mysqli));

?>



<div class="row justify-content-center" >
    <form action="process.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="form-group">
    <label>Name</label>
    <input type="text" name="name" class="form-control" 
    value="<?php echo $name; ?>" placeholder="enter your name"></input>
    </div>
    <div class="form-group">
    <label>Location</label>
    <input type="text" name="location" class="form-control"
    value="<?php echo $location; ?>"  placeholder="enter your location"></input>
    
    </div>
    <div class="form-group">
    <?php if ($update==true): ?>
    <button type="submit" class="btn btn-info" name="update">update</button></div>
    <?php else:?>
    <button type="submit" class="btn btn-primary" name="save">save</button></div>
    <?php endif; ?>
    </form>
    </div>

    <div class="container">

    <div class="row justify-content-center">
    <table class="table">
    <thead>
    <tr>
    <th>Name</th>
    <th>location</th>
    <th colspan="2">action</th>
    </tr>
    </thead>




    <?php  while ($row=$result->fetch_assoc()): ?>
    <tr>
    <td><?php echo $row['name'];?></td>
    <td><?php echo $row['location'];?></td>
    <td>
        <a href="crud.php?edit=<?php echo $row['id'];?>"
        class="btn btn-info">Edit
        </a>
        <a href="process.php?delete=<?php echo $row['id'];?>"
        class="btn btn-danger">Delete
        </a>
    
    </td>
    </tr>
    <?php endwhile; ?>
    
    </table>
    </div>

    <?php
    function pre_r($array){
        echo '<pre>';
        print_r($array);
        echo'</pre>';
    }
    ?>
    </div>
</body>
</html>






