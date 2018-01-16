<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        table, th, td {
            border: 1px solid black;
        }
        a {
    text-decoration: none;
    display: inline-block;
    padding: 8px 16px;
}

a: hover {
    background-color: #ddd;
    color: black;
}

.previous {
    background-color: #f1f1f1;
    color: black;
}

.next {
    background-color: #4CAF50;
    color: white;
}

.round {
    border-radius: 50%;
}
    </style>
</head>
<body>

<?php 
function connectDB() {
$servername = "localhost";
$username = "admin";
$password = "labaislaptas123";
$dbname = "radaras";


    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die('Nepavyko prisjungti: ' . $conn->connect_error);
    }
    
    return $conn;
}
$conn = connectDB();

function lentele($conn, $num_items, $offset) {
    // išvedame automobilius
    $sql = 'SELECT id, date, number, distance, time, distance/time*3.6 as speed FROM auto ORDER BY number, date DESC LIMIT ? OFFSET ?';
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $num_items, $offset);
    $stmt->execute();

    /* bind result variables */
    $stmt->bind_result($id, $date, $number, $distance, $time, $speed);

    ?>
    <table>
        <tr>
            <th>Nr.</th>
            <th>id</th>
            <th>Numeris</th>
            <th>Data</th>
            <th>Laikas (h)</th>
            <th>Atstumas (km)</th>
            <th>Greitis (km/h)</th>
        </tr>
    
    <?php
    $nr = 1 + $offset; ?>
    <?php  while($stmt->fetch()): ?> 
        <tr>
            <td><?= $nr++ ?></td>
            <td><?= $id ?></td>
            <td><?= $number ?></td>
            <td><?= $date ?></td>
            <td><?= $time ?></td>
            <td><?= $distance ?></td>
            <td><?= round($speed) ?></td>
        </tr>
    <?php endwhile; ?>
    </table>
    <?php
}

$num_items = 10;

if(isset($_GET['offset'])) {
    $offset = $_GET['offset'];
} else {
    $offset = 0;
}

lentele($conn, $num_items, $offset);

echo '<hr>';

$conn->close();

?>
        <?php if ($offset > 0): ?>
            <a href="Uzdavinys_15.php?offset=<?php echo $offset - $num_items; ?>" class="previous">&laquo; Ankstesnis</a>
        <?php endif; ?>
        <?php if ($offset + $num_items < 70): ?>
            <a href="Uzdavinys_15.php?offset=<?php echo $offset + $num_items; ?>" class="next">Sekantis &raquo;</a>
        <?php endif; ?>

</body>
</html>