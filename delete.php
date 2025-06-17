<?php 
    include "connect.php";
    $id = $_GET['id'];
    $deleted = false;

    if ($id != '') {
        $id = $conn->real_escape_string($id);
        $conn->query("DELETE FROM added_animals WHERE id=$id");
        $deleted = true;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
    <header>
        <nav class="admin_header">
            <a href="index.php"><img src="images_home/temp_logo.webp" alt="logo udruge"  id="header_logo"></a>
            <h2 id="saved_animals">Do sad spašeno: <span class="highlight">1325</span> životinja</h2>
            <ul class="nav_links">
                <li><a href="kategorija.php?vrsta=mačka">MAČKE</a></li>
                <li><a href="kategorija.php?vrsta=pas">PSI</a></li>
                <li><a href="kategorija.php?vrsta=zec">ZEČEVI</a></li>
                <li><a href="kategorija.php?vrsta=ptica">PTICE</a></li>
                <li><a href="kategorija.php?vrsta=drugo">DRUGO</a></li>
                <li><a href="unos.html">DODAJ ŽIVOTINJU</a></li>
                <li><a href="administrator.php">UREDI ŽIVOTINJE</a></li>

            </ul>
    </header>
</nav>


        <?php 
            if ($deleted) {
                echo "<div class='deleted_txt_ok'>";
                    echo "<h2>Uspješno izbrisano</h2>";
                echo "</div>";
            } else {
                echo "<div class='deleted_txt_nok'>";
                    echo "<h2>Nije izbrisano</h2>";
                echo "</div>";
            }
        ?>


</html>