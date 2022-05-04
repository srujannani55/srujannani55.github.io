<?php
$loginst = 0;
if ($_SESSION['name']){ 

$user_check = $_SESSION['name'];

$ses_sql = mysqli_query($con,"SELECT username FROM userlogin WHERE username='$user_check' ");

$row=mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

$login_user=$row['username'];

if(!empty($login_user)) 
{
   $loginst = 1;
}   
}

?>