
<?php
require_once "pdo.php";
?>



<?php
   
        $user_id = $_POST['user_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        // calling stored procedure command
        $sql = 'CALL usp_post_user (:user_id, :name, :email, :password, @newid)';
     
        // prepare for execution of the stored procedure
        $stmt = $pdo->prepare($sql);

        // pass value to the command
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);

        // execute the stored procedure
        $stmt->execute();

        $stmt->closeCursor();
        // execute the second query to get customer's level
        $row = $pdo->query("SELECT @newid AS newid")->fetch(PDO::FETCH_ASSOC);

        $arr = array();
       
        if ($row) 
        {
            array_push($arr,$row !== false ? (int)$row['newid'] : 0);
            array_push($arr,$row !== false ? "OK" : "ERROR");
            echo json_encode($arr);
           // echo sprintf($row !== false ? (int)$row['newid'] : "Something went wrong, contact system administrator!");  
        }
    

   
?>
