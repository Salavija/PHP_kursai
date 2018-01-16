<?php 

    require_once 'db.php';
    $conn = connectDB();

    $row = [];
    if (isset($_GET['edit'])) {
        $sql = "SELECT * FROM auto WHERE id = ?" . intval($_GET['edit']);
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();   
        }
    }

    if (isset($_POST['save'])) {
        if (intval($_POST['id']) > 0) {
            echo "update";
        } else {
            echo "insert";
        }
    }
     $sql = $conn->prepare("UPDATE auto SET date = ?, number = ?, distance = ?, time = ? WHERE id = ?");
      $sql->bind_param("ssddi", $_REQUEST['date'], $_REQUEST['number'], $_REQUEST['distance'], $_REQUEST['time'], $_REQUEST['id']);
      $sql->execute()
?>