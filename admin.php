<?php
require "./stranky.php";
session_start();
$chyba = null;

// Přihlášení
if (array_key_exists("prihlasit", $_POST)) {
    $jmeno = $_POST["jmeno"];
    $heslo = $_POST["heslo"];
    if ($jmeno == "admin" && $heslo == "mony123") {
        $_SESSION["prihlasenyUzivatel"] = $jmeno;
        header("Location: ?");
    } else {
        $chyba = "Špatné přihlašovací údaje";
    }
}

// Odhlášení
if (array_key_exists("odhlasit", $_POST)) {
    unset($_SESSION["prihlasenyUzivatel"]);
    header("Location: ?");
}

// Zprácování akcí v administraci je pouze pro přihlášené uživatele
if (array_key_exists("prihlasenyUzivatel", $_SESSION)) {

    // Aktuálně vybraná stránka
    $instanceAktualniStranky = null;
    if (array_key_exists("stranka", $_GET)) {
        $idStranky = $_GET["stranka"];
        $instanceAktualniStranky = $seznamStranek[$idStranky];
    }

    // Přidání nové stránky
    if (array_key_exists("pridat", $_GET)) {
        $instanceAktualniStranky = new Stranka("", "", "");
    }

    // Smazání stránky
    if (array_key_exists("smazat", $_GET)) {
        $instanceAktualniStranky->smazat();
        header("Location: ?");
  }

    // Editace stránky
    if (array_key_exists("ulozit", $_POST)) {
        $puvodniId = $instanceAktualniStranky->id;
        // změna id, titulku stránku a menu v databázi
        $instanceAktualniStranky->id = $_POST["id"];
        $instanceAktualniStranky->titulek = $_POST["titulek"];
        $instanceAktualniStranky->menu = $_POST["menu"];

        $instanceAktualniStranky->ulozit($puvodniId);

        $obsah = $_POST["obsahStranky"];
        $instanceAktualniStranky->setObsah($obsah);

        // Po uložení se aktualizuje stranka=id v URL
        header ("Location: ?stranka=".urlencode($instanceAktualniStranky->id));
    }

    // Zpracování požadavku na změnu pořadí stránky z javascriptu (ajaxem)
    if (array_key_exists("poradi", $_POST)) {
        $poradi = $_POST["poradi"];
        // Zavolání funkce pro nastavení pořadí a uložení do db.
        Stranka::zmenaPoradi($poradi);

        echo "VseOK";
        exit;
    }
    
}

?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/admin.css">

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>
    <title>Administrace</title>
