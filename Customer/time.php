<?php
    include 'connect.php';
    include 'header.php';

    $total_amount = $_POST['total_amount'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https:fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/time.css">
    <script src="javascript/navbar.js" async></script>
    <title>Document</title>
</head>
<body>
    <?php
        include 'navbar.php';
    ?>

    <div class="main-container">
        <div class="ctime">
            <h1>Collection Time</h1>
            <div class="forms">
                <form action="order-handling.php" method="POST">
                    <select name="hour" class="dropdown">
                        <?php
                        if(isset($_POST['date'])){
                        $time = $_POST['time-otd'];
                        $dayselected = $_POST['day'];
                        $today = date("l");
                        
                        if ($today == 'Friday') { //if purchase day is friday, then all days & slots for next week is open
                            echo "<option value='10AM to 1PM'> 10AM to 1PM </option>";
                            echo "<option value='1PM to 4PM'>1PM to 4PM</option>";
                            echo "<option value='4PM to 7PM'>4PM to 7PM</option>";
                        } //inside friday
                        elseif ($today == 'Tuesday') {
                            if ($time >= 19) {    //if purchase day is tuesday and time is 7pm or late
                                echo "<option value='10AM to 1PM'> 10AM to 1PM </option>"; //all slots for thurday, friday and next wednesday is open
                                echo "<option value='1PM to 4PM'>1PM to 4PM</option>";
                                echo "<option value='4PM to 7PM'>4PM to 7PM</option>";
                            }
                            elseif ($time < 10) //if purchase day is tuesday and time is 10am or earlier
                            {
                                echo "<option value='10AM to 1PM'> 10AM to 1PM </option>"; //all slots for upcoming next are open
                                echo "<option value='1PM to 4PM'>1PM to 4PM</option>";
                                echo "<option value='4PM to 7PM'>4PM to 7PM</option>";
                            } elseif (($time >= 13 || $time <= 15) && $dayselected == 'WEDNESDAY') {
                                echo "<option disabled value='10AM to 1PM'> 10AM to 1PM </option>"; //if purchase day is tuesday and time is between 1pm to 3pm and
                                echo "<option value='1PM to 4PM'>1PM to 4PM</option>";                ////Collection day is Wednesday, the first slot is unavailable
                                echo "<option value='4PM to 7PM'>4PM to 7PM</option>";
                            } elseif (($time >= 15 || $time <= 18) && $dayselected == 'WEDNESDAY') {
                                echo "<option disabled value='10AM to 1PM'> 10AM to 1PM </option>"; //if purchase day is tuesday and time is between 4pm to 6pm and
                                echo "<option disabled value='1PM to 4PM'>1PM to 4PM</option>";    ////Collection day is Wednesday,only the last slot is available
                                echo "<option value='4PM to 7PM'>4PM to 7PM</option>";
                            } else {
                                echo "<option value='10AM to 1PM'> 10AM to 1PM </option>"; //
                                echo "<option value='1PM to 4PM'>1PM to 4PM</option>";
                                echo "<option value='4PM to 7PM'>4PM to 7PM</option>";
                            }
                        } //inside tuesday
                        elseif ($today == 'Wednesday') {
                            if ($time >= 19) {
                                echo "<option value='10AM to 1PM'> 10AM to 1PM </option>"; //if purchase day is wednesday and time is 7pm or late
                                echo "<option value='1PM to 4PM'>1PM to 4PM</option>";    //all slots from friday and upcoming wed and thursday is free
                                echo "<option value='4PM to 7PM'>4PM to 7PM</option>";
                            } elseif ($time < 10) {
                                echo "<option value='10AM to 1PM'> 10AM to 1PM </option>";    //if purchase day is wednesday and time is 10am or earlier
                                echo "<option value='1PM to 4PM'>1PM to 4PM</option>";        ////all slots are open
                                echo "<option value='4PM to 7PM'>4PM to 7PM</option>";
                            } elseif (($time >= 13 && $time <= 15) && $dayselected == 'THURSDAY') {
                                echo "<option disabled value='10AM to 1PM'> 10AM to 1PM </option>";    //if purchase day is wednesday and time is between 1pm to 3pm and Collection day
                                echo "<option value='1PM to 4PM'>1PM to 4PM</option>";                //thursday, only the first slot is unavailable
                                echo "<option value='4PM to 7PM'>4PM to 7PM</option>";
                            } elseif (($time >= 15 && $time <= 18) && $dayselected == 'THURSDAY') {
                                echo "<option disabled value='10AM to 1PM'> 10AM to 1PM </option>";    //if purchase day is wednesday and time is between 4pm to 6pm and Collection day
                                echo "<option disabled value='1PM to 4PM'>1PM to 4PM</option>";        //thursday the last slot is available
                                echo "<option value='4PM to 7PM'>4PM to 7PM</option>";
                            } else {
                                echo "<option value='10AM to 1PM'> 10AM to 1PM </option>"; //else all slots for any days selected is free
                                echo "<option value='1PM to 4PM'>1PM to 4PM</option>";
                                echo "<option value='4PM to 7PM'>4PM to 7PM</option>";
                            }
                        } //inside wednesday
                        elseif ($today == 'Thursday') {
                            if ($time >= 19) {
                                echo "<option value='10AM to 1PM'> 10AM to 1PM </option>"; //if purchase day is thursday and time is 7pm or late
                                echo "<option value='1PM to 4PM'>1PM to 4PM</option>";        //all slots for next days are open
                                echo "<option value='4PM to 7PM'>4PM to 7PM</option>";
                            } elseif ($time < 10) {
                                echo "<option value='10AM to 1PM'> 10AM to 1PM </option>"; //if purchase day is thursday and time is 10am or earlier
                                echo "<option value='1PM to 4PM'>1PM to 4PM</option>";        //all slots are open
                                echo "<option value='4PM to 7PM'>4PM to 7PM</option>";
                            } elseif (($time >= 13 && $time <= 15) && $dayselected == 'FRIDAY') {
                                echo "<option disabled value='10AM to 1PM'> 10AM to 1PM </option>"; //if purchase day is thursday and time is between 1pm to 3pm and Collection day
                                echo "<option value='1PM to 4PM'>1PM to 4PM</option>";                //is friday then only the first slot is unavailable
                                echo "<option value='4PM to 7PM'>4PM to 7PM</option>";
                            } elseif (($time >= 15 && $time <= 18) && $dayselected == 'FRIDAY') {
                                echo "<option disabled value='10AM to 1PM'> 10AM to 1PM </option>"; //if purchase day is thursday and time is between 4pm to 6pm and Collection day
                                echo "<option disabled value='1PM to 4PM'>1PM to 4PM</option>";        //is friday, only the last slot is available
                                echo "<option value='4PM to 7PM'>4PM to 7PM</option>";
                            } else {
                                echo "<option value='10AM to 1PM'> 10AM to 1PM </option>"; //else all slots for any days selected is free
                                echo "<option value='1PM to 4PM'>1PM to 4PM</option>";
                                echo "<option value='4PM to 7PM'>4PM to 7PM</option>";
                            }
                        } //thursday
                        else{
                            echo "<option value='10AM to 1PM'> 10AM to 1PM </option>";
                            echo "<option value='1PM to 4PM'>1PM to 4PM</option>";
                            echo "<option value='4PM to 7PM'>4PM to 7PM</option>";
                        }
                        }
                        ?>
                    </select>
                    <input type="hidden" name="dayselected" value="<?php echo $dayselected?>">
                    <input type="hidden" name="total_amount" value="<?php echo $total_amount?>">
                    <input type="submit" name="time-range" value="Submit" id="time-btn">
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<!-- https://www.sandbox.paypal.com/cgi-bin/webscr -->

<?php
    // if($_SERVER["REQUEST_METHOD"] == "POST"){
    //     $day_otw = $_POST['day'];
    //     echo $day_otw;
    // }
?>