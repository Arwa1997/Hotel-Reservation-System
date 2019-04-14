<?php include('server.php') ?>
<?php

    session_start();
if (isset($_POST['login'])) {
    // receive all input values from the form
    // insert:
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);


    $s = "SELECT *  FROM admin WHERE username='$username'AND password ='$password'";
    $result = mysqli_query($con , $s);

    if( mysqli_num_rows($result) ==1)

    {
        $_SESSION['admin'] = $username;


        header("Location:approve.php");

        //    goto insert;
    }
    else{
        $message = "Wrong username and password combination.";
        echo "<script type='text/javascript'>alert('$message');</script>";



    }
}
//$username = isset($_SESSION['username']) ? $_SESSION['username'] : NULL;




?>
<html>
    <head>
        <title>Broker Signin</title>
        <link rel ="stylesheet" type ="text/css" href = "guest.css">
        <link href="https://fonts.googleapis.com/css?family=Arizonia" rel="stylesheet">
        <link rel="shortcut icon" href="icon.ico" type="image/x-icon" />

        <script type="text/javascript">
            //console.log("hereeee");
            function Validate()
            {
                var username = document.getElementById('adminuser').value;

                var pass = document.getElementById('adminpass').value;


                if(!username){

                    alert("Please enter username.");
                    return false;
                }

                if(!pass){
                    alert("Please enter password");
                    return false;

                }
                return true;

            }
        </script>
    </head>
    <body>

        <div class ="row">
            <div class ="column-md-6"login-right>
                <h2> Sign in </h2>
                <br>

                <form  action="broker.php" method="post" onsubmit="return Validate()">
                    <div class="form-group">

                        <label> username </label>
                        <input type ="text" name="username" id = "adminuser" class="form-control" >
                        <br>

                        <label> password </label>
                        <input type="password" name="password" id = "adminpass" class="form-control">
                        <br>
                    </div>
                    <button type= "submit" class ="btn" name ="login"> Sign in </button>
                    <br>

                </form>
            </div>
        </div>

    </body>
</html>






