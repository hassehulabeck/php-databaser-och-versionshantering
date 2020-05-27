<?php

// Slå på all felrapportering. Bra under utveckling, dåligt i produktion.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'secret.php';

$dbh = new PDO('mysql:dbname=zoo;host=localhost', $user, $pw);


// Kolla om någon valt ett djur.
if (isset($_POST['submitAnimal'])) {
    // Prepared statement.
    $sql = "SELECT * FROM animals WHERE id = :id";

    $sth = $dbh->prepare($sql);
    $sth->execute([':id' => $_POST['animal']]);
    $result = $sth->fetchAll();
}



$allAnimals = [];
foreach ($dbh->query("SELECT id, name FROM animals") as $row) {
    $allAnimals[] =  $row;
}



?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animals-data</title>
</head>

<body>
    <form action="index.php" method="post">
        <select name="animal">
            <option>Välj ett djur</option>
            <?php
            foreach ($allAnimals as $animal) {
                $selected = "";
                if ($result[0]['name'] == $animal['name']) {
                    $selected = "selected";
                }
                echo "<option value='" . $animal['id'] . "' " . $selected . ">" . $animal['name'] . "</option>";
            }
            ?>
        </select>
        <input type="submit" name="submitAnimal" value="Visa djuret">
    </form>
    <section>
        <?php
        if (isset($result)) {
            foreach ($result as $row) {
                echo "<p>" . $row['name'];
            }
        }
        ?>
    </section>

    <form action="index.php" method ="post">
        
    </form>
</body>

</html>