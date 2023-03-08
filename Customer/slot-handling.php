<?php
    include 'connect.php';
    // include 'header.php';

    if(isset($_POST['time-range'])){
        $collection_day = $_POST['dayselected'];
        $collection_time = $_POST['time-otd'];
        $collection_slot = $collection_day ." ". $collection_time;
        
        echo $collection_time;
        echo $collection_slot;
        // $collection_query = "INSERT INTO ORDERS (COLLECTION_SLOT)"

        // header('location: time.php');
    }

?>