<?php
    include 'connect.php';
    $category = $_GET['vrsta'] ?? '';

  
    $query = "SELECT * FROM added_animals";

    if (!empty($category)) {
        $category = $conn->real_escape_string($category);
        $query .= " WHERE vrsta = '$category'";   
    }
    $result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>


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
                <li><a href="registracija.html">REGISTRACIJA</a></li>
                <li><a href="prijava.html">PRIJAVA</a></li>
            </ul>
        </nav>
    </header>
    



    <div class="animal_card_box">
        <h3 id="animal_cards_naslov">Životinje za udomljavanje</h3>
        <form method="GET">
            <div class="custom_select">
                <select name="vrsta" id="vrsta" onchange="this.form.submit()">
                    <option value="">Odaberi kategoriju životinje</option>
                    <option value="mačka" <?= (($_GET['vrsta'] ?? '') == 'mačka') ? 'selected' : '' ?>>Mačka</option>
                    <option value="pas" <?= (($_GET['vrsta'] ?? '') == 'pas') ? 'selected' : '' ?>>Pas</option>
                    <option value="zec" <?= (($_GET['vrsta'] ?? '') == 'zec') ? 'selected' : '' ?>>Zec</option>
                    <option value="ptica" <?= (($_GET['vrsta'] ?? '') == 'ptica') ? 'selected' : '' ?>>Ptica</option>
                    <option value="drugo" <?= (($_GET['vrsta'] ?? '') == 'drugo') ? 'selected' : '' ?>>Drugo</option>
                </select>
            </div>
        </form>

        <section class="animal_cards">
            <?php if ($result->num_rows == 0 && $category != ''): ?>
                <h2>Nema životinja za ovu kategoriju</h2>
            <?php else: ?>
                <?php while ($row = mysqli_fetch_array($result)): 
                    $slika = htmlspecialchars($row['slika']);
                    $vrsta = htmlspecialchars($row['vrsta']);
                    $lokacija = htmlspecialchars($row['lokacija']);
                    $naziv = htmlspecialchars($row['naziv']);
                ?>
                    <article class="animal_card">
                        <a href="./clanak.php?id=<?= $row['id'] ?>">
                            <img src="<?= $slika ?>">
                            <h3><?= $vrsta ?></h3>
                            <p><strong>Lokacija:</strong> <?= $lokacija ?></p>
                            <p><strong>Ime:</strong> <?= $naziv ?></p>
                        </a>
                        <div>
                        <a class="btn-u" href="edit.php?id=<?= $row['id'] ?>">Uredi</a>
                        <a class="btn-d" href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Jeste li sigurni da želite izbrisati ovu životinju?');">Obriši</a>
                    </div>
                    </article>
                <?php endwhile; ?>
            <?php endif; ?>
        </section>

    </section>
</body>
</html>
 