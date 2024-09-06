-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pát 16. srp 2024, 14:00
-- Verze serveru: 10.4.32-MariaDB
-- Verze PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `primakavarna`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `stranka`
--

DROP TABLE IF EXISTS `stranka`;
CREATE TABLE `stranka` (
  `id` varchar(100) NOT NULL,
  `titulek` varchar(255) DEFAULT NULL,
  `menu` varchar(255) DEFAULT NULL,
  `obsah` text DEFAULT NULL,
  `poradi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `stranka`
--

INSERT INTO `stranka` (`id`, `titulek`, `menu`, `obsah`, `poradi`) VALUES
('404', 'Stránka neexistuje', '', '<section>\n<h1 class=\"stranka-neexistuje\">Stránka nenalezena</h1>\n<div class=\"page-notFound\"><img src=\"img/404.png\" alt=\"Stránka nenalezena\" /></div>\n</section>', 5),
('galerie', 'PrimaKavárna - Galerie', 'Galerie', '<section class=\"row\">\r\n<h2>Galerie</h2>\r\n<p>Podívejte se na prostředí naší kavárny ještě dříve než se u nás zastavíte na lahodný zákusek nebo kafe. Prostor naší kavárny Vám bude evokovat doby dávno minulé a pokud jste si oblíbili třicátá léta minulého století, budete se u nás cítit jako doma. Těšíme se na Vaší návštěvu jsme připraveni Vám nabídnout jen to nejlepší.</p>\r\n<p>[fotogalerie slozka=\"dezerty\"]</p>\r\n<div class=\"galerie-images\"> </div>\r\n<div class=\"galerie-images\"></div>\r\n</section>', 2),
('kontakt', 'PrimaKavárna - Kontakt', 'Kontakt', '<section>\r\n<div class=\"row\">\r\n<h2>Kontakt</h2>\r\n<div class=\"info\">\r\n<div class=\"contact-info\">\r\n<h3>Adresa</h3>\r\n<a href=\"https://mapy.cz/s/kabatevatu\" target=\"_blank\" rel=\"noopener\">PrimaKavárna<br />Jablonského 2<br />Praha,Holešovice</a>\r\n<p><i class=\"fa-solid fa-phone\"></i>Telefon: <a href=\"#\">606 123 456</a></p>\r\n<p><i class=\"fa-solid fa-at\"></i>Email: <a href=\"#\">info@primakavarna.cz</a></p>\r\n</div>\r\n<div class=\"tabulka\">\r\n<h3>Otevřeno</h3>\r\n<table>\r\n<tbody>\r\n<tr>\r\n<th>Po - Pá:</th>\r\n<td>8h - 20h</td>\r\n</tr>\r\n<tr>\r\n<th>So:</th>\r\n<td>10h - 22h</td>\r\n</tr>\r\n<tr>\r\n<th>Ne:</th>\r\n<td>12h - 20h</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n</div>\r\n<section class=\"mapa\"><iframe style=\"border: none;\" src=\"https://frame.mapy.cz/s/pavurafuja\" width=\"100%\" height=\"450\" frameborder=\"0\"></iframe></section>\r\n[kontaktni-formular email=phammm@seznam.cz]</section>', 4),
('nabidka', 'PrimaKavárna - Nabídka', 'Nabídka', '<main class=\"nabidka row\">\r\n<section class=\"row\">\r\n<h2>Nabídka</h2>\r\n<p>Každý den pro Vás náš personál připravuje spoutu výtečných pochoutek, laskomin, vynkající kávu, domácí limonády a to vše si můžete vybrat právě zde. Už máte chuť? Stavte se u nás:)</p>\r\n</section>\r\n<section>\r\n<div class=\"obrazek-cenik\">\r\n<div class=\"obrazek\">\r\n<p>Espresso</p>\r\n<img src=\"img/nabidka-espresso.jpg\" alt=\"\" /></div>\r\n<table class=\"cenik\">\r\n<tbody>\r\n<tr>\r\n<th>Espresso</th>\r\n<td>45 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Espresso Macchiato</th>\r\n<td>55 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Cappuccino</th>\r\n<td>60 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Double espresso</th>\r\n<td>65 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Flat White</th>\r\n<td>60 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Cafe Latte</th>\r\n<td>80 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Espresso Tonic</th>\r\n<td>80 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Irish Coffee</th>\r\n<td>135 Kč</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n<div class=\"obrazek-cenik\">\r\n<div class=\"obrazek\">\r\n<p>Dezerty</p>\r\n<img src=\"img/nabidka-dezerty.jpg\" alt=\"\" /></div>\r\n<table class=\"cenik\">\r\n<tbody>\r\n<tr>\r\n<th>Cheesecake</th>\r\n<td>69 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Mrkvový dortík</th>\r\n<td>79 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Muffin čokoládový</th>\r\n<td>50 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Skořicový rohlíček</th>\r\n<td>59 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Apple Pie</th>\r\n<td>49 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Panna Cotta</th>\r\n<td>55 Kč</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n<div class=\"obrazek-cenik\">\r\n<div class=\"obrazek\">\r\n<p>Snídaně</p>\r\n<img src=\"img/nabidka-snidane.jpg\" alt=\"\" /></div>\r\n<table class=\"cenik\">\r\n<tbody>\r\n<tr>\r\n<th>Vejce Benedict soufflé</th>\r\n<td>135 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Vejce Florenine soufflé</th>\r\n<td>135 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Bürcher müsli s mátovým sirupem a ovocem</th>\r\n<td>90 Kč</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n<div class=\"obrazek-cenik\">\r\n<div class=\"obrazek\">\r\n<p>Nealko</p>\r\n<img src=\"img/nabidka-nealko.jpg\" alt=\"\" /></div>\r\n<table class=\"cenik\">\r\n<tbody>\r\n<tr>\r\n<th>Domácí limonády 0,25l</th>\r\n<td>40 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Fentimans Giner beer 0,125l</th>\r\n<td>65 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Fentimans limonády 0,275l</th>\r\n<td>65 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Thomas Henry Grapefruit 0,2l</th>\r\n<td>55 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Fritz Cola 0,33l</th>\r\n<td>45 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Fritz Cola light 0,33l</th>\r\n<td>40 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Juice 0,2l</th>\r\n<td>30 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>John Lemon limonády 0,33l</th>\r\n<td>32 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Minerální voda Coralba 0,25l</th>\r\n<td>20 Kč</td>\r\n</tr>\r\n<tr>\r\n<th>Minerální voda Coralba 0,75l</th>\r\n<td>40 Kč</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n</section>\r\n</main>', 1),
('rezervace', 'PrimaKavárna - Rezervace', 'Rezervace', '<section class=\"row\">\r\n<h2 style=\"text-align: center;\">Rezervace</h2>\r\n<p class=\"rezervovani\">Pokud si chcete odpočinout v příjemném prostředí naší kavárny, pobavit se s přáteli či obchodními partnery, rozhodně Vám doporučujeme zarezervovat si vhodný počet míst.</p>\r\n<div class=\"contact-info\">\r\n<p><i class=\"fa-solid fa-phone\"></i>Volat můžete na tel.: <a href=\"#\">606 123 456</a></p>\r\n<p><i class=\"fa-solid fa-at\"></i>Psát na e-mail: <a href=\"#\">rezervace@primakavarna.cz</a></p>\r\n<p id=\"reservation-form\"><i class=\"fa-brands fa-wpforms\"></i>Nebo můžete využít následující rezervační formulář</p>\r\n</div>\r\n[rezervace-formular email=phammm@seznam.cz]</section>', 3),
('uvod', 'PrimaKavárna', 'Domů', '<section class=\"row\">\r\n<h2>- O nás -</h2>\r\n<p>Naše PrimaKavárna je originální a příjemné místo inspirované prostředím francouzských kaváren. V nabídce najdete provtřídní vína z Franicie, Itálie i Čech. Především pro pány máma čepované tradiční české pivo Únětice a řadu lahodnch lehkých jídel. Nechybí skvělá káva a dobré čaje, a tak si každý přijde na své. Návštěvou naší kaváry potěšíte nejen své chuťové buňky, ale také potrápíte mozkové závity při hraní deskových her, které si můžete vypůjčit :).</p>\r\n<div class=\"main-section row\">\r\n<div class=\"coffee\"><img src=\"img/pribeh-kava.jpg\" alt=\"\" />\r\n<div class=\"mediazarovnani\">\r\n<h3>Káva</h3>\r\n<p>Kávovník je ovocný strom, jehož plodem jsou peckovice. Kávová zrna jsou tedy vlastně pecky kávových třešní. Samotný plod je jedlý a sušený se v některých zemích používá k výrobě čaje zvaného cascara.</p>\r\n<a href=\"#\">Více<i class=\"fa-solid fa-angles-right\"></i></a></div>\r\n</div>\r\n<div class=\"dobroty\"><img src=\"img/pribeh-dobroty.jpg\" alt=\"\" />\r\n<div class=\"mediazarovnani\">\r\n<h3>Dobroty</h3>\r\n<p>Dáváme si záležet na tom, aby naše pokrmy byly lehké, jednoduché a chutné. Ze zásady pracujeme pouze s chlazeným masem, pečivo si připravujeme sami, vyhýbáme se polotovarům a snažíme se připravovat všechny pokrmy kompletně sami - to je naše vnímání domácí kuchyně.</p>\r\n<a href=\"#\">Více<i class=\"fa-solid fa-angles-right\"></i></a></div>\r\n</div>\r\n<div class=\"zakusky\"><img src=\"img/pribeh-zakusky.jpg\" alt=\"\" />\r\n<div class=\"mediazarovnani\">\r\n<h3>Zákusky</h3>\r\n<p>Mezi naše oblíbené zákusky patří větrníky, věnečky, špičky, kremrole, indiánci, nejrůznější typy řezů, dortíků či rolád.</p>\r\n<a href=\"#\">Více<i class=\"fa-solid fa-angles-right\"></i></a></div>\r\n</div>\r\n</div>\r\n</section>\r\n<section>\r\n<div class=\"main-promotion\">\r\n<div class=\"promotion-text\">\r\n<h3>Každé pondělí cappuccino zdarma</h3>\r\n<p>Zajděte si k nám v pondělí dopoledne pro cappuccino s sebou a získáte pro Vaše hezčí pondělí druhé cappuccino ZDARMA! Děláme vše pro vaše hezké pondělky!</p>\r\n<h3>Sleva pro stále zákazníky</h3>\r\n<p>Už víte, že máme tu nejlepší kávu, skvělé zákusky, lahodné dezerty a úžasný tým, který Vám splní vše co si budete přát. Aby jste k nám chodili s ještě větší láskou stačí si na baru zažádat o naší věrnostní kartičku. Věřte, že nebudete litovat :)</p>\r\n</div>\r\n<div class=\"promotion-image\">\r\n<div class=\"prouzek\"></div>\r\n</div>\r\n</div>\r\n</section>\r\n<section>\r\n<div class=\"our-tip row\">\r\n<div class=\"tip-images\"><img src=\"img/tip-chleba.jpg\" alt=\"\" /> <img src=\"img/tip-vareni.jpg\" alt=\"\" /></div>\r\n<div class=\"tip-text\">\r\n<h3>Náš tip</h3>\r\n<p>Také milujete čerstvé měkké pečivo a voňavý chléb s křupavou kůrčičkou a nestojíte o davy lidí v supermarketu? Vynikající chléb, rohlíky a housky pro vás připravujeme každý den.</p>\r\n<p>Využíváme naší osvědčenou recepturu, kterou naši pekaři vypiplali k naprosté dokonalosti. Těšíte se na ten nejlepší chléb?</p>\r\n</div>\r\n</div>\r\n</section>', 0);

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `stranka`
--
ALTER TABLE `stranka`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
