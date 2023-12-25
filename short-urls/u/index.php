<?php require "../config.php" ?>

<?php

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $query= "select * from urls where id=$id;";
        $res = pg_query($db,$query);
        $row= pg_fetch_row($res);
        $clicks = $row[2]+1;
        $upd_query = "Update urls set clicks=$clicks where id=$row[0]";
        $update_res= pg_query($db,$upd_query);
        header("location: ".$row[1]." ");
    }

?>
