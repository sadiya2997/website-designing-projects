<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "BrawndoBros";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if (isset($_POST['reg_p'])) {
// receive all input values from the form
$pname = mysqli_real_escape_string($conn,$_POST['pname']);
$pspecies = mysqli_real_escape_string($conn,$_POST['pspecie']);
$pimage = mysqli_real_escape_string($conn,$_POST['pimage']);
$soil_details = mysqli_real_escape_string($conn,$_POST['Moisture_threshold']);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO Plants (plantNickName,plantSpecies,plantImage,soilMoistureThreshold,soilMoistureCurrent,soilMoistureAction,soilMoistureDosage,soilTempThreshold,soilTempCurrent,soilTempAction,soilTempAction,soilTempAction,soilTempDosage,plantLightThreshold,plantLightCurrent,plantLightAction,plantLightDosage)
VALUES ('$pname', '$pspecies', '$pimage','soil_details','Moisture_current','Moisture_action','Moisture_dosage','Temp_threshold','Temp_current','Temp_action','Temp_dosage','Light_threshold','Light_current','Light_action','Light_dosage')";
if ($conn->query($sql) === TRUE) {
echo "alert('New record created successfully')";
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}
}
$conn->close();
?>