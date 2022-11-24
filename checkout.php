<?php 
    include "connect.php";
  
    session_start();
    if(isset($_SESSION["username"]) and isset($_SESSION["cart"])) {
        $username = $_SESSION["username"];
        $total = $_SESSION["sumprice"];

        $sql = "INSERT INTO orders(username, total) VALUES('$username','$total')";
        mysqli_query($conn,$sql);
        
        $stmt = $pdo->prepare("SELECT * FROM orders");
        $stmt->execute();

        $findord_id = 0;
        while ($row = $stmt->fetch()):
            $findord_id += 1;
        endwhile; 
        
        foreach ($_SESSION["cart"] as $item) {
            $pid = $item["pid"];
            $quantity = $item["qty"];
            $sql2 = "INSERT INTO item(ord_id, pid, quantity) VALUES('$findord_id','$pid','$quantity')";
            mysqli_query($conn,$sql2);
        }
        mysqli_close($conn);

        session_destroy();
        header("location: home.php");
    } else {
        header("location: signin.php");
    }
?>