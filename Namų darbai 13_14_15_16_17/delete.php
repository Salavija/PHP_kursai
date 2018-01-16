
<?php
require_once 'db.php';
$conn = connectDB();
$id = $_GET["id"];
$sql = "DELETE FROM auto WHERE id = ?"; 
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
echo "<h2>Duomenys ištrinti</h2>";
?>