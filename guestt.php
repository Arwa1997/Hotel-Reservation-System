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
        <style>

        </style>
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

            <form id=search-form action="guest.php" method="post">
 

                <label class="lbl">Start Date:</label>
                <input type ="date" class = "in" id = "start-date"  placeholder="Choose start date">
                <label class="lbl">End Date:</label>
                <input type = "date" class = "in" id = "end-date" placeholder="Choose end date">
				<br>
				<div class="form-group">
	    <label> Stars </label>
		<input type ="text" name="Stars" placeholder="qstars" class="form-control" >
		<br>
		</div>
		<div class="form-group">
	    <label> Location </label>
		<input type ="text" name="Location"placeholder="qlocation" class="form-control" >
		<br>
		</div>
		<div class="form-group">
	    <label> roomType </label>
		<input type ="text" name="roomType"placeholder="qroomType" class="form-control" >
		<br>
		</div>
		<div class="form-group">
	    <label> price </label>
		<input type ="text" name="price"placeholder="qprice" class="form-control" >
		<br>
		</div>
     <input type = "submit" class = "btn" value="Search">
            </form>
        </div>

        <h1>Hello There!!</h1> 
    </body>
</html>
<?php include('server.php') ?>
<?php
 session_start();
 global$con;
$qstars = isset($_POST['Stars']);
$qprice = isset($_POST['price']);
$qroomType =isset( $_POST['roomType']);
$qlocation = isset($_POST['Location']);
$sql="SELECT roomss.hotelID, roomss.roomType,roomss.price,hotel.Stars,hotel.Location,hotel.approved
 FROM roomss
 INNER JOIN hotel ON roomss.hotelID = hotel.id";
$where = array();
if ($qroomType !== '') $where[] = 'roomType LIKE "%'.$qroomType .'%"';
if ($qprice !== '')  $where[] = 'price LIKE "%'.$qprice.'%"';
if ($qstars !== '') $where[] = 'Stars LIKE "%'.$qstars.'%"';
if ($qlocation !== '') $where[] = 'Location LIKE "%'.$qlocation.'%"';
if (count($where) > 0) {
 $sql .= ' WHERE '.implode(' AND ', $where);
  /*$sql .= 'ORDER BY premium DESC';*/
  
} else {
  echo "specify your search";
  exit();
}
$result = $con->query($sql) or die($con->error);;
while($row = $result->fetch_assoc()) {

            if($row["approved"]=='1'){
              continue;
      }
    
            echo '<tr align ="center">';
			echo "<td>" . $row['id'] .  "</td>";
            echo "<td>" . $row['name'] .  "</td>";
            echo "<td>" . $row['Stars'] . "</td>";
            echo "<td>" . $row['Location'] . "</td>";
            echo "<td id = img-src>"; echo "<img src='images/".$row['image']."' >"; echo "</td>"; 
            echo"</form></tr>";
}
       echo "</table>";

?>