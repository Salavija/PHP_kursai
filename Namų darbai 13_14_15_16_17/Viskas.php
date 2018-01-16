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
<h3> Naujas įrašas </h3>
<form action="insert.php" method='post'>
    <input name='date' type='datetime-local' placeholder="Date & Time">
    <input name='number' type='text' placeholder="Numeris">
    <input name='distance' type='number' placeholder="Atstumas">
    <input name='time' type='number' placeholder="Laikas">
    <input type='submit' value='Pateikti'>
</form>

<h3> Duomenys </h3>
<form action="search.php" method='GET'>
    <input name='filter' type='text' placeholder="Filtruoti">
    <input type='submit' value='Ieškoti'>
</form>
 <br>
     <form action="search.php" method="GET">
        <input type="text" name="query" />
        <input type="submit" value="Search" />
    </form>
<?php 

require_once 'db.php';
$conn = connectDB();

require_once 'lentele.php';

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
            <a href="band11.php?offset=<?php echo $offset - $num_items; ?>" class="previous">&laquo; Ankstesnis</a>
        <?php endif; ?>
        <?php if ($offset + $num_items < 70): ?>
            <a href="band11.php?offset=<?php echo $offset + $num_items; ?>" class="next">Sekantis &raquo;</a>
        <?php endif; ?>
</body>
</html>