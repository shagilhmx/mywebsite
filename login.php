<?php
    include('connection/connect.php');
    $username = $_POST['user'];
    $password = $_POST['pass'];

        //to prevent from mysqli injection
        $username = stripcslashes($username);
        $password = stripcslashes($password);
        $username = mysqli_real_escape_string($db, $username);
        $password = mysqli_real_escape_string($db, $password);

        $sql = "select *from personal where p_id = '$username' and phone = '$password'";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);

        if($count == 1){
            echo "<h1><center> Login successful </center></h1>";
            $sql = "select p.p_id,p.c_id,p.fname,p.lname,p.phone,p.code,p.address,p.pickup,p.date,p.days,p.costperday,e.book_id,e.total, a.v_id,a.cimage,a.cname from personal as p inner join booking as e on p.p_id = e.book_id inner join admin as a on a.v_id = p.c_id where p.p_id='$username'";
            $result = mysqli_query($db, $sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            while($row){
            echo  "<p>". $row['p_id']."</p>";
            echo  "<p>". $row['c_id']."</p>";
            echo  "<p>". $row['fname']."</p>";
            echo  "<p>". $row['lname']."</p>";
            echo  "<p>". $row['phone']."</p>";
            echo  "<p>". $row['code']."</p>";
            echo  "<p>". $row['address']."</p>";
            echo  "<p>". $row['pickup']."</p>";
            echo  "<p>". $row['date']."</p>";
            echo  "<p>". $row['days']."</p>";
            echo  "<p>". $row['costperday']."</p>";
            echo  "<p>". $row['total']."</p>";
            echo  "<p>". $row['cname']."</p>";
            echo  "<img src=admin/images/". $row['cimage'].">";
            $count1 = $count1 - 1;
          }
        }
        else{
            echo "<h1> Login failed. Invalid username or password.</h1>";
        }
?>
