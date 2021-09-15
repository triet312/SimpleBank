<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">
<HTML>
<HEAD>
  <TITLE> Withdraw Result </TITLE>
  
</HEAD>

<BODY>
<h1>Result for:
<?php
  require ('/home/student/nguyenbc/.credentials.php');
  $cNu = $_POST['witNum'];
  $amt = $_POST['witAmt'];
  echo $cNu."-";
  echo $amt;

  if ($amt < 0) {
    echo "Incorrect amount.";
    exit();
  }

  $query = "SELECT * FROM nguyenbc_Accounts where accountNumber = '$cNu';";
  $temp = "UPDATE nguyenbc_Accounts SET accountBalance = accountBalance -'$amt' WHERE accountNumber = '$cNu';";

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
  $hold = $row[1];
  if ($accountNum == "") {
	  echo "Account does not exist";
  } elseif ($hold < $amt) {
    echo "Insufficient balance";
  } else{
	  $neuResult = $mysqli->query($temp);
    if ($neuResult === TRUE) {
      printf("Account %s withdraw %s",$accountNum,$amt);
    }

  }
  
  $mysqli->close();

?>

</h1>

</BODY>
</HTML>

