<?php
require_once "pdo.php";
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP Demo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
      main > .container {
        padding: 60px 15px 0;
        }
    </style>

</head>
  <body class="d-flex flex-column">
    <?php
        require_once("nav.php")
    ?>
  <main class="flex-shrink-0">
    <div class="container">
<?php

if ( isset($_POST['name']) && isset($_POST['email'])
     && isset($_POST['password']) && isset($_POST['user_id']) ) {

    // Data validation
    if ( strlen($_POST['name']) < 1 || strlen($_POST['password']) < 1) {
        $_SESSION['error'] = 'Missing data';
        header("Location: edit.php?user_id=".$_POST['user_id']);
        return;
    }

    if ( strpos($_POST['email'],'@') === false ) {
        $_SESSION['error'] = 'Invalid E-mail Address';
        header("Location: edit.php?user_id=".$_POST['user_id']);
        return;
    }

    $sql = "UPDATE users SET name = :name,
            email = :email, password = :password
            WHERE user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':name' => $_POST['name'],
        ':email' => $_POST['email'],
        ':password' => $_POST['password'],
        ':user_id' => $_POST['user_id']));
    $_SESSION['success'] = 'Record updated';
    header( 'Location: index.php' ) ;
    return;
}

// Guardian: Make sure that user_id is present
if ( ! isset($_GET['user_id']) ) {
  $_SESSION['error'] = "Missing user_id";
  header('Location: index.php');
  return;
}

$stmt = $pdo->prepare("SELECT * FROM users where user_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['user_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for user_id';
    header( 'Location: index.php' ) ;
    return;
}

// Flash pattern
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}

$n = htmlentities($row['name']);
$e = htmlentities($row['email']);
$p = htmlentities($row['password']);
$user_id = $row['user_id'];
?>
<h2>Edit User</h2>
<form method="post" class="form-control">
    <p>Name:
    <input class="form-control" type="text" name="name" value="<?= $n ?>"></p>
    <p>Email:
    <input class="form-control" type="text" name="email" value="<?= $e ?>"></p>
    <p>Password:
    <input class="form-control" type="text" name="password" value="<?= $p ?>"></p>
    <input class="form-control" type="hidden" name="user_id" value="<?= $user_id ?>">
    <p><input type="submit" value="Update" class="btn btn-primary"/>
    <a href="index.php" class="btn btn-secondary" type="button">Cancel</a></p>
</form>

</div>
</main>
<?php
    require_once("footer.php")
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
