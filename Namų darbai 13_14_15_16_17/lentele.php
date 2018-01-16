<?php

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
            <td><a href="delete.php?id=<?php echo $id;  ?>">trinti</a></td>
            <td><a href="edit.php?id=<?php echo $id;  ?>">taisyti</a></td>
        </tr>
    <?php endwhile; ?>
    </table>
    <?php
}
?>