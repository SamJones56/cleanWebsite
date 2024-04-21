<?php
//Report Errors MAC
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../src/DBconnect.php';
require_once '../src/functions/userSignInFunctions.php';
require_once '../src/functions/profileDisplayAndUpdateFunctions.php'

//TEST 1: CRUD VALIDATION - LOGIN

//STEP 1: Test Login Creation (CREATE)
//createLogin($connection); //Comment out for userLogIn();

//STEP 2: Test Login Function (READ & USE)
//userLogIn($connection); //Comment out for CREATE & DELETE

//STEP 3: Test Delete (DELETE)
//deleteLogin($connection);//Comment out for userLogIn();

?>

<title>Sign in</title>
        <form action="" method="post" name="Login_Form" class="form-signin">
            <h2 class="form-signin-heading">Sign In Test: Credentials to validate below</h2>
            <label for="inputEmail" >Email</label>
            <input name="Email" type="email" id="email" class="form-control" placeholder="Email" required autofocus>
            <label for="inputPassword">Password</label>
            <input name="Password" type="password" id="Password" class="form-control" placeholder="Password" required>
            <button name="Submit" value="Login" class="button" type="submit">Sign in</button>

        </form>

    <?php echo "Login Credentials to Validate: <br>";
        echo "email: test@test.com <br> ";
        echo "password: PASSWORD <br>";

//TEST 2: CRUD VALIDATION - DISPLAY DATA
    //STEP 1: Use the profile to validate the Data (CREATE)


    //STEP 2: Test Login Function (READ & USE)


    //STEP 3: Test Delete (DELETE)






function roomAndRestaurantDateValidationTest($connection)
{
//    require_once '../src/DBconnect.php';
    function dateTester($connection)
    {

        require_once "../src/functions/newRoomReservation.php";
        require_once "../src/functions/newRestaurantReservationsFunctions.php";
        session_start();
        $_SESSION['permissionlvl'] = 0;
        $_SESSION['temp_room_type'] = 'suite';
        $_SESSION['temp_cap'] = 4;

        // Good room date
        $goodRoomArray = array(
            'employee_id' => '01',
            'customer_id' => '01',
            'date' => '2024-07-01 00:00:00.00',
            'check_in' => '2024-10-01 00:00:00.00',
            'check_out' => '2024-11-02 00:00:00.00',
            'payment' => 'card',
            'num_guests' => '01'
        );
        // Room form
        $roomFormArray = array(
            "employee_id", "customer_id", "date", "check_in", "check_out", "payment", "num_guests"
        );
        // Good table date
        $goodTableArray = array(
            'employee_id' => '01',
            'customer_id' => '01',
            'date' => '2024-07-01 00:00:00.00',
            'time' => '12:00',
            'num_guests' => '01'
        );
        // Table form
        $tableFormArray = array(
            "employee_id", "customer_id", "date", "time", "num_guests"
        );
        // Build good room date
        dateFormBuilder("Good Room Date", $roomFormArray, $goodRoomArray, 1, $connection);
        // Build conflicting room date
        dateFormBuilder("Bad Room Date", $roomFormArray, $goodRoomArray, 2, $connection);
        // Build good table date
        dateFormBuilder("Good Table Date", $tableFormArray, $goodTableArray, 3, $connection);
        // Build conflicting table date
        dateFormBuilder("Bad Table Date", $tableFormArray, $goodTableArray, 4, $connection);
    }

    function dateFormBuilder($testTitle, $formArray, $formDataArray, $formId, $connection)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['submit'. $formId])){
                if((int)$formId == 1)
                {
                    tempRoomReservation($connection, 0);
                }
                if((int)$formId == 2)
                {
                    tempRoomReservation($connection, 0);
                }
                if ((int)$formId == 3)
                {
                    tempTableReservation($connection, 0);
                }
                if ((int)$formId == 4)
                {
                    tempTableReservation($connection, 0);
                }
            }
        }

        echo '<form method="post" action="" id="form' . $formId . '" name="form' . $formId . '">';
        $combinedArray = array_combine($formArray, $formDataArray);
        echo '<h1> ' . $testTitle . ' </h1> ';
        foreach ($combinedArray as $key => $value)
        {
            if($key != "payment") {
                echo '<label for="' . $key . '">' . $key . '</label> <br>';
                if ($key == "employee_id" || $key == "customer_id") {
                    echo '<input type="text" name="';
                }
                else if ($key == "date" || $key == "check_in" || $key == "check_out") {
                    echo '<input type="date" name="';
                }
                else if ($key == "time")
                {
                    echo '<input type="time" name="';
                }
                else if ($key == "num_guests"){
                    echo '<input type="number" name="';
                }
                echo $key . '" id="' . $key . '" value=' . $value . '> <br>';
            }
            if ($key == "payment")
            {
                echo '<p1> payment </p1> <br> <select name="payment" id="payment" required>
                <option value="card">Card</option>
                <option value="cash">Cash</option>
            </select> <br> ';
            }
        }
        echo '<input type="submit" name="submit' . $formId .'" value="Submit" form="form' . $formId . '">';
        echo '</form>';
    }
    dateTester($connection);
}

    roomAndRestaurantDateValidationTest($connection);
?>

