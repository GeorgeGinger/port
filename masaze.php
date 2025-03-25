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
            <!-- <?php
            $obsah = $seznamStranek[$stranka]->getObsah();
            echo primakurzy\Shortcode\Processor::process('shortcodes', $obsah);
            ?> -->

            <div class="ramecek">
                <div class="zprava privat">
                    <div class="nadpis">
                        <h2>Privátní sauna</h2>
                    </div>
                    <div class="content">
                        <p>Pokud chcete soukromí, můžete si pronajmout celý prostor sauny.</p>
                        <p>PRIVÁT do 5 osob</p>
                        <p>90 minut - 1.250kč - osoba navíc 100kč</p>
                        <p>120 minut - 1.500kč - osoba navíc 100kč</p>
                    </div>
                </div>
            </div>

            <div class="ramecek">
                <div class="zprava masaz">
                    <div class="nadpis">
                        <h2>Pravidelná sauna</h2>
                    </div>
                    <div class="content">
                        <div class="darky">
                            <div class="kapitola">
                                <h3></h3>
                                <div class="obrazek_text">
                                    <p>

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ramecek">
                <div class="zprava masaz">
                    <div class="nadpis">
                        <h2>Masáže</h2>
                    </div>
                    <div class="content">

                        <div class="darky">
                            <div class="kapitola">
                                <h3></h3>
                                <div class="obrazek_text">
                                    <p>
                                        Masáž je jednou z nejstarších a nejpřirozenějších metod, jak udržovat fyzické i
                                        duševní
                                        zdraví člověka. Podporuje přirozené samoléčebné a ozdravné procesy lidského
                                        organismu.
                                        Masážní techniky prováděné pravidelně jednou týdně podporují dobrou kondici a
                                        odolnost
                                        organismu. Zvyšují vitalitu a odolnost vůči stresu a mnohdy náročným vnějším
                                        vlivům.
                                    </p>
                                    <p>
                                        Ideální je se před masáží osprchovat nebo vykoupat, protože pak se olejíčky lépe
                                        vstřebávají. Nejíst tučná ani příliš nadýmavá jídla, nepít alkohol, jinak by
                                        látkový
                                        metabolismus pracoval pomalu a těžce, nedošlo by k úplnému uvolnění.
                                    </p>
                                </div>
                            </div>
                        </div>


                        <div class="kapitola">
                            <h3>Aromaterapeutická masáž</h3>
                            <div class="obrazek_text">
                                <img src="./img/aroma.jfif" width="150" height="150" alt="Aromaterapeutická masáž">
                                <p>
                                    Aromaterapeutická masáž
                                    Během života se v našem těle tvoří různě intenzivní svalová napětí. Ať už jsou
                                    způsobená
                                    stresem nebo sedavým zaměstnáním, znemožňují nám zhluboka dýchat a naší energii
                                    volně
                                    proudit. Snadným řešením je masáž, která Vám vrátí rovnováhu a uvolní Vaše svaly.
                                    Masáž
                                    je
                                    nejpřirozenější způsob relaxace a regenerace. Pokud chcete mít z masáže maximální
                                    prožitek,
                                    zapojte přírodu a její cenné dary pro hýčkání smyslů. Doteky ve spojení s přírodními
                                    oleji
                                    uklidňují, pomáhají zmírnit a napětí, povzbuzují mysl a zvláčňují pokožku.
                                </p>
                            </div>
                        </div>

                        <div class="darky">
                            <div class="kapitola">
                                <h3>Relaxační masáž s vůněmi</h3>
                                <div class="obrazek_text">
                                    <img src="./img/relaxvune.jfif" width="150" height="150"
                                        alt="Aromaterapeutická masáž">
                                    <p>
                                        Příjemný odpočinek plný vůně, spojený s léčivým účinkem éterických olejů. Jde o
                                        jemnou
                                        relaxační masáž, která účinně odstraňuje napětí způsobené stresem a celkovou
                                        duševní
                                        nepohodou. Důležitou úlohou jsou éterické oleje, které během masáže pronikají
                                        všemi
                                        vrstvami
                                        kůže a působí tak na naše tělo, pomáhají odstranit fyzické potíže, ale také
                                        ovlivňují
                                        psychickou rovnováhu. Tato masáž může také správně stimulovat činnost imunitního
                                        systému
                                        a
                                        posilovat obranyschopnost organizmu před onemocněním.
                                    </p>
                                </div>
                            </div>
                        </div>


                        <div class="kapitola">
                            <h3>Protahovací masáž kombinovaná s olejovou masáží zad</h3>
                            <div class="obrazek_text">
                                <img src="./img/masaz.jfif" width="150" height="150" alt="Aromaterapeutická masáž">
                                <p>
                                    Jedná se o kombinace tlakové techniky (akupresury), práce na energetických drahách a
                                    protažení v jógových pozicích (strečink). Masáž uvolňuje svalstvo, zlepšuje ohebnost
                                    kloubů,
                                    pomáhá při únavě či přepnutí ze sportu a napomáhá celkové pružnosti Vašeho těla.
                                    Vyrovnává
                                    Váš energetický systém, takže se budete cítit odpočatě a zároveň plní energie.
                                    Olejová
                                    masáž
                                    napomáhá energii rovnoměrně prostupovat tělem. Zde můžeme mluvit o léčebné masáži,
                                    která
                                    uvolňuje svaly a působí příznivě na krevní a mízní oběh, i na imunitní systém.
                                    Podstata
                                    onemocnění je dána nerovnováhou v našem organismu a také nesouladem mezi námi a
                                    okolím.
                                    Pravidelná masáž uklidňuje nervový systém, uvolňuje svalové napětí, stimuluje krevní
                                    oběh,
                                    redukuje otoky a tuhnutí tkáně a napomáhá regulaci střev.
                                </p>
                            </div>
                        </div>

                        <div class="darky">
                            <div class="kapitola">
                                <h3>Lymfatická manuální masáž</h3>
                                <div class="obrazek_text">
                                    <img src="./img/limfa.jfif" width="150" height="150" alt="Aromaterapeutická masáž">
                                    <p>
                                        Jemná masážní technika, jejímž cílem je zlepšení kvality lymfatického oběhu a
                                        urychlení
                                        odtoků lymfy z podkoží zpět do krevního oběhu. Krevní oběh nese nečistoty a
                                        toxické
                                        látky do
                                        čisticích orgánů jako jsou např. ledviny, játra, plíce (plynný odpad), které
                                        tyto
                                        látky
                                        z těla vyloučí přirozenými cestami. Dále odstraňuje celulitidu, zeštíhluje a
                                        zmenšuje
                                        obvod
                                        stehen a nohou, zlepšuje vzhled pokožky celého těla, omlazuje pokožku, zpevňuje
                                        podkoží,
                                        dochází k redukci objemu těla, modeluje postavu. Vnitřní léčebné účinky jsou
                                        zmírnění
                                        otoku
                                        nohou, působí proti tzv. těžkým nohám, preventivně působí pro vzniku křečových
                                        žil,
                                        léčí
                                        již
                                        vzniklé, upravuje otoky po operacích, žilní nedostatečnosti, tok lymfy,
                                        podporuje
                                        detoxikaci
                                        organismu, regeneruje organismus, prokrvuje pokožku, zvyšuje imunitní systém,
                                        zmírňuje
                                        migrenózní stavy.
                                    </p>
                                </div>
                            </div>

                        </div>

                        <div class="kapitola">
                            <h3>Kraniosakrální osteopatie</h3>
                            <div class="obrazek_text">
                                <img src="./img/cranio.jfif" width="150" height="150" alt="Aromaterapeutická masáž">
                                <p>
                                    Jemná manuální technika, která pracuje s pohybem mozkomíšního moku. Působením úchopů
                                    dlaněmi
                                    nejčastěji kolem lebky a páteře rozproudí pohyb mozkomíšního moku v kranio
                                    označujeme
                                    tento proces jako Dech života. Rozprouděním moku se aktivuje moudrost a samoléčebný
                                    potenciál těla, který rozpohybuje samoléčení na úrovni fyzické, emoční a mentální.
                                    Tělo
                                    získanou energii navíc nasměruje do hojení a regenerace. Pomáhá při akutních a
                                    chronických
                                    obtížích, rekonvalescenci, pohybové úrazy, vyhřezlé plotýnky, psychická nepohoda,
                                    dlouhodobé
                                    vleklé potíže, výborný pomocních při artróze, osteoporoze, parkinson, zlomeniny,
                                    pády,
                                    úrazy. Kranio obnovuje a nastoluje rovnováhu. V příjemném teplém prostředí, přes
                                    volné a
                                    pohodlné oblečení.
                                </p>
                            </div>
                        </div>

                        <div class="darky">
                            <div class="kapitola p-center">
                                <p class="zvyraznit">délka masáží 60 minut a cena 999kč</p>
                                <p>Pro objednání volejte na <a href="tel:+420 602 175 988">tel. +420 602 175 988</a>
                                    masérka
                                    Kamila
                                </p>
                                <p>
                                    Osobní stránky masérky <a href="https://ziva-tantra.webnode.cz/" target="blank">živá
                                        tantra</a> nebo
                                    <a href="https://www.masage-kranio-therapist.cz/"
                                        target="blank">masage-kranio-therapist</a>
                                </p>
                                    <p>[fotogalerie slozka="masaze"]</p>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="ramecek">
                <div class="zprava masaz">
                    <div class="nadpis">
                        <h2>Saunování pro děti s rodiči</h2>
                    </div>
                    <div class="content">
                        <div class="kapitola">
                            <p class="zvyraznit">Rezervace nutná na tel: 776 740 434</p>
                            <p class="zvyraznit">Vstupné:
                                pro 1 rodiče a 1 dítě 230kč
                                (v ceně prostěradlo, ručníky a občerstvení)
                                (sebou dítěti vemte župan a přezuvky)
                            </p>
                        </div>

                        <div class="darky">
                            <div class="kapitola">
                                <h3>Desatero Saunování pro děti</h3>
                                <div class="obrazek_text">
                                    <img src="./img/saunadeti.jfif" width="150" height="150" alt="děti v sauně">
                                    <p>
                                        Jedná se o nejlepší a bezpečný způsob, při správném dodržování základních
                                        pravidel,
                                        jak dítěti můžete přirozeně zvyšovat imunitu. Je prokázáno, že děti které se
                                        saunují, jsou méně náchylné na chřipky, různá nachlazení a respirační
                                        choroby.
                                    </p>
                                    <p>
                                        Dítě pravidelným saunováním naučítě starat se o vlastní tělo a získá tak ty
                                        nejlepší
                                        návyky do budoucího života. Kromě toho se v sauně posilují rodinné vazby,
                                        buduje
                                        se
                                        vztah dítě - rodič.
                                    </p>
                                    <ul>
                                        <li>
                                            Před vstupem do sauny se rodič s dítětem společně umyjí a osuší - je
                                            třeba
                                            setřít veškerou vodu z tělíčka dítěte.
                                        </li>
                                        <li>
                                            V sauně pod sebe a děti vždy rozprostřete prostěradlo či osučku, aby
                                            nedošlo
                                            k
                                            popálení o lavici. Miminko se drží v klubíčku, batole může sedět na
                                            klíně,
                                            starší děti si mohou sednout či lehnout.
                                        </li>
                                        <li>
                                            Děti se snažte udržet v klidu, vyprávějte jim pohádky, kreslete jim na
                                            záda
                                            obrázky, atd.
                                        </li>
                                        <li>
                                            Sledujte dítě, jak reaguje na teplotu, která je u dětí v sauně mezi 60 C
                                            až
                                            70 C
                                        </li>
                                        <li>
                                            Ze začátku saunujte 3 - 5 minut, vždy podle aktuálního stavu dítěte,
                                            později
                                            při
                                            pravidelném saunování je možné dobu pomalu prodlužovat, třeba na 8
                                            minut.
                                        </li>
                                        <li>
                                            Po saunování následuje ochlazení, kdy děti osprchujte vlažnou vodou -
                                            celé
                                            tělo
                                            včetně hlavičky. Zabalte ho suchého ručníku nebo do županu a jde se
                                            relaxovat.
                                        </li>
                                        <li>
                                            Relaxace by měla trva minimálně 15 minut než vyrazíte na další kolečko.
                                            Pro
                                            začátek dejte 2 až 3 kolečka.
                                        </li>
                                        <li>
                                            V průběhu relaxace pijte vodu a jezte ovoce.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

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