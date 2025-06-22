<?php 
    session_start();
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
        <a href="index.php">
            <img src="images_home/temp_logo.webp" alt="logo udruge" id="header_logo">
        </a>
            <ul class="nav_links_center">
                <li><a href="kategorija.php?vrsta=mačka">MAČKE</a></li>
                <li><a href="kategorija.php?vrsta=pas">PSI</a></li>
                <li><a href="kategorija.php?vrsta=zec">ZEČEVI</a></li>
                <li><a href="kategorija.php?vrsta=ptica">PTICE</a></li>
                <li class="test"><a href="kategorija.php?vrsta=drugo">OSTALI</a></li>
            </ul>
            <ul class="nav_links">
                <?php if (isset($_SESSION['username']) && $_SESSION['razina'] == 1): ?>
                    <li><a href="unos.php">DODAJ ŽIVOTINJU</a></li>
                    <li><a href="administrator.php">UREDI ŽIVOTINJE</a></li>
                <?php elseif (isset($_SESSION['username']) && $_SESSION['razina'] == 0): ?>
                    <li><a href="unos.php">DODAJ ŽIVOTINJU</a></li>
                <?php endif; ?>

                <?php if (!isset($_SESSION['username'])): ?>
                    <li><a href="registracija.php">REGISTRACIJA</a></li>
                    <li><a href="prijava.php">PRIJAVA</a></li>
                <?php else: ?>
                    <li><a href="logout.php">ODJAVA (<?= htmlspecialchars($_SESSION['username']) ?>)</a></li>
                <?php endif; ?>
            </ul>
    </nav>
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


    <footer>
        <div>
        <strong><p>&copySpasi.me</p></strong>
        </div>
        <div>
            <strong>
            <p>Luka Gustetić</p>
            <p>luka.gustetic@gmail.com</p>
            <p>2025</p>
            </strong>
        </div>
    </footer>

</html>