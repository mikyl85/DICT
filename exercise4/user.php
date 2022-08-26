
<?php
require_once "pdo.php";
?>


<?php
   
    if($_GET['user_id'] > 0)
    {
        $stmt = $pdo->prepare("SELECT * FROM users where user_id = :a");
        $stmt->execute(array(":a" => $_GET['user_id']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $name = $row['name'];
        $email = $row['email'];
        $password = $row['password'];
        $user_id = $row['user_id'];

    }
   else
   {
    $user_id = $_GET['user_id'];
    $name ="";
    $email = "";
    $password = "";
   
   }
  
?>


<form method="post" class="form-control">
    <input type="hidden" id="user_id" name="user_id" value="<?=$user_id?>">
    <div class="mb-3">
    <label for="name" class="form-label">User Name</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="name" value="<?=$name?>">
    </div>
    <div class="mb-3">
    <label for="email" class="form-label">Email Address</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="name@gmail.com" value="<?=$email?>">
    </div>
    <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="Password" class="form-control" id="password" name="password" placeholder="name@gmail.com" value="<?=$password?>">
    </div>
</form>




