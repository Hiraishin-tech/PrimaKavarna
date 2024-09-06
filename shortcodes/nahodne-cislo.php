<?php

$min = $shortcode->getParameter("od", 15);
$max = $shortcode->getParameter("do");

echo rand($min, $max);
// vs code pěkně kecá. Funkce rand existuje.

