<?php
require "stranky.php";
require "vendor/autoload.php";   

if (array_key_exists("stranka", $_GET)) {
    $webStranka = $_GET["stranka"];
    if (array_key_exists($webStranka, $seznamStranek) == false) {
        $webStranka = "404";
        http_response_code(404);
    }
} else {
    // Zjistíme první stránku z pole $seznamStranek
    $webStranka = array_key_first($seznamStranek);
}




?>

<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="fonts">
    <link rel="stylesheet" href="css/queries.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="vendor\PhotoSwipe-5.4.4\dist\photoswipe.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <title><?= $seznamStranek[$webStranka]->titulek ?></title>
</head>

<body>
    <header>
        <div class="nav-background"></div>
        <div class="nav-menu row">
            <div id="logo">
                <a href="index.php"><img src="img/logo.png" alt="logo PrimaKavárna"></a>
            </div>

            <nav>
                <ul>
                    <?php
                        foreach ($seznamStranek as $stranky => $info) {
                            if ($info->menu !== "") {
                                ?>
                                <li><a href='<?php echo urlencode($stranky)?>'><?= htmlspecialchars($info->menu)?></a></li>
                                <?php
                            }   
                        }
                    ?>
                </ul>
            </nav>

        </div>
        <section>
            <h1>PrimaKavárna</h1>
            <p>Jsme tu pro vás již od roku 2002</p>
            <div class="fontyawesome">
                <a href="https://www.facebook.com/" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://www.youtube.com/" target="_blank"><i class="fa-brands fa-youtube"></i></a>
            </div>
        </section>

    </header>

    <main id="obsah">
        <?php $obsah = $seznamStranek[$webStranka]->getObsah();
        // call library function shortcode
        echo primakurzy\Shortcode\Processor::process('shortcodes', $obsah);
        ?>
    </main>

    <footer>
        <div class="footer-obsah row">
            <div class="menu">
                <p>Menu</p>
                <nav>
                    <ul>
                        <?php
                            foreach ($seznamStranek as $stranky => $info) {
                                if ($info->menu !== "") {
                                    ?>
                                    <li><a href='<?= urlencode($stranky)?>'><?= htmlspecialchars($info->menu)?></a></li>
                                    <?php
                                }   
                            }
                        ?>
                    </ul>
                </nav>
            </div>

            <div class="contact">
                <p>Kontakt</p>
                <a href="https://mapy.cz/s/kabatevatu" target="_blank">PrimaKavárna<br>Jablonského 2<br>Praha,
                    Holešovice</a>
            </div>

            <div class="open-hours">
                <p>Otevřeno</p>
                <table>
                    <tr>
                        <th>Po - Pá:</th>
                        <td>8h - 20h</td>
                    </tr>
                    <tr>
                        <th>So:</th>
                        <td>10h - 22h</td>
                    </tr>
                    <tr>
                        <th>Ne:</th>
                        <td>12h - 20h</td>
                    </tr>
                </table>
            </div>
        </div>
    </footer>
    
    <div id="nahoru"><i class="fa-solid fa-up-long"></i></div>

    <script src="js/index.js"></script>
</body>

</html>