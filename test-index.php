<?php
require "vendor/autoload.php";
require "stranky.php";

// zjistime prvni stranku z pole seznamStranek
$stranka = array_key_first($seznamStranek);
// uvodni stranka pro odkaz v logu
$uvodniStranka = $stranka;

if (array_key_exists("stranka", $_GET)) {
    $stranka = $_GET["stranka"];

    // kontrola zdali zadana stranka existuje
    if (array_key_exists($stranka, $seznamStranek) == false) {
        // stranka neexistuje
        $stranka = "404";

        // odeslat informaci i vyhledavaci ze url neexistuje
        http_response_code(404);
    }
}

?>
<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $seznamStranek[$stranka]->titulek ?>
    </title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/section.css">
    <link rel="stylesheet" href="css/zprava.css">
    <link rel="stylesheet" href="css/obsazenost.css">
    <link rel="stylesheet" href="css/galerie.css">
    <link rel="stylesheet" href="css/footer.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">

    <link rel="stylesheet" href="vendor/photoswipe/dist/photoswipe.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>

<input type="checkbox" name="" id="hamburger-menu">

    <header>
        <div>
            <div class="headerTop">
                <div class="container">
                    <div class="adresa">
                        <p>
                            <a class="odkaz" href="https://mapy.cz/s/lelonubete" target="_blank">
                                <i class="fa-solid fa-location-dot"></i>
                                Kynskeho 122, Slany
                            </a>
                        </p>
                    </div>

                    <a class="odkaz" href="tel:+420 776 740 434">tel.: +420/ 776 740 434</a>
                </div>
            </div>
            <div class="headerMidl">
                <div class="container">
                    <h2>
                        <a href="<?php echo $uvodniStranka; ?>">Sauna&nbsp;Klub<br>Slaný</a>
                    </h2>

                    <!-- <img src="img/spojeni-fotek-30.png" alt="obývák"> -->
                </div>
            </div>
        </div>


        <nav>
            <div class="container">
                <?php
                require "./menu.php";
                ?>

                <div class="hamburger-menu">
                    <label for="hamburger-menu">
                        <div class="tlacitko">
                            <div class="carka">
                            </div>
                            <div class="carka">
                            </div>
                            <div class="carka">
                            </div>
                        </div>
                    </label>
                </div>

            </div>
        </nav>

    </header>

    <section>
        <div class="container">
            <?php
            $obsah = $seznamStranek[$stranka]->getObsah();
            echo primakurzy\Shortcode\Processor::process('shortcodes', $obsah);
            ?>
        </div>
    </section>

    <footer>

        <div class="kontakty">
            <div class="container">
                <div class="kontaktyTop">
                    <h2>KONTAKTY pro objednání:</h2>
                    <p>
                        <a class="odkaz" href="tel:+420 776 740 434">
                            <i class="fa-solid fa-phone"></i>
                            +420 776 740 434
                        </a>
                    </p>
                    <p>
                        <a class="odkaz" href="https://mapy.cz/s/lelonubete" target="_blank">
                            <i class="fa-solid fa-location-dot"></i>
                            Kynskeho 122, Slany
                        </a>
                    </p>
                    <p>
                        <a class="odkaz" href="mailto:saunaslany@seznam.cz">
                            <i class="fa-regular fa-envelope"></i>
                            saunaslany@seznam.cz
                        </a>
                    </p>
                </div>

                <div class="soc">
                    <a href="https://www.facebook.com/profile.php?id=100083707954063" target="_blank"><i
                            class="fa-brands fa-facebook"></i></a>
                    <a href="https://instagram.com/saunaklubslany?igshid=NTc4MTIwNjQ2YQ==" target="_blank"><i
                            class="fa-brands fa-instagram"></i></a>
                </div>

            </div>


        </div>

    </footer>

    <div class="" id="nahoru"><i class="fa-solid fa-angle-up"></i></div>

    <script src="js/index.js"></script>
</body>

</html>