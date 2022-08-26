
<?php
require_once "pdo.php";
?>



<?php
    $arr = array();
    $stmt = $pdo->query("select user_id, name, email,password from users");
   
    while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
        array_push($arr,$row);
    }

  echo json_encode($arr);

?>


