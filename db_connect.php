<?php

   $sname = "localhost";
   $uname = "root";
   $password = "root";

   $db_name = "students";


   $conn = mysqli_connect($sname, $uname,$password,$db_name);

   if(!$conn){
      echo "connection failed";
   }