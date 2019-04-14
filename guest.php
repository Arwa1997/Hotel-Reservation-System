<?php include('server.php') ?>
<?php session_start();?>
<html>
    <head>
        <title>Browse Hotels</title>
        <link rel ="stylesheet" type ="text/css" href = "guest.css">
        <link href="https://fonts.googleapis.com/css?family=Arizonia" rel="stylesheet">
        <link rel="shortcut icon" href="icon.ico" type="image/x-icon" />



    </head>

    <body>

        <div id= "introduction"><h1>
            <b>
                Enjoy An Experience Of A Lifetime </b>
            </h1></div>

        <div id = "user-search">

            <form id=search-form action ="guest.php" method = post>


                <label class="lbl">Start Date:</label>
                <input type ="date" class = "in" id = "start-date" name="startdate" placeholder="Choose start date">
                <label class="lbl">End Date:</label>
                <input type = "date" class = "in" id = "end-date" name = "enddate" placeholder="Choose end date">
                <input type = "search" name ="searchval" class = "in" placeholder="Search" id="search">
                <select name="searchBy" class = "in">
                    <option value="disabled" disabled selected>Search by</option>
                    <option class = "in" value="stars" >Stars</option>
                    <option class = "in"  value="price" >Price</option>
                    <option class = "in"  value="location" >Location</option>
                    <option class = "in"  value="room-type" >Room type</option>
                    <option class = "in"  value="rating" >Customer Ratings</option>
                </select>

                <input type = "submit" class = "btn" name ="search-btn" value="Search">
            </form>


        </div>


        <?php 


    if(isset($_POST['search-btn'])){


        if (isset($_POST['searchBy'])){
            $search_type =  mysqli_real_escape_string($con, $_POST['searchBy']);

        }
        $search_value = mysqli_real_escape_string($con, $_POST['searchval']);
        $startdate = mysqli_real_escape_string($con, $_POST['startdate']);
        $enddate = mysqli_real_escape_string($con, $_POST['enddate']);


        if($search_type == "stars"){
            $query =  "SELECT *  FROM hotel x1 INNER JOIN roomss x2 ON x1.id = x2.hotelID WHERE approved=1 AND Stars=$search_value ORDER BY premium DESC";



        }
        else if($search_type == "price"){
            $query = "SELECT *  FROM hotel x1 INNER JOIN roomss x2 ON x1.id = x2.hotelID WHERE approved=1 AND price<='$search_value' ORDER BY premium DESC";
          

        }
        else if($search_type == "location"){
            $query = "SELECT *  FROM hotel x1 INNER JOIN roomss x2 ON x1.id = x2.hotelID WHERE approved=1 AND Location='$search_value' ORDER BY premium DESC";
        

        }
        else if($search_type == "room-type"){
            
            $type_id =  mysqli_query($con, "SELECT * FROM roomtype WHERE TypeName='$search_value' ");
            $temp = mysqli_fetch_array($type_id);

            $roomid =  $temp['TypeID'];
            $query =  "SELECT *  FROM hotel x1 INNER JOIN roomss x2 ON x1.id = x2.hotelID WHERE approved='1' AND roomType= $roomid ORDER BY premium DESC";
          
        }
        else if($search_type == "rating"){
            $query = "SELECT *  FROM hotel x1 INNER JOIN roomss x2 ON x1.id = x2.hotelID WHERE approved=1 AND rating='$search_value' ORDER BY premium DESC";
            
        }



        if($result = mysqli_query($con, $query)){
            if(mysqli_num_rows($result) > 0){
                echo "<table  align ='center'>";
                echo "<tr>";

                echo "</tr>";
                 echo "<td><b>Hotel Name</b></td>";
                echo "<td><b>Stars</b></td>";
                echo "<td><b>Location</b></td>";
                echo "<td><b>Room Type</b></td>";
                echo "<td><b>Ratings</b></td>";
                echo "<td><b>Price</b></td>";
                echo "<td><b>Facilities</b></td>";
                echo "<td><b>Image</b></td>";
                 

                while($row = mysqli_fetch_array($result)){

                    //   $_SESSION['hotelid'] = $row['id'];
                    echo '<tr align ="center"><form action = guestBooking.php method = post>';
                    
                    $_SESSION['reserveHotelID'] = $row['id'];
                    //var_dump($_SESSION);
                    $_SESSION['reserveRoomTypeID'] = $row['roomType'];
                    $_SESSION['strtdate'] = $startdate;
                    $_SESSION['enddate'] = $enddate;
                    
                    $type_id =  mysqli_query($con, "SELECT TypeName FROM roomtype WHERE TypeID=".$row['roomType']);
                    $roomtype = mysqli_fetch_array($type_id);
                    
                    echo "<td>" . $row['name'] .  "</td>";
                    echo "<td>" . $row['Stars'] . "</td>";
                    echo "<td>" . $row['Location'] . "</td>";
                    echo "<td>" . $roomtype['TypeName']. "</td>";
                     echo "<td>" . $row['rating'] . "</td>";
                     echo "<td>" . $row['price'] . "</td>";
                     echo "<td>" . $row['facilitieis'] . "</td>";
                    echo "<td id = img-src>"; echo "<img src='images/".$row['roomImage']."' >"; echo "</td>"; 
                    echo"<td><input type= submit name=bookbtn class = btn value= 'Book Now' > ";
                    echo"</form></tr>";


                }
                echo "</table>";
                // Close result set
                mysqli_free_result($result);
            } else{
                echo "No results matched your search.";
            }
        } else{
            echo "ERROR: Search value doesn't match search type";
        }



    }

        ?>








    </body>





</html>