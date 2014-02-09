<?php
include("database.php");
$id = $_GET["id"];

if ($_GET["t"] == "d") {
	setdata("DELETE FROM owners WHERE owner_id = $id");
	header("Location:index.php");
	exit;
}

if ($_GET["t"] == "e") {
	$result = getdata("SELECT * FROM owners WHERE owner_id = $id");
	if ($result) {
		while ($row = mysql_fetch_array($result)) {
			$firstname = $row["firstname"];
			$lastname = $row["lastname"];
			$phone = $row["phone"];
			$firstname2 = $row["firstname2"];
			$lastname2 = $row["lastname2"];
			$phone2 = $row["phone2"];	
		}	
	}
}
?>
<html>
<head>
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<script>
	function sf(){document.getElementById('firstname').focus();}
	window.onload=sf;
	</script>
	<style>
	.label {
		width:120px;
	}	
	</style>
</head>

<body>
<h2>Insert Owner</h2>
<div>Use this form to add an Owner</div>

<form action="index.php" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<div class="label">Name: </div><input type="text" name="firstname" id="firstname" size="8" value="<?php echo $firstname; ?>"> <input type="text" name="lastname" size="12" value="<?php echo $lastname; ?>"><br>
<div class="label">Phone: </div><input type="text" name="phone" value="<?php echo $phone; ?>"><br>
<div class="label">Name 2: </div><input type="text" name="firstname2" size="8" value="<?php echo $firstname2; ?>"> <input type="text" name="lastname2" size="12" value="<?php echo $lastname2; ?>"><br>
<div class="label">Phone2: </div><input type="text" name="phone2" value="<?php echo $phone2; ?>"><br>
<input type="submit">
</form>

<?php
$owner_id = $_POST["id"];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$phone = preg_replace("/[^0-9]/","",$_POST["phone"]);
$firstname2 = $_POST["firstname2"];
$lastname2 = $_POST["lastname2"];
$phone2 = preg_replace("/[^0-9]/","",$_POST["phone2"]);
if ($firstname && $lastname && $phone) {
	if ($owner_id) {
		setdata("UPDATE owners SET firstname='$firstname', lastname='$lastname', phone='$phone', firstname2='$firstname2', lastname2='$lastname2', phone2='$phone2' WHERE owner_id = $owner_id");
	} else {
		setdata("INSERT INTO owners (firstname,lastname,phone,firstname2,lastname2,phone2) VALUES ('$firstname','$lastname','$phone','$firstname2','$lastname2','$phone2')");
	}
}
?>
<h2>Owners</h2>
<?php
$result = getdata("SELECT * FROM owners");
if ($result) {
	while ($row = mysql_fetch_array($result)) {
		echo "Name: ",$row["firstname"]," ",$row["lastname"],"<br>";
		echo "Phone: ",$row["phone"],"<br>";
		echo "Name2: ",$row["firstname2"]," ",$row["lastname2"],"<br>";
		echo "Phone2: ",$row["phone2"],"<br>";
		echo "<a href=\"index.php?t=e&id=",$row["owner_id"],"\">Edit</a> <a href=\"index.php?t=d&id=",$row["owner_id"],"\">Delete</a>";
		echo "<hr>";
	}
}


?>
</body>