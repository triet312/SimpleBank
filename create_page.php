<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">
<HTML>
<HEAD>
  <TITLE> Create Result </TITLE>
</HEAD>

<BODY>
<h1>Result for:
<?php
  require ('/home/student/nguyenbc/.credentials.php');
  $cNu = $_POST['creNumber'];

  echo $cNu."-";

  $query = "INSERT INTO nguyenbc_Accounts(accountNumber,accountBalance) VALUES ('$cNu',0);";

  $mysqli = new mysqli();
  $mysqli->connect("localhost",$MYSQL_USER,$MYSQL_PW,"nguyenbc");
  if ($mysqli->errno) {
        printf("Error connecting to database: %s <br />",$mysqli->error);
        exit();
  }

  $result = $mysqli->query($query,MYSQLI_STORE_RESULT);
  if ($result === TRUE) {
     echo "Create account successfully.";
  } else {
     echo "Account exists.";
  }
  $mysqli->close();

?>
</h1>
</BODY>
</HTML>





  


