<?php
    $sucess="";
    if(isset($_GET['sucess']))
    {
        $sucess="Trader Successfully Registered";
        
    }

    $decline="";
    if(isset($_GET['decline']))
    {
        $decline="Trader Successfully Delete";
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
                justify-content:center;
                align-items:center;
                flex-direction:column;
                color:white;
                margin-top:100px;
                


                }
                
                h1
                {
                    margin-left:15px;
                    font-weight:bold;
                    font-style:underline;
                    font-size:40px;
                }
                table
                {
                    text-align:center;
                    border:none; 
                    
                }
                tr
                {
                    
                    font-size:30px;
                    

                }
                th
                {
                    color:royalblue;
                    background-color:lightblue;
                }
                tr:hover
                {
                    background-color:white;
                    color:#293241;
                }
                td a
                {
                    text-decoration:none;
                    color:green;
                }
                .a{
                    color:red;
                }


    </style>

</head>
<body>
    
    <h1>REQUEST TABLE</h1>
    <?php if($sucess!=""){?>
        <h5 style="color:#155724; "><?php echo $sucess;?></h5>
    <?php }?>

     <?php if($decline!=""){?>
        <h5 style="color:#F8D7DA; "><?php echo $decline;?></h5>
    <?php }?>
    <table border="1"width=90%>

    <thead>
        <th>Name</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Shop</th>
        <th>Type</th>
        <th>Action</th>
    </thead>

    <?php 
        include '../connection.php';

        $query = oci_parse($connection," SELECT * FROM REQUEST WHERE 1=1");
        $result= oci_execute($query);
        if($result)
        {
            while($row = oci_fetch_row($query)): ?>
                <tr>
                    <td><?php echo $row['1']?></td>
                    <td><?php echo $row['2']?></td>
                    <td><?php echo $row['3']?></td>
                    <td><?php echo $row['4']?></td>
                    <td><?php echo $row['6']?></td>
                
                    <td>
                        <a href="viewdetails.php?view=<?php echo $row['0']?>">View</a> / 
                        <a href="decline.php?decline=<?php echo $row['0']?>"><span class="a">Decline</span></a>
                    </td>
                </tr>
            <?php endwhile;
        } ?>
    </table>
    
</body>
</html>