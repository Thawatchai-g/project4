<?php include "connect.php" ?>
<?php 
    $stmt = $pdo->prepare("DELETE FROM orders WHERE ord_id=?");
    $stmt->bindParam(1, $_GET["ord_id"]);
    if($stmt->execute())
        header("location: admin.php")
?>