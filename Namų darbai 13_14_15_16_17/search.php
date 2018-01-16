<?php
require_once 'db.php';
$conn = connectDB();

 if(isset($_POST['search'])) {
$searchq = $_POST['search'];

$query = mysql_query("SELECT * FROM auto WHERE number LIKE '%$searchq%'") or die("Could not search");
$count = mysql_num_rows($query);
if($count == 0){
    $output = 'There was no search results';
}else{
        $number = $row['number'];
        $output .= $number . " found";
    }
}
?>