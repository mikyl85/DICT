
<?php
require_once "pdo.php";
?>


<?php
   
   $user_id = $_GET['user_id'];

 
   // calling stored procedure command
   $sql = 'CALL usp_delete_user (:user_id,  @remark)';

   // prepare for execution of the stored procedure
   $stmt = $pdo->prepare($sql);

   // pass value to the command
   $stmt->bindParam(':user_id',$user_id, PDO::PARAM_INT);

   // execute the stored procedure
   $stmt->execute();

   $stmt->closeCursor();
   // execute the second query to get customer's level
   $row = $pdo->query("SELECT @remark AS remark")->fetch(PDO::FETCH_ASSOC);


   if ($row) 
   {
    echo sprintf ($row['remark']); 
     // echo sprintf ($row !== false ? $row['remark'] : "Something went wrong, contact system administrator!");  
   }



?>
