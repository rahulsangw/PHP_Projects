
<?php require "config.php";?>

<?php

  if(isset($_POST['submit'])){
    if($_POST['url']==""){
        echo "The input is empty";
    }else{
        $url = $_POST["url"];
        $query = "insert into urls(url,created_at)values('$url',current_timestamp);";
        $result = pg_query($db,$query);
    }
  }

  $query = "Select * from urls";
  $result = pg_query($db,$query) or die("Query not executed");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


    <style>
        
        .container{
            height: 100vh;
            display: flex;
            flex-direction:column;
            justify-content: center;
        }
        .container .row-1{
            display: flex;
            flex-direction: row;
            
        }
        
    </style>

</head>
<body>

<div class="container">
    <form action="index.php" method="post">
        <div class="row row-1">
            <div class="col-8">
                <input name="url" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            </div>
            
            <div class="col-2">
                <button class="btn btn-success" name="submit" type="submit">Generate</button>
            </div>
            
        </div>
    </form>
    
    <div class="row row-2">
        <table class="table">
        <thead>
            <tr>
            <th scope="col">Long Url</th>
            <th scope="col">Short Url</th>
            <th scope="col">Clicks</th>
            <th scope="col">Time Stamp</th>
            </tr>
        </thead>
        <tbody>
        <?php
            while($row= pg_fetch_row($result)){
                echo "<tr>
                    <td>$row[1]</td>
                    <td>
                    <a href='http://127.0.0.1/short-urls/u/?id=$row[0]' target ='_blank'>http://127.0.0.1/short-urls/u/?id=$row[0]</a>
                    </td>
                    <td>$row[2]</td>
                    <td>$row[3]</td>
                    </tr>
                    ";
                }
            ?>
        </tbody>
        </table>
    </div>
</div>

</body>


</html>



