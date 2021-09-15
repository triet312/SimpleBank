<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">
<HTML>
<HEAD>
  <TITLE> Retrieve Result </TITLE>
  
</HEAD>

<BODY>
<h1>Result for:
<?php
  require ('/home/student/nguyenbc/.credentials.php');
  $cNu = $_POST['retNum'];
  echo $cNu."-";

  $query = "SELECT * FROM nguyenbc_Accounts where accountNumber = '$cNu';";

  $mysqli = new mysqli();
  $mysqli->connect("localhost",$MYSQL_USER,$MYSQL_PW,"nguyenbc");
  if ($mysqli->errno) {
        printf("Error connecting to database: %s <br />",$mysqli->error);
        exit();
  }

  $result = $mysqli->query($query,MYSQLI_STORE_RESULT);
  if ($mysqli->errno) {
        printf("Error in query: %s <br />",$mysqli->error);
        exit();
  }

  $row = $result->fetch_row();
  $accountNum = $row[0];
  $bal = $row[1];
  if ($accountNum == "") {
	  echo "Account does not exist";
  } else{
	  printf("Account %s with balance: %s",$accountNum,$bal);
  }
  $mysqli->close();

?>

</h1>

</BODY>
</HTML>

