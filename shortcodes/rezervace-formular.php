<?php
$jmeno = "";
$telefon = "";
$email = "";
$zprava = "";
$errors = [];
$rezervace = false;
$formularOdeslan = false;


if (array_key_exists("odeslat", $_POST)) {
    $jmeno = $_POST["jmeno"];
    $telefon = $_POST["telefon"];
    $email = $_POST["email"];
    $zprava = $_POST["zprava"];
    $formularOdeslan = true;

    // chyby
    if (mb_strlen($jmeno) < 3) {
        $errors["jmeno"] = "Neplatné jméno";
    }
    if (mb_strlen($telefon) < 9) {
        $errors["telefon"] = "Neplatné telefonní číslo";
    }
    if (!preg_match("/.+@.+\\..+/", $email)) {
        $errors["email"] = "Neplatný email";
    }
    if (mb_strlen($zprava) < 5) {
        $errors["zprava"] = "Příliš krátká zpráva";
    }
    // Když nejsou žádné chyby
    if (count($errors) === 0) {
        $rezervace = true;

        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        $mail->CharSet = "UTF-8";
        try {
            $mail->setFrom('rezervace@primakavarna.cz', 'PrimaKavárna');
            $odeslatEmail = $shortcode->getParameter("email");
            $mail->addAddress("$odeslatEmail", 'Bohdan Zedníček');     //Add a recipient
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Rezervační formulář PrimaKavárna';
            $mail->Body = "
            <div><b>Jméno: </b>$jmeno</div>
            <div><b>Telefon: </b>$telefon</div>
            <div><b>Email: </b>$email</div>
            <div><b>Zpráva: </b>$zprava</div>";

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }
}
?>

<?php if ($rezervace == false) { ?>
<div class="contact-form">
    <form action="#reservation-form" method="post">
<div class="radka">
    <input id="jmeno" name="jmeno" type="text" required value="<?= $jmeno ?>" placeholder=" " />
    <label for="jmeno">Jméno</label>
    <div class="status <?php 
        if ($formularOdeslan) {     
            if (array_key_exists("jmeno", $errors)) {
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
<?php if (array_key_exists("jmeno", $errors)) echo "<div class='error'>{$errors["jmeno"]}</div>" ?>
<div class="radka">
    <input id="telefon" name="telefon" type="text" value="<?= $telefon?>" placeholder=" " />
    <label for="telefon">Telefon</label>
    <div class="status <?php 
        if ($formularOdeslan) {     
            if (array_key_exists("telefon", $errors)) {
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
<?php if (array_key_exists("telefon", $errors)) echo "<div class='error'>{$errors["telefon"]}</div>" ?>
<div class="radka">
    <input id="email" name="email" type="email" required value="<?= $email ?>" placeholder=" " />
    <label for="email">Email</label>
    <div class="status <?php 
        if ($formularOdeslan) {     
            if (array_key_exists("email", $errors)) {
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
<?php if (array_key_exists("email", $errors)) echo "<div class='error'>{$errors["email"]}</div>" ?>
<div class="radka">
    <textarea id="zprava" name="zprava" rows="50" required placeholder=" "><?= $zprava ?></textarea>
    <label for="zprava">Zpráva</label>
    <div class="status <?php 
        if ($formularOdeslan) {     
            if (array_key_exists("zprava", $errors)) {
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
<?php if (array_key_exists("zprava", $errors)) echo "<div class='error'>{$errors["zprava"]}</div>" ?>
<input type="submit" name="odeslat" value="Odeslat" />
</form>

</div>
<?php } else { ?>
<div class="contact-form row">
    <h2>Žádost s rezervací byla odeslána</h2>
</div>
<?php } ?>
<p class="final-text">Těšíme se na Vaší návštěvu, brzy na viděnou.</p>

<style>
    .error {
        color: red;
        font-weight: bold;
    }
</style>

<script>
    $(".contact-form [name]").on("input", (event) => {
        const input = event.currentTarget;
        const nazevInputu = input.name;
        const hodnotaInputu = input.value;

        let ok = true;
        if (nazevInputu === "jmeno") {
            if (hodnotaInputu.length < 3) {
                ok = false;
            }
        } else if (nazevInputu === "telefon") {
            if (hodnotaInputu.length < 9) {
                ok = false;
            }
        } else if (nazevInputu === "email") {
            if (hodnotaInputu.match(/.+@.+\..+/) === null) {      // Když dám false, tak podmínka neplatí
                ok = false;
            } 

        } else {
            if (hodnotaInputu.length < 5) {
                ok = false;
            }
        }

        const statusElementu = document.querySelector(`.contact-form [name='${nazevInputu}']~.status`);

        if (ok) {
            statusElementu.className = "status ok";
        } else {
            statusElementu.className = "status spatne";
        }

    });



</script>