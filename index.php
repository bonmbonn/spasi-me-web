<?php
    session_start();
    include 'connect.php';

    $query = "SELECT * FROM added_animals WHERE aktivno = 1 LIMIT 10";
    $result = $conn->query($query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
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

    <div class="animal_card_box">
        <h3 id="animal_cards_naslov">Životinje za udomljavanje</h3>
        <section class="animal_cards">
            <?php
            $rows = mysqli_num_rows($result);
            if ($rows > 0){
                while ($row = mysqli_fetch_array($result)) {
                    $slika = htmlspecialchars($row['slika']);
                    $vrsta = htmlspecialchars($row['vrsta']);
                    $lokacija = htmlspecialchars($row['lokacija']);
                    $naziv = htmlspecialchars($row['naziv']);
                ?>
                    <article class="animal_card">
                    <a href="./clanak.php?id=<?= $row['id'] ?>">
                            <img src="<?php echo $slika; ?>">
                            <h3><?php echo $vrsta; ?></h3>
                            <p><strong>Lokacija:</strong> <?php echo $lokacija; ?></p>
                            <p><strong>Ime:</strong> <?php echo $naziv; ?></p>
                        </a>
                    </article>
                <?php
                }
            } else {
                echo "<h2>Trenutno su sve životinje udomljene!</h2>";
            }
            ?>
        </section>

    </div>

    <section class="info_section">
        <img src="./images_home/animals_together.webp" alt="" id="bonding_image">
        <article class="introduction">
            <h2><strong>PREKO 1000 UDOMLJAVANJA GODIŠNJE</strong></h2>
            <p>Postani i ti udomitelj i pruži bolji život onima koji te najviše trebaju. Svake godine stotine napuštenih, izgubljenih i neželjenih životinja pronađu svoj novi dom zahvaljujući ljudima velikog srca. Naša misija je da svaka životinja dobije priliku za sreću, toplinu doma i ljubav koju zaslužuje. Budi promjena koju želiš vidjeti.otvori srce i dom onima koji ti uzvraćaju bezuslovnom ljubavlju. Pridruži se zajednici udomitelja i pomozi nam da zajedno gradimo svijet u kojem nijedna šapa ne ostaje zaboravljena.</p>
        </article>
    </section>

<section class="dynamic_buttons">
    <a href="./administrator.php" class="left_button">
        <h1><strong>ADMINISTRACIJA</strong></h1>
        <p><strong>Prijavi se i postani dio našeg tima</strong></p>
    </a>
    <a href="./unos.php" class="right_button">
        <h1><strong>DODAJ ŽIVOTINJU</strong></h1>
        <p><strong>Objavi životinju za udomljavanje</strong></p>
    </a>
</section>

<section class="end_section">
  <article class="end_content">
            <h2><strong>UDOMLJAVANJE - NOVA PRILIKA ZA LJUBAV</strong></h2>
            <p>Jeste li znali da svake godine tisuće pasa i mačaka pronađu svoj novi dom zahvaljujući udomiteljima? Udomljavanje ne samo da spašava živote, već i donosi radost i smirenje kako životinjama, tako i njihovim ljudima. Ljubav i zahvalnost koju pružaju spašene životinje ne može se mjeriti riječima, a istraživanja pokazuju da ljudi koji udomljavaju imaju nižu razinu stresa i sretniji su u svakodnevnom životu. Odabirom udomljavanja dajete priliku za novi početak i stvarate prijateljstvo koje traje cijeli život.</p>
            <img src="./images_home/corgi_running.jpg" alt="" class="end_image1">
    </article>

    <article class="end_content_maja">
        <div class="maja_box">
            <h2><strong>ISKUSTVO MAJE, UDOMITELJICE MACE I PESEKA</strong></h2>
            <p>
            <i>"Kad sam prvi put došla u sklonište, nisam planirala uzeti ni psa ni mačku. Samo sam htjela pomoći volontiranjem. A onda sam upoznala Lunicu, tiho stvorenje koje mi se u sekundi uvuklo pod kožu. Dva tjedna kasnije, udomila sam i Maxa, veselog psa s neodoljivim pogledom. Danas ne mogu zamisliti svoj život bez njih dvoje.
            <br><br>
            Udomljavanje mi je promijenilo život. Ne samo da sam pružila dom njima, već su i oni meni donijeli mir, radost i ljubav koju ne mogu opisati riječima. Ako razmišljaš o udomljavanju napravi taj korak. Ne spašavaš samo njih, spašavaš i sebe."
            </i>
            </p>
        </div>
        <img src="./images_home/dogicat.webp" alt="" class="maja_img">
    </article>

    <article class="end_content">
            <h2><strong>LJUBAV KOJA SPAŠAVA ŽIVOTE</strong></h2>
            <p>Svaka udomljena životinja priča svoju posebnu priču o drugoj šansi i novom početku. Udomljavanjem ne samo da pružate dom jednom biću u nevolji, već dobivate i lojalnog prijatelja za cijeli život. Statistike pokazuju da udomljene životinje često brže stječu povjerenje i stvaraju snažnu vezu sa svojim ljudima. Udomiteljstvo je čin ljubavi koji mijenja svijet – korak po korak, šapu po šapu.</p>
            <img src="./images_home/hegdhe.jpg" alt="" class="end_image2">
    </article>
</section>

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

</body>
</html>