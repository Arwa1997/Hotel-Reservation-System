<?php include('server.php') 

?>
<?php
    session_start();
?>
<html>
    <head>
        <title>Add Hotel</title>
        <link rel="stylesheet" type="text/css" href="addHotel.css">


        <script type="text/javascript">
            //console.log("hereeee");
            function Validate()
            {

            }</script>
    </head>
    <body>
        <div class="header">
            <h2>BookNow</h2>
        </div>

        <form class ="box" action = "guestBooking.php" method ="post" onsubmit="return Validate()" enctype="multipart/form-data">

            <div class="input-group">
                <label>Name</label>
                <input type="text" name="name" id="name"required>
            </div>
            <div class="input-group">
                <label>birthdate</label>
                <input type="date" name="birthdate" id="date" required>
            </div>
            <div class="input-group">
                <label>phone</label>
                <input type="text" name="phone" id="phone"required>
            </div>
            <div class="input-group">
                <label>adress</label>
                <input type="address" name="address" id="address"required>
            </div>

            <br>
            <div >
                <input type="submit" class="btn" name="bookbutton" value = "bookNow">
            </div>
        </form>
    </body>
</html>

<?php


//$hostname
//$password


$hotelid = $_SESSION['reserveHotelID'] ;
$roomtype = $_SESSION['reserveRoomTypeID'] ;
$startdate = $_SESSION['strtdate'] ;
$enddate = $_SESSION['enddate'] ;

if (isset($_POST['bookbutton'])) {
    // receive all input values from the form
    // insert:
    //get name of pic
    //$image = $_FILES["image"]["name"];

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $search =  "SELECT * FROM guest WHERE name='$name'";
    $result = mysqli_query($con, $search);
    $birthdate = mysqli_real_escape_string($con, $_POST['birthdate']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);



    if (mysqli_num_rows($result) > 0) 
    {
        $message = "You are  already book";
        echo "<script type='text/javascript'>alert('$message');</script>";
        //    goto insert;
    }
    else{

        $hotelid = $_SESSION['reserveHotelID'] ;
        $roomtype = $_SESSION['reserveRoomTypeID'] ;
        $startdate = $_SESSION['strtdate'] ;
        $enddate = $_SESSION['enddate'] ;

        echo $hotelid;
        echo $roomtype;
        echo $startdate;
        echo $enddate;

        $input="INSERT INTO guest (name,birthdate, address,phone) VALUES('$name','$birthdate','$address','$phone')"; 

        if(mysqli_query($con, $input) ) {
            $message = "Book has been successfully added";
            echo "<script type='text/javascript'>alert('$message');</script>";


            $output = mysqli_query($con, "SELECT * FROM guest WHERE name='$name'");
            $temp = mysqli_fetch_array($con,$output);
            $guestid = $temp['id'];

            $input2="INSERT INTO reservation (guestID,roomType,startDate,endDate,hotelID) VALUES ('$guestid','$roomtype','$startdate','$enddate','$hotelid')";


            if(mysqli_query($con, $input2) ) {
                $message = "Reservation has been successfully added";
                echo "<script type='text/javascript'>alert('$message');</script>";


            }


        }
    }
}



?>