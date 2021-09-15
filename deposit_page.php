<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">
<HTML>
<HEAD>
  <TITLE> Deposit Result </TITLE>
  
</HEAD>

<BODY>
<h1>Result for:
<?php
  require ('/home/student/nguyenbc/.credentials.php');
  $cNu = $_POST['depNum'];
  $amt = $_POST['depAmt'];
  echo $cNu."-";
  echo $amt;

  if ($amt < 0) {
    echo "Incorrect amount.";
    exit();
  }

  $query = "SELECT * FROM nguyenbc_Accounts where accountNumber = '$cNu';";
  $temp = "UPDATE nguyenbc_Accounts SET accountBalance = accountBalance+'$amt' WHERE accountNumber = '$cNu';";

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
  if ($accountNum == "") {
	  echo "Account does not exist";
  } else{
	  $neuResult = $mysqli->query($temp);
    if ($neuResult === TRUE) {
      printf("Account %s add %s",$accountNum,$amt);
    }

  }
  
  $mysqli->close();

?>

</h1>

</BODY>
</HTML>