</head>
<body>
    <div class="admin-body">

    <?php if (array_key_exists("prihlasenyUzivatel", $_SESSION) == false): ?>

    <main class="form-signin w-100 m-auto">
    <form method="POST" class="form-signin">
    <h1 class="h3 mb-3 fw-normal">Přihlásit se</h1>

    <div class="form-floating">
      <input type="text" name="jmeno" class="form-control" id="floatingInput" placeholder="Login">
      <label for="floatingInput">Přihl. jméno</label>
    </div>
    <div class="form-floating">
      <input type="password" name="heslo" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>
    <button class="btn btn-primary w-100 py-2" name="prihlasit" type="submit">Přihlásit</button>
  </form>
  </main>
  <?php if ($chyba != null): ?>
    <div class="alert alert-danger" role="alert">
        <p class="loginError"><?= $chyba ?></p>
    </div>
    <?php endif ?>
    <?php else: ?>
        
    <div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
      <div class="col-md-3 mb-2 mb-md-0">
        <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
          <svg class="bi" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
        </a>
      </div>

      

      <div class="col-md-3 text-end">
      <p>Přihlášený uživatel: <b><?php echo $_SESSION["prihlasenyUzivatel"]?></b></p>
      <form action="" method="POST">
      <button class="btn btn-primary" name="odhlasit">Odhlásit se</button>
      </form>
      </div>
    </header>
  </div>
    <ul class="list-group" id="stranky">
        <?php foreach ($seznamStranek as $idStranky => $objektStranky): ?>
            <?php
            $active = null;
            $btn = "btn-primary";
            ?>
            <?php if ($instanceAktualniStranky == $objektStranky) {$active = "active"; $btn = "btn-secondary"; } ?>
        <li class="list-group-item <?php echo $active ?>" id="<?= $objektStranky->id ?>">
            <a href="?stranka=<?= $idStranky ?>" class="btn <?= $btn ?>">Editovat <i class="fa-solid fa-pen-to-square"></i></a>
             <a href="<?php echo urlencode($objektStranky->id) ?>" class="btn <?= $btn ?>" target="_blank">Zobrazit <i class="fa-solid fa-eye"></i></a>
             <a href="?stranka=<?= $idStranky ?>&smazat" class="btn smazat <?= $btn ?>">Vymazat <i class="fa-solid fa-trash"></i></a>
            <span><?php echo htmlspecialchars($objektStranky->id) ?></span>
        </li>
        <?php endforeach ?>
    </ul>
    <div class="col-md-3 text-start">
    <form action="">
        <button class="btn btn-outline-primary me-2" name="pridat">Přidat stránku</button>
    </form>
      </div>
        <?php if ($instanceAktualniStranky != null): ?>
            <div class="alert alert-secondary" role="alert">
          <?php if (array_key_exists("pridat", $_GET)): ?>
            <h1>Nová stránka:</h1>
          <?php elseif (array_key_exists("stranka", $_GET)): ?>
            <h1>Editace stránky: <?php echo $instanceAktualniStranky->id ?></h1>
            <?php endif ?>
            </div>
    <form action="" method="POST">
        <div class="form-floating">
          <input type="text" name="id" id="id" placeholder="Login" class="form-control" 
          value="<?php echo htmlspecialchars($instanceAktualniStranky->id) ?>">
          <label for="id">ID</label>
        </div>
        <div class="form-floating">
          <input type="text" name="titulek" id="titulek" placeholder="Login" class="form-control" 
          value="<?= htmlspecialchars($instanceAktualniStranky->titulek) ?>">
          <label for="titulek">Titulek</label>
        </div>
        <div class="form-floating">
          <input type="text" name="menu" id="menu" placeholder="Login" class="form-control" 
          value="<?= htmlspecialchars($instanceAktualniStranky->menu) ?>">
          <label for="menu">Menu</label>
        </div>
        <textarea name="obsahStranky" id="obsah" cols="80" rows="15"><?php 
        echo htmlspecialchars($instanceAktualniStranky->getObsah());
        ?></textarea><br>
        <button name="ulozit" class="btn btn-primary ulozeni">Uložit  <i class="fa-solid fa-floppy-disk"></i></button>
    </form>
    <script src="vendor\tinymce\tinymce\tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: '#obsah',
        license_key: 'gpl|<your-license-key>',
        language: 'cs',
        language_url: '<?php echo dirname($_SERVER["PHP_SELF"])?>/vendor/tweeb/tinymce-i18n/langs/cs.js',
        height: "80vh",
        entity_encoding: "raw",
        verify_html: false,
        content_css: [
            "css/styles.css",
            "css/queries.css",
            "fontawesome/css/all.min.css",
            "fonts",
        ],
        body_id: "obsah",
        plugins: 'advlist anchor autolink charmap code colorpicker contextmenu directionality emoticons fullscreen hr image imagetools insertdatetime link lists nonbreaking noneditable pagebreak paste preview print save searchreplace tabfocus table textcolor textpattern visualchars',
        toolbar1: "insertfile undo redo | styleselect | fontselect | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor",
        toolbar2: "link unlink anchor | fontawesome | image media | responsivefilemanager | preview code",
        external_plugins: {
			'responsivefilemanager': '<?php echo dirname($_SERVER['PHP_SELF']); ?>/vendor/primakurzy/responsivefilemanager/tinymce/plugins/responsivefilemanager/plugin.min.js',
			'filemanager': '<?php echo dirname($_SERVER['PHP_SELF']); ?>/vendor/primakurzy/responsivefilemanager/tinymce/plugins/filemanager/plugin.min.js',
		},
		external_filemanager_path: "<?php echo dirname($_SERVER['PHP_SELF']); ?>/vendor/primakurzy/responsivefilemanager/filemanager/",
		filemanager_title: "File manager",
      });
    </script>
        <?php endif ?>
    <?php endif ?>
    </div>

<script src="js/admin.js"></script>    
</body>
</html>