<?php include('server.php') ?>
<html>
    <head>
        <title>Add Hotel</title>
        <link rel="stylesheet" type="text/css" href="addHotel.css">


        <script type="text/javascript">
            //console.log("hereeee");
            function Validate()
            {
                var hotelName = document.getElementById('hotelname').value;
                var addrs = document.getElementById('address').value;
                var stars = document.getElementById('starz').value;
                var pic = document.getElementById('image').value;
                var pass = document.getElementById('pass').value;
                var pass2 = document.getElementById('pass2').value;
                //var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

                if(!hotelName){

                    alert("Please enter your hotel's name.");
                    return false;
                }
                if(!addrs){

                    alert("Please enter your hotel's location.");
                    return false;

                }
                if(!stars){

                    alert("Please enter your hotel's rating.");
                    return false;

                }
                if(!pass){

                    alert("Please enter a password.");
                    return false;

                }
                if(!pic){

                    alert("Please insert an image for your hotel");
                    return false;

                }

                if(stars>5){
                    alert("Invalid rating entry");
                    return false;

                }
                if(pass!=pass2){
                    alert("Passwords must match.");
                    return false;

                }
                return true;





            }</script>
    </head>
    <body>
        <div class="header">
            <h2>Add Hotel</h2>
        </div>

        <form class ="box" action = "addHotel.php" method ="post" onsubmit="return Validate()" enctype="multipart/form-data">

            <div class="input-group">
                <label>Hotel Name</label>
                <input type="text" name="hotelName" id="hotelname">
            </div>
            <div class="input-group">
                <label>Hotel Address</label>
                <input type="text" name="addrs" id="address" >
            </div>
            <div class="input-group">
                <label>Stars</label>
                <input type="text" name="stars" id="starz">
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="pass" id="pass">
            </div>
            <div class="input-group">
                <label>Confirm Password</label>
                <input type="password" name="pass2" id="pass2">
            </div>
            <div class="image-group">
                <label>Please attach an image of the hotel</label>
                <input type="file" name="image" accept="image/*" id ="image">
                

            </div>
               <div >
                <label>Do you want to go premium?</label>
                <input type="hidden" id = "premium" value=0  name = "checkPremium" checked>
                <input type="checkbox" id="premium" value=1 name = "checkPremium">
                   <label for="premium">Yes</label>

            </div>
            <br>
            <div >
                <input type="submit" class="btn" name="add_btn" value = "Add Hotel">
            </div>
        </form>
    </body>
</html>

<?php


    //$hostname
    //$password



    if (isset($_POST['add_btn'])) {
        // receive all input values from the form
        // insert:
        //get name of pic
        $image = $_FILES["image"]["name"];

        $hotelName = mysqli_real_escape_string($con, $_POST['hotelName']);
        $search =  "SELECT * FROM hotel WHERE name='$hotelName'";
        $result = mysqli_query($con, $search);
        $addrs = mysqli_real_escape_string($con, $_POST['addrs']);
        $pass = md5(mysqli_real_escape_string($con, $_POST['pass']));
        $stars = mysqli_real_escape_string($con, $_POST['stars']);
        $premium = mysqli_real_escape_string($con, $_POST['checkPremium']);
        //put image destination folder
        $destination = "Images/".basename($_FILES["image"]["name"]);

        if (mysqli_num_rows($result) > 0) 
        {
            $message = "This hotel already exists";
            echo "<script type='text/javascript'>alert('$message');</script>";
            //    goto insert;
        }
        else{

            $input="INSERT INTO hotel (name,password, Location, Stars,image,premium) VALUES('$hotelName','$pass','$addrs','$stars','$image',$premium)";

            if(mysqli_query($con, $input)) {
                $message = "Your hotel has been successfully added";
                echo "<script type='text/javascript'>alert('$message');</script>";
                //put image in destination folder to be displayed later
                move_uploaded_file($_FILES['image']['tmp_name'], $destination);


            }
        }
    }



?>