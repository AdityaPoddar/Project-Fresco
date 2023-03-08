<?php
    include 'connect.php';
    include 'header.php';

    $total_amount = $_GET['total_amount'];

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
    <link rel="stylesheet" href="styles/slot.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <script src="javascript/navbar.js" async></script>
    <title>Document</title>
</head>
<body>
    <?php
        include 'navbar.php';
    ?>

    <div class="main-container">

        <div class="cslot">
            <h1>Collection Slot</h1>
            <h2>Today's date: <?php echo date("Y/m/d l");?></h2>
            <?php
                date_default_timezone_set('Asia/Kathmandu');
                $date = date('Y-m-d');
                $time = date('H');
                $day = strtoupper(date('l'));
                $slots = [];
            ?>
            
            <div class="form-container">
                <form action="time.php" method="post">
                    <h4>Choose your preferred collection day:</h4>
                    <input type="hidden" name="time-otd" value="<?php echo $time?>">
                    <input type="hidden" name="total_amount" value="<?php echo $total_amount?>">
                    <select name="day" class="dropdown">
                        <?php
                        // Prints the day
                        $today = date("l");
                
                        $time = date("H"); //the current time in 24 hr format
                        if ($today == 'Friday') { //if purchase day is friday, then all days & slots for next week is open
                            echo "<option value='NEXT WEDNESDAY' selected>Next Wednesday</option>";
                            echo "<option value='NEXT THURSDAY'>Next Thursday</option>";
                            echo "<option value='NEXT FRIDAY'>Next Friday</option>";
                        } elseif ($today == 'Thursday' && $time >= 19) //if purchase day is thursday & time is 7pm or late then all days & slots for next week is open
                        {
                            echo "<option value='NEXT WEDNESDAY' selected>Next Wednesday</option>";
                            echo "<option value='NEXT THURSDAY'>Next Thursday</option>";
                            echo "<option value='NEXT FRIDAY'>Next Friday</option>";
                        } elseif ($today == 'Thursday' && $time < 19) //if purchase day is thursday & time is earlier than 7pm then
                        {
                            echo "<option value='NEXT WEDNESDAY' selected>Next Wednesday</option>";
                            echo "<option value='NEXT THURSDAY'>Next Thurday</option>";
                            echo "<option value='FRIDAY'> Friday</option>";            //friday's one slot is open
                        } elseif ($today == 'Wednesday' && ($time >= 19)) //if purchase day is wednesday and time is 7pm or late
                        {
                            echo "<option value='NEXT WEDNESDAY' selected>Next Wednesday</option>";
                            echo "<option value='NEXT THURSDAY'>Next Thursday</option>";
                            echo "<option value='FRIDAY'>Friday</option>";    //only Friday's all slot are open
                        } elseif ($today == 'Wednesday' && $time < 19) {    //if purchase day is wednesday and time is earlier than 7pm
                            echo "<option value='NEXT WEDNESDAY' selected>Next Wednesday</option>";
                            echo "<option value='THURSDAY'> Thursday</option>"; //selected thursday's slots are open
                            echo "<option value='FRIDAY'>Friday</option>"; //Friday's all slots are open
                        } elseif ($today == 'Tuesday' && $time >= 19) //if purchase day is tuesday and time is 7pm or late
                        {
                            echo "<option value='NEXT WEDNESDAY' selected>Next Wednesday</option>";
                            echo "<option value='THURSDAY'>Thursday</option>";    //All slots for thursday and friday along with next wednesday is open
                            echo "<option value='FRIDAY'>Friday</option>";
                        } elseif ($today == 'Tuesday' && $time < 19) //if purchase day is tuesday and time is earlier than 7pm
                        {
                            echo "<option value='WEDNESDAY' selected> Wednesday</option>"; //all slots for following 3 days are open
                            echo "<option value='THURSDAY'>Thursday</option>";
                            echo "<option value='FRIDAY'>Friday</option>";
                        } else {
                            echo "<option value='WEDNESDAY' selected> Wednesday</option>"; //else, if purachase day if on any other day, upcoming wed, thursday and fri are slots are open
                            echo "<option value='THURSDAY'>Thursday</option>";
                            echo "<option value='FRIDAY'>Friday</option>";
                        }
                        ?>
                    </select>
                    <input type="submit" name="date" value="Next" class="submit-btn">
                </form>
            </div>
        </div>
    </div>
</body>
</html>