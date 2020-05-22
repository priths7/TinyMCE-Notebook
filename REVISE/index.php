<?php
include_once 'config/Database.php';
include_once 'class/Code.php';
$database = new Database();
$db = $database->getConnection();
$code = new Code($db);
?>



<title>Take Notes</title> 
<script src="https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js"></script>
<div class="container">	
	<div class="row">
	<h2>Previous Sections</h2>
	<?php
$i=0;
$result = $code->getPost();
while($db_row = mysqli_fetch_array($result)) {
?>
<input type="radio" ><?php echo $db_row["section_UUID"],$db_row["created"]; ?><br>
<?php
$i++;
}
?>
<?php
    if(array_key_exists('NewSection', $_POST)) { 
		new_section(); 
	} 
	function new_section()
	{
		$conn = new mysqli("localhost", "root", "", "mydb");
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		  } 
		$sql="INSERT INTO sections (created) VALUES (NOW());";
		$sql .="INSERT INTO `pages` ('section_UUID') VALUES(SELECT `section_UUID` FROM `sections` WHERE time_stamp=NOW())";
		if ($conn->multi_query($sql) === TRUE) {
			echo "New record created successfully";
		  } else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		  }
		  
		  $conn->close();

		  header('Location: '.$uri.'/TextEditor/');
		}

?>
<form method="post">
<input type="submit" class="button" name="NewSection" value="NewSection" />
</form>

	