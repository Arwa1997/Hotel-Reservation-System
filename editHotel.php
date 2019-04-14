<?php include('server.php') ?>
<?php
session_start();






if (isset($_POST['editbtn'])) {
    // receive all input values from the form
    // insert:
    $hotelName = mysqli_real_escape_string($con, $_POST['name']);
    $pass = md5(mysqli_real_escape_string($con, $_POST['pass']));
    $search =  "SELECT * FROM hotel WHERE name='$hotelName'AND password ='$pass'";
    $result = mysqli_query($con, $search);



    if (mysqli_num_rows($result) == 1) 
    {
        $_SESSION['hotelName'] = $hotelName;
        header("Location:addRooms.php");
        
        //    goto insert;
    }
    else{
        $message = "Wrong name and password combination.";
        echo "<script type='text/javascript'>alert('$message');</script>";
        
        header("Location:editHotel.php");
        

    }
}

?>

<html>
    <head>
        <title>Add Hotel</title>
        <link rel="stylesheet" type="text/css" href="addHotel.css">


        <script type="text/javascript">
            //console.log("hereeee");
            function Validate()
            {
                var hotelName = document.getElementById('hotelname').value;

                var pass = document.getElementById('pass').value;

                //var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

                if(!hotelName){

                    alert("Please enter your hotel's name.");
                    return false;
                }

                if(!pass){
                    alert("Please enter password");
                    return false;

                }
                return true;





            }</script>
    </head>
    <body>
        <div class="header">
            <h2>Edit Existing Hotel</h2>
        </div>

        <form class ="box" action = "editHotel.php" method ="post" onsubmit="return Validate()">

            <div class="input-group">
                <label>Hotel Name</label>
                <input type="text" name="name" id="hotelname">
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="pass" id="pass">
            </div>

            <br>
            <div >
                <input type="submit" class="btn" name="editbtn" value = "Edit Hotel">
            </div>
        </form>
    </body>
</html>

