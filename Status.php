<?php
/* Enter Server Details and database name */
$servername = "localhost";
$username = "root";
$password = '';
$dbname = "SmartMethods";

/* create connection to access to SQL database server */
$connection = new mysqli($servername, $username, $password, $dbname);

/*if there is error return the error with "connection failed */
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

/* get submit buttons value from interface */
$Status1 = $_POST["Forward"];
$Status2 = $_POST["Left"];
$Status3 = $_POST["Stop"];
$Status4 = $_POST["Right"];
$Status5 = $_POST["Backward"];

/* create array and enter all values for submit buttons*/
$Status = array($Status1, $Status2, $Status3, $Status4, $Status5);
$queryStatus;


for ($i = 0; $i < 5; $i++) {
  /* if Status value not null then queryStatus equal Status*/
    if ($Status[$i] != null) {
        $queryStatus = $Status[$i];
    }
}

/* Enter Query to update Actions to Forward/Left/Stop/Right/Backward */
$sqlUpdate = "UPDATE Directions SET Actions='$queryStatus' Where Number='1' ";

/* Enter Query to Show Actions in Directions table */
$sqlSelect = "SELECT Actions FROM Directions";

/* if query is true to sql server then don't do anything, if not print meassage */
if ($connection->query($sqlUpdate) && $connection->query($sqlSelect) == TRUE) {

} else {
echo "Error in Action: " . mysqli_error($connection);
}

$output=$connection->query($sqlSelect);

/* if output variable have more then one rows do this or print 'No Data found' */
if ($output->num_rows > 0) {
    $i=1;
    /* print data of each row */
    while($row = $output->fetch_assoc()) {
      echo "[<b>" .$row["Actions"]. "</b>]<br>";
      $i++;
    }
  } else {
    echo "No Data found";
  }



/* close connection  to SQL database server */
mysqli_close($connection);

?>