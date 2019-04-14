<?php include('server.php') ?>



<html>
    <head>
        <title>Admin</title>
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


        </script>
        <?php

    session_start();


if (isset($_POST['approvebtn'])){

    $id =  $_SESSION['hotelID'];
    $sql =  "UPDATE hotel SET approved=1 WHERE id = '$id'";


    if ($con->query($sql) === TRUE) {
         header("Location:approve.php");
        echo "";
    } else {
        echo "Error updating record: " . $conn->error;
    }


}

if (isset($_POST['suspndbtn'])){

    $id =   $_SESSION['hotelidtosuspend'];

    $sql =  "UPDATE hotel SET suspended=1 WHERE id = '$id'";


    if ($con->query($sql) === TRUE) {
         header("Location:approve.php");
        echo "";
    } else {
        echo "Error updating record: " . $conn->error;
    }


}
if (isset($_POST['reactivatebtn'])){
    $id =  $_SESSION['hotelreactivateid'];

    $sql =  "UPDATE hotel SET suspended=0 WHERE id = '$id'";
    


    if ($con->query($sql) === TRUE) {
        header("Location:approve.php");
        echo "";
    } else {
        echo "Error updating record: " . $conn->error;
    }


}




        ?>

    </head>
    <body>


        <h2>Welcome Admin!</h2>

        <div class="tab">
            <button class="tablinks" onclick="openTab(event, 'Pending' )" action ="addRooms.php">Pending Hotels</button>
            <button class="tablinks" onclick="openTab(event, 'Active')">Active Hotels</button>
            <button class="tablinks" onclick="openTab(event, 'toSuspend')">Hotels to Suspend</button>
            <button class="tablinks" onclick="openTab(event, 'Suspended')">Suspended</button>
        </div>

        <div id="Pending" class="tabcontent">
            <h3>Pending</h3>


            <?php
            /*$id=$_GET['id'];*/
            $s = "SELECT *  FROM hotel WHERE approved='0'";
            $result=mysqli_query($con , $s);
            if($result = mysqli_query($con, $s)){
                if(mysqli_num_rows($result) > 0){
                    echo "<table>";
                    echo "<tr>";
                     echo "<th>Image</th>";
                    echo "<th>Hotel Name</th>";
                    echo "<th>Stars</th>";
                    echo "<th>Location</th>";
                   
                    echo "</tr>";
                    while($row = mysqli_fetch_array($result)){

                        $_SESSION['hotelID'] = $row['id'];

                        echo "<tr align ='center'><form action=approve.php method=post>";
                         echo "<td id = img-src>"; echo "<img src='images/".$row['image']."' >"; echo "</td>";
                        echo "<td>" . $row['name'] .  "</td>";
                        echo "<td>" . $row['Stars'] . "</td>";
                        echo "<td>" . $row['Location'] . "</td>";
                        
                        echo"<td><input type= submit class=btn name=approvebtn value= Approve '> ";
                        echo"</form></tr>";


                    }
                    echo "</table>";
                    // Close result set
                    mysqli_free_result($result);
                } else{
                    echo "No hotels to approve yet.";
                }
            } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
            }


            ?>
        </div>

        <div id="Active" class="tabcontent">
            <h3>Active Hotels</h3>
            <?php 
            $s = "SELECT *  FROM hotel WHERE approved='1' AND suspended ='0'";
            $result=mysqli_query($con , $s);
            if($result = mysqli_query($con, $s)){
                if(mysqli_num_rows($result) > 0){
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>Image</th>";
                    echo "<th>Hotel Name</th>";
                    echo "<th>Stars</th>";
                    echo "<th>Location</th>";
                    
                    echo "</tr>";

                    while($row = mysqli_fetch_array($result)){

                        $_SESSION['hotelid'] = $row['id'];
                        echo '<tr align ="center"><form action=approve.php onsubmit="return trigle_function($id)" method=post>';
                        echo "<td id = img-src>"; echo "<img src='images/".$row['image']."' >"; echo "</td>"; 
                        echo "<td>" . $row['name'] .  "</td>";
                        echo "<td>" . $row['Stars'] . "</td>";
                        echo "<td>" . $row['Location'] . "</td>";
                       
                        echo"</form></tr>";


                    }
                    echo "</table>";
                    // Close result set
                    mysqli_free_result($result);
                } else{
                    echo "No active hotels yet.";
                }
            } else{
                echo "ERROR! " ;
            }
            ?>
        </div>

        <div id="toSuspend" class="tabcontent">
            <h3>Hotels to Suspend</h3>

            <?php 

            $s = "SELECT *  FROM hotel WHERE amount_owed>0 AND suspended =0 ";
            //  $result=mysqli_query($con , $s);
            if($result = mysqli_query($con, $s)){
                if(mysqli_num_rows($result) > 0){
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>Image</th>";
                    echo "<th>Hotel Name</th>";
                    echo "<th>Stars</th>";
                    echo "<th>Location</th>";
                   
                    echo "</tr>";

                    while($row = mysqli_fetch_array($result)){

                        $_SESSION['hotelidtosuspend'] = $row['id'];

                        echo '<tr align ="center"><form action=approve.php onsubmit="return trigle_function($id)" method=post>';
                        echo "<td id = img-src>"; echo "<img src='images/".$row['image']."' >"; echo "</td>"; 
                        echo "<td>" . $row['name'] .  "</td>";
                        echo "<td>" . $row['Stars'] . "</td>";
                        echo "<td>" . $row['Location'] . "</td>";
                        
                        echo"<td><input type= submit name=suspndbtn class=btn value= Suspend> ";
                        echo"</form></tr>";


                    }
                    echo "</table>";
                    // Close result set
                    mysqli_free_result($result);
                } else{
                    echo "No hotels to suspend yet.";
                }
            } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
            }
            ?>
        </div>
        <div id="Suspended" class="tabcontent">
            <h3>Suspended Hotels</h3>


            <?php 


            $s = "SELECT *  FROM hotel WHERE suspended=1";
            $result=mysqli_query($con , $s);
            if($result = mysqli_query($con, $s)){
                if(mysqli_num_rows($result) > 0){
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>Hotel Name</th>";
                    echo "<th>Stars</th>";
                    echo "<th>Location</th>";
                    echo "<th>Image</th>";
                    echo "</tr>";
                    while($row = mysqli_fetch_array($result)){
                        $_SESSION['hotelreactivateid'] = $row['id'];
                        echo '<tr align ="center"><form action=approve.php onsubmit="return trigle_function($id)" method=post>';
                        echo "<td>" . $row['name'] .  "</td>";
                        echo "<td>" . $row['Stars'] . "</td>";
                        echo "<td>" . $row['Location'] . "</td>";
                        echo "<td id = img-src>"; echo "<img src='images/".$row['image']."' >"; echo "</td>"; 
                        echo"<td><input type= submit class=btn name=reactivatebtn value= Reactivate> ";
                        echo"</form></tr>";


                    }
                    echo "</table>";
                    // Close result set
                    mysqli_free_result($result);
                } else{
                    echo "No suspended hotels hotels yet.";
                }
            } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
            }
            ?>
        </div>




    </body>
</html> 

