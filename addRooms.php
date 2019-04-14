<?php include('server.php') ?>
<?php
    session_start();

?>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="editRooms.css">
        <script>
            function openTab(evt, tabName) {
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                document.getElementById(tabName).style.display = "block";
                evt.currentTarget.className += " active";
            }

            function displayName(){
                var NAME = document.getElementById('hotelName');
                document.getElementById('nameHere').innerHTML = NAME;


            }
            
            function roomValidate(){
                
                
                var rooms = document.getElementById('hotelname').value;
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



                
                
            }
        </script>
        <style>

        </style>
    </head>
    <body>
        <?php 
        $name = $_SESSION['hotelName'];
        //to get hotel detais
        $query =  "SELECT * FROM hotel WHERE name='$name'";
        $temp=mysqli_fetch_assoc(mysqli_query($con,$query));
        $approved =  $temp["Approved"];
        $id = $temp["id"];
        
       
      
         //to select rooms added to hotel
        
        $roomquery =  "SELECT * FROM roomss WHERE hotelID='$id'";
        $hotelRooms =  mysqli_query($con, $roomquery);

        ?>

        <h2>Welcome to <?php echo $name; ?></h2>
        <p>Click on the buttons inside the tabbed menu:</p>

        <div class="tab">
            <button class="tablinks" onclick="openTab(event, 'Details' )" action ="addRooms.php">Details</button>
            <button class="tablinks" onclick="openTab(event, 'Edit')">Edit Rooms</button>
            <button class="tablinks" onclick="openTab(event, 'Reservation')">Reservations</button>
        </div>

        <div id="Details" class="tabcontent">
            <h3>Details</h3>
            <p><b>Name: </b><?php  echo "$name"; ?></p>
            <p><b>Location: </b><?php echo $temp["Location"];?> </p>
            <p><b>Stars: </b><?php echo $temp["Stars"] ?> </p>
            <p><b>Image: </b><?php  echo "<div id='img_div'>"; echo "<img src='images/".$temp['image']."' >"; echo "</div>"; ?> </p>
            <p><b>Approval: </b><?php if($approved == 1) echo "Your hotel is approved." ; else echo"Your hotel has not yet been approved.";?> </p>

        </div>

        <div id="Edit" class="tabcontent">
            <h3>Edit Rooms</h3>
            <p><b>Rooms: </b></p>
            
          <?php
                if(mysqli_num_rows($hotelRooms)==0){

                    echo"<div> No room info added yet. </div> ";

                }


                else
                {
                    //display rooms already added in hotel
                    //if(mysqli_num_rows($hotelRooms) > 0){
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>Image</th>";
                    echo "<th> # Of Rooms</th>";
                    echo "<th>Room Type</th>";
                    echo "<th>Room Facilities</th>";
                    echo "</tr>";

                    while($row = mysqli_fetch_array($hotelRooms)){
                        //get room type name from its ID 

                        $type_name_query =  "SELECT TypeName FROM roomtype t1 INNER JOIN roomss t2 ON t1.TypeID = t2.roomType WHERE t1.TypeID=".$row['roomType'].";";

                        $type_name = mysqli_fetch_array(mysqli_query($con, $type_name_query));
                        echo"<tr>";
                        echo "<td><div id='img_div'>"; echo "<img src='Images/".$row['roomImage']."' >"; echo "</div></td>"; 
                        echo "<td>" . $row['noOfRooms'] .  "</td>";
                        echo "<td>" . $type_name['TypeName'] .  "</td>";
                        echo "<td>" . $row['facilitieis'] .  "</td>";
                        echo"</tr>";
                      

                    }
                    echo "</table>";
                    // Close result set
                }
            
          ?>
            <br><br>
            <form action = "addRooms.php" method = "post"   enctype="multipart/form-data">
                <input type="number" name="rooms" id="roomNo" placeholder = 'Enter number of rooms'>
                <input type="file" name="imagee" accept="image/*" id="imagee" >
               <?php

                $s =  "SELECT * FROM roomtype";
                $roomtypes = mysqli_query($con, $s);
              
                echo "<select name=roomChoice class = in>";
                echo "<option value= disabled disabled selected>Select Type</option>";
                while($row = mysqli_fetch_array($roomtypes)){
                    echo  "<option class = in  value=".$row['TypeID']. ">".$row['TypeName']."</option>";

                }
                echo "</select>";
                ?>
                <input type="text" name ="facilities" placeholder="Enter facilities">

                <input type = "submit" class="btn" name = "addRoomsbtn" value="Add/Edit Rooms">
            </form>
           

        </div>

        <div id="Reservation" class="tabcontent">
            <h3>Reservations</h3>
            <p>Show reservations and checkins here.</p>
        </div>



    </body>
</html> 
<?php

        if (isset($_POST['addRoomsbtn'])) {
                  
                  $image = $_FILES["imagee"]["name"];
                  
                  $facilities =mysqli_real_escape_string($con, $_POST['facilities']); 

                    $no_of_rooms = mysqli_real_escape_string($con, $_POST['rooms']);      
                    if (isset($_POST['roomChoice'])){
                        $room_type_id =  mysqli_real_escape_string($con, $_POST['roomChoice']);
                       
                    }
                    $destination = "Images/".basename($_FILES["imagee"]["name"]);
                    $remove = "DELETE FROM roomss WHERE roomType = $room_type_id AND  hotelID =$id" ;
                    mysqli_query($con, $remove);
                    
                    $input="INSERT INTO roomss (roomType,noOfRooms,hotelID,roomImage,facilitieis) VALUES('$room_type_id','$no_of_rooms','$id','$image','$facilities')";
                  
                    if(mysqli_query($con, $input)) {
                        $message = "Room has been successfully added/updated";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                        
                        move_uploaded_file($_FILES["imagee"]["tmp_name"], $destination);
                       
                           
                 
                       }
                     

                    else{
                        echo "failed to add rooms";

                    }
                   

                }
        

?>
