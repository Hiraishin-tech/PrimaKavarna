<?php

$slozka = $shortcode->getParameter("slozka");

$slozka = "upload/source/$slozka";  // upload/source/jméno libolovné složky
// var_dump($slozka);

$seznamObrazku = scandir($slozka);
// var_dump($seznamObrazku);

echo "<div class='galerie-images'>";
foreach ($seznamObrazku as $obrazek) {
    if ($obrazek[0] == ".") {
        continue;
    }
    $celaCesta = "$slozka/$obrazek";

    $info = pathinfo($celaCesta);

    $obrazekInfo = getimagesize($celaCesta);
    // var_dump($obrazekInfo);
    $sirka = $obrazekInfo[0];
    $vyska = $obrazekInfo[1];

    // Prevence, aby uživatel nenahrál do galerie např. textový soubor
    if ($info["extension"] == "jpg" || $info["extension"] == "png") {

        echo "<a href='$celaCesta' data-pswp-width=$sirka data-pswp-height=$vyska>
        <img src='$celaCesta'>
            </a>";
    }
}

echo "</div>";
?>

<script type="module">
import PhotoSwipeLightbox from './vendor/PhotoSwipe-5.4.4/dist/photoswipe-lightbox.esm.js';
const lightbox = new PhotoSwipeLightbox({
  gallery: '.galerie-images',
  children: 'a',
  pswpModule: () => import('./vendor/PhotoSwipe-5.4.4/dist/photoswipe.esm.js')
});
lightbox.init();
</script>
