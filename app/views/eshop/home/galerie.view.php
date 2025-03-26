<?php
$data["stranka"]="galerie";
$this->view("home/header.view", $data) ?>

<?php

$slozka = "sauna-slany";


$slozka = "assets/upload/source/$slozka";
// $slozka ="http://localhost/sauna_klub_slany/01-sauna-mvc/public/assets/upload/source/sauna-slany";
// $slozka = ROOT."assets/upload/source/$slozka";

$soubory = scandir($slozka);
?>
<div class='fotogalerie d-flex flex-wrap justify-content-center'>
    <?php
    foreach ($soubory as $soubor) {
        // preskocit soubory co nas nezajimaji
        if ($soubor[0] == ".") {
            continue;
        }

        $celaCesta = "$slozka/$soubor";
        $info = pathinfo($celaCesta);
        if ($info["extension"] == "jpg") {
            $rozmery = getimagesize($celaCesta);
            $sirka = $rozmery[0];
            $vyska = $rozmery[1];
            ?>
            <div class='card border rounded m-1 shadow-sm'>
                 <a href='<?= $celaCesta ?>' data-pswp-width=<?=$sirka?> data-pswp-height=<?= $vyska ?>>
                        <img class="card-img-top" src='<?= $celaCesta ?>' height=200>
                    </a>
                <!-- <div class='card-body text-center py-4'>
                   
                </div> -->
            </div>
            <?php
        }
    }
    ?>
</div>

<script type="module">
    import PhotoSwipeLightbox from '<?= ROOT ?>assets/photoswipe/dist/photoswipe-lightbox.esm.js';
    const lightbox = new PhotoSwipeLightbox({
        gallery: '.fotogalerie',
        children: 'a',
        pswpModule: () => import('<?= ROOT ?>assets/photoswipe/dist/photoswipe.esm.js')
    });
    lightbox.init();
</script>

<?php $this->view("home/footer.view") ?>