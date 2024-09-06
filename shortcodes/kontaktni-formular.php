<?php
$chyby = [];
$jmeno = null;
$telefon = null;
$email = null;
$zprava = null;
$odeslano = false;
$formularOdeslan = false;

if (array_key_exists("odeslat", $_POST)) {
    $jmeno = $_POST["jmeno"];
    $telefon = $_POST["telefon"];
    $email = $_POST["email"];
    $zprava = $_POST["zprava"];
    $formularOdeslan = true;

    // validace hodnot
    if (mb_strlen($jmeno) < 3) {
        $chyby["jmeno"] = "Zadejte platné jméno";
    }

    if (mb_strlen($telefon) < 9) {
        $chyby["telefon"] = "Zadejte platné telefonní číslo";
    } 

    if (!preg_match("/.+@.+\\..+/", $email)) {
        $chyby["email"] = "Emailová adresa je neplatná";
    }

    if (mb_strlen($zprava) < 5) {
        $chyby["zprava"] = "Zpráva je moc krátká";
    }

    // Odeslání na email
    if ($chyby === []) {
        $odeslano = true;

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        $mail->CharSet = "UTF-8";

        try {
            //Recipients
            $mail->setFrom('info@primakavarna.cz', 'PrimaKavárna');
            $adresaEmailu = $shortcode->getParameter("email");
            $mail->addAddress($adresaEmailu);     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Kontaktní formulář PrimaKavárna';
            $mail->Body    = "
            <div><b>Jméno: </b>$jmeno</div>
            <div><b>Telefon: </b>$telefon</div>
            <div><b>Email: </b>$email</div>
            <div><b>Zpráva: </b>$zprava</div>
            ";

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}

?>

<?php if (!$odeslano): ?>
<div class="contact-form row" id="contact-form">
    <form method="post" action="#contact-form">
    <h2>Napište nám</h2>
    <div class="radka">
        <input type="text" name="jmeno" placeholder=" " id="jmeno" required value="<?= htmlspecialchars($jmeno)?>" /><label for="jmeno">Jméno</label>
        <div class="status <?php 
        if ($formularOdeslan) {     // Jenom když se formulář odešle, tak vypíšu buď ok, nebo spatne
            if (array_key_exists("jmeno", $chyby)) {
                echo "spatne";
            } else {
                echo "ok";
            }
        } 

        ?>" >
            <i class="fa-solid fa-check"></i>
            <i class="fa-solid fa-xmark"></i>
        </div>
    </div>
    <?php if (array_key_exists("jmeno", $chyby)) echo "<div class='chyba'>{$chyby["jmeno"]}</div>" ?>
    <div class="radka">
        <input type="text" name="telefon" placeholder=" " id="telefon" value="<?php echo htmlspecialchars($telefon) ?>" /><label for="telefon">Telefon</label>
        <div class="status <?php 
        if ($formularOdeslan) {
            if (array_key_exists("telefon", $chyby)) {
                echo "spatne";
            } else {
                echo "ok";
            }
        }
        ?>">
            <i class="fa-solid fa-check"></i>
            <i class="fa-solid fa-xmark"></i>
        </div>
    </div>
    <?php if (array_key_exists("telefon", $chyby)) echo "<div class='chyba'>{$chyby["telefon"]}</div>" ?>
    <div class="radka">
        <input type="email" name="email" placeholder=" " id="email" required value="<?= htmlspecialchars($email)?>" /><label for="email">Email</label>
        <div class="status <?php 
        if ($formularOdeslan) {
            if (array_key_exists("email", $chyby)) {
                echo "spatne";
            } else {
                echo "ok";
            }
        }
        ?>">
            <i class="fa-solid fa-check"></i>
            <i class="fa-solid fa-xmark"></i>
        </div>
    </div>
    <?php if (array_key_exists("email", $chyby)) echo "<div class='chyba'>{$chyby["email"]}</div>"  ?>
    <div class="radka">
        <textarea name="zprava" id="zprava" placeholder=" " rows="50"><?= htmlspecialchars($zprava)?></textarea><label for="zprava">Zpráva</label>
        <div class="status <?php 
        if ($formularOdeslan) {
            if (!array_key_exists("zprava", $chyby)) {
                echo "ok";
            } else {
                echo "spatne";
            }
        }
        ?>">
            <i class="fa-solid fa-check"></i>
            <i class="fa-solid fa-xmark"></i>
        </div>
    </div>
    <?php if (array_key_exists("zprava", $chyby)) echo "<div class='chyba'>{$chyby["zprava"]}</div>" ?>
        <input type="submit" value="Odeslat" name="odeslat" />
    </form>
</div>
<?php else: ?>
<div class="contact-form row" id="contact-form">
<h2>Zpráva byla úspěšně odeslána</h2>
</div>


<?php endif ?>

<style>
    .chyba {
        color: red;
        font-weight: bold;
    }
</style>

<script>
    $(".contact-form [name]").on("input", (event) => {
        const input = event.currentTarget;
        const nazevInputu = input.getAttribute("name");
        const hodnotaInputu = input.value;
        
        let ok = true;
        if (nazevInputu === "jmeno") {          // Validace bude skoro stejná jako v PHP
            if (hodnotaInputu.length < 3) {
                ok = false;
            }

        } else if (nazevInputu === "telefon") {
            if (hodnotaInputu.length < 9) {
                ok = false;
            }
        } else if (nazevInputu === "email") {
            if (hodnotaInputu.match(/.+@.+\..+/) === null) {       
                // Narozdíl od PHP regulární výraz nemusí být ve stringu (v uvozovkách)
                ok = false;
            }
        } else if (nazevInputu === "zprava") {
            if (hodnotaInputu.length < 5) {
                ok = false;
            }
        }

        
        // Výsledek validace
        const statusElement = document.querySelector(`.contact-form [name=${nazevInputu}]~.status`);
        // Získáme konkrétní status ze souseda name. Tilda se píše jako p. alt + 1
        if (ok) {
            statusElement.classList.add("ok");
            statusElement.classList.remove("spatne");
        } else {
            statusElement.classList.add("spatne");
            statusElement.classList.remove("ok");   // nebo přes className je to jedno
        }

        if (hodnotaInputu === "") {
            statusElement.className = "status";     // i když je JavaScript asynchronní, tak proměnné a funkce musím deklarovat předtím, než je zavolám. Jinak dojde k chybě.
        }

    });
</script>