<html>
<head>
<title>Display Page</title>
<!--
<link rel="stylesheet" type="text/css" href="CondolenceMessage.css"> -->
<script type="text/javascript" src="app.js">
</script>	
<style>
  .navbar-static-top + .jumbotron { margin-top: -20px; }
  .navbar img { max-height: 20px; }

  body > section {
    background-size: cover;
    background-position: center;
  }

  img.pull-right {
    margin: 0 0 1em 1em;
  }
  img.pull-left {
    margin: 0 1em 1em 0;
  }
  .avatar {
    max-width: 8em;
  }

  #message {
    padding: 30px 0;
    margin-top: -40px;
  }
  #message section::after {
    content: '';
    display: table;
    clear: both;
  }
#message section:nth-child(1) {
    text-align: left;
  }  
  p.test2
{
width:11em; 
border:1px solid #000000;
text-wrap:normal;
}
  </style>
</head>
<body bgcolor="#E9EAED" >

<?php
$conn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=root") 
      or die ("Nao consegui conectar ao PostGres --> " . pg_last_error($conn));
?>
<section id="message">
<div id="message"  align="center" style="display:block">

<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{
	if ((isset($_POST['inputEmail'])) && (isset($_POST['inputPassword'])))
	{
		$name=$_POST['inputEmail'];
		$pass=$_POST['inputPassword'];	
	
		$result = pg_query($conn, "SELECT pass FROM userdata1");
		
		#if (!$result) {
		#echo "Username doesn't exist.\n";
		  
		#}
		
		$row = pg_fetch_row($result);
		if ($row[0] != $pass)
		{
			echo "Password didn't match.\n";
		}
	} else {
		
		$name=$_POST['inputName1'];
		$email=$_POST['inputEmail1'];
		$phone=$_POST['inputphone1'];
		$address=$_POST['inputAddress1'];
		$pass=$_POST['inputPassword1'];
		$result1 = pg_query($conn, "INSERT INTO userdata1 (name,email,phone,address,pass) VALUES ('$name','$email','$phone','$address','$pass')");
		var_dump($result1);
	}

}


$name_arr=array ();
$email_arr=array ();
$phone_arr=array ();
$address_arr=array ();

$result = pg_query($conn, "SELECT name,email,phone,address FROM userdata1");
if (!$result) {
  echo "An error occurred.\n";
  exit;
}

while ($row = pg_fetch_row($result)) {
		
				array_push($name_arr, $row[0]);
				array_push($email_arr, $row[1]);
				array_push($phone_arr, $row[2]);
				array_push($address_arr, $row[3]);
}



foreach($name_arr as $name => $val)
{
?>
<section>
<p>
<font <font size="4.5">
<i>~ <?php echo $val ?> ~</i>
<?php echo $email_arr[$name] ?>
<?php echo $phone_arr[$name] ?>
<?php echo $address_arr[$name] ?></br>
</font>
</p>
</section>
<?php
}
?>

</div>
</section>
<form id="message" action="newpage.php" method="POST" >
<Table class="Tab">
<tr>
<td>search</td>
<td><input type="text" id="search" name="search" size="40"></input>
</td>
</tr>
<tr>
<td align="center" >
<INPUT TYPE="SUBMIT" VALUE="SUBMIT" class="button">
</td>
</tr>
</Table>
</form>
<?php

// close connection
	pg_close($connection);
?>
</body>
</html>