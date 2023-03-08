<?php
 include '../connection.php';
    if(isset($_GET['view']))
    {
        $id=$_GET['view'];

        $query = oci_parse($connection,"SELECT * FROM REQUEST WHERE REQ_ID=$id");
        $result= oci_execute($query);

        if($result)
        {
            $row = oci_fetch_row($query);
        }
       
    }
    else{
        header("Location: request.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
             body{
                background-color:#293241; 
                display:flex;
                justify-content:flex-start;
                align-items:center;
                flex-direction:column;
                color:white;
                /* border: 2px solid green; */
                
             }
             h1
             {
                 color:royalblue;
             }
             p
             {
                 font-size:25px;
             }
             a
             {
                 
                 display:inline-block;
                 text-decoration:none;
                 
                 color:white;
                 
             }
             .app
             {
                 background-color:green;
                 padding:20px;
                 margin-bottom:3px;
                 position:absolute;
                 bottom:60px;
                 right:700px;
                 border:none;
                 border-radius:10px;
             }
             .DEC
             {
                background-color:red;
                 padding:20px;
                 position:absolute;
                 bottom:60px;
                 right:570px;
                 border:none;
                 border-radius:10px;
             }
             .home
             {
                background-color:purple;
                 padding:20px;
                 position:absolute;
                 bottom:20px;
                 right:110px;
                 border:none;
                 border-radius:10px;
             }
             .home :hover
             {
                 color:red;
             }
             
             


        </style>

</head>
<body>
    <h1>DETAILS</h1>
    <p>Name : <?php echo $row['1']?></p>
    <p>Email : <?php echo $row['2']?></p>
    <p>Contact : <?php echo $row['3']?></p>
    <p>shop : <?php echo $row['4']?></p>
    <p>Description : <?php echo $row['5']?></p>
    <p>Type : <?php echo $row['6']?></p>

    <a href="approve.php?approve=<?php echo $id?>"><span class="app">APPROVE</span></a>
    
    <a href="decline.php?decline=<?php echo $id?>"><span class="DEC">DECLINE</span></a>


    <a href="manageacc.php"><span class="home"> Manage Trader</span></a>

</body>
</html>