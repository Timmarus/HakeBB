<?php
/* 
# @author Timmarus, DSPHat
# HakeBB Pre-Alpha
*/
?>
<?php
session_start();
include_once("config.php");
?>


<form method="POST" action="">
	<input type="text" name="username" placeholder="Username..." /><br />
	<input type="password" name="pass" placeholder="Password..." /><br />
	<input type="submit" name="submit" /><br />
</form>

<?php
if (isset($_POST['submit'])) {
	if (!isset($_POST['username']) || !isset($_POST['pass'])) {
		die("You have not filled out all the forms!");
	}
	else {
		$cf = new config();
		$con = mysqli_connect($cf->dbhost, $cf->dbuser, $cf->dbpass) or die("Could not connect to the MySQL server");
		mysqli_select_db($con, $cf->database) or die("Could not select database");
		$user = mysqli_real_escape_string($con, $_POST['username']);
		$pass = mysqli_real_escape_string($con, $_POST['pass']);
		$sql = "SELECT * FROM hakebb_members WHERE username='$user' and password='$pass'";
		$resc = mysqli_query($con, $sql);
		if (mysqli_num_rows($resc) == 1) {
			echo "You have been successfully logged in!";
			//We save sessions here.
		}
		else {
			echo "INVALID LOGIN!";
		}
	}
}
?>