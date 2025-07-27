<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Formulaire</title>
  <style>
    .erreur { color:red;}
  </style>
</head>

<body>

<?php
echo "<hr><h3>INFORMATIONS</h3>";
echo "<pre><code>";
echo "Méthode http : " . $_SERVER['REQUEST_METHOD'] . PHP_EOL;
echo "Méthode uri : " . $_SERVER['REQUEST_URI'] . PHP_EOL;
echo "</code></pre>";
// AFFICHE DU CONTENU DE LA VARIABLE $_GET
echo "<hr><h3>VARIABLE \$_GET</h3>";
highlight_string(
    '<?php ' . PHP_EOL  . PHP_EOL .
    '  $_GET = ' .
    var_export( $_GET,true)
    . ';'
);


// AFFICHE DU CONTENU DE LA VARIABLE $_POST
echo "<hr><h3>VARIABLE \$_POST</h3>";
highlight_string(
    '<?php ' . PHP_EOL  . PHP_EOL .
    '  $_POST = ' .
    var_export( $_POST,true)
    . ';'
);
echo "<hr>";
?>

<?php
function verifierSaisie() {
    global $afficherFormulaire;
    $erreur = '';

    // vérfication longueur pseudo entre 6 et 20 caractères
    $pseudo = trim($_POST['pseudo'] ?? '');
    if(strlen($pseudo) < 6):
        $erreur = 'pseudo trop court';
    elseif(strlen($pseudo) > 20):
        $erreur = 'pseudo trop long';
    endif;

    // vérfication mot de passe
    $p1 = trim($_POST['p1'] ?? '');
    if(strlen($p1) < 12):
        $erreur = 'mot de passe trop court';
    elseif(strlen($p1) > 50):
        $erreur = 'mot de passe trop long';
    endif;
    if(!isset($_POST['p2']) || $_POST['p1'] !== $_POST['p2']):
        $erreur = 'les mots de passe ne correspondent pas';
    endif;

    // vérification OS
    // isset    : vérifie qu'une valeur est bien sélectionnée
    // in_array : vérifie que la valeur correspond
    if(!isset($_POST['OS']) || !in_array($_POST['OS'],["XP","Vista", "OSX", "Linux", "Autre"])):
        $erreur = 'valeur OS incorrecte';
    endif;

    // vérification appareil
    if(!isset($_POST['port']) && !isset($_POST['bureau']) && !isset($_POST['netb']) && !isset($_POST['tabl'])):
        $erreur = "vous devez sélectionner au moins un appareil";
    endif;

    // vérification profession
    $profession = intval($_POST['profession'] ?? 0);
    if(!isset($_POST['profession'])):
        $erreur = "vous devez sélectionner une profession";
    elseif($profession < 1 || $profession > 6):
        $erreur = "choix profession incorrect";
    endif;

    // affichage de l'erreur
    echo "<p class=\"erreur\">$erreur</p>";

    // s'il y a au moins une erreur, afficher le formulaire
    $afficherFormulaire = strlen($erreur) > 0;
}

function traiterDonnees() {
    $pseudo = trim($_POST['pseudo']);
    $mdp = trim($_POST['p1']);
    echo "Pseudo saisi : $pseudo<br>";
    echo "Mot de passe haché (sha256) : " . hash('sha256', $mdp) . "<br>";
}

?>

<?php

$afficherFormulaire = true;
if($_SERVER['REQUEST_METHOD'] == 'POST'):
    $afficherFormulaire = false;
    verifierSaisie();
    $donneesOk = !$afficherFormulaire;
    if($donneesOk):
        traiterDonnees();
    endif;

elseif($_SERVER['REQUEST_METHOD'] == 'GET'):
    $afficherFormulaire = true;
endif;
?>





<?php if($afficherFormulaire): ?>
  <!-- AFFICHAGE DU FORMULAIRE -->
  <form method="post" action="formulaire.php">
    Votre pseudo : <input type="text" size="12" name="pseudo">
    <br>
    Votre mot de passe :
    <input type="password" name="p1">
    <br>
    Ressaisir votre mot de passe : <input type="password" name="p2">
    <br>
    <br>OS préféré :
    <input type="radio" name="OS" value="XP">Windows XP
    <br><input type="radio" name="OS" value="Vista">Windows Vista
    <br><input type="radio" name="OS" value="OSX">MacOS X
    <br><input type="radio" name="OS" value="Linux">Linux
    <br><input type="radio" name="OS" value="Autre">Autre
    <br>Vous possédez : <input type="checkbox" name="bureau" value="1">Un ordinateur de bureau
    <br><input type="checkbox" name="port" value="1">Un portable
    <br><input type="checkbox" name="netb" value="1">Un netbook
    <br><input type="checkbox" name="tabl" value="1">Une tablette
    <br>Votre profession :
    <select name="profession" size="6">
      <option value="1">Chômeur</option>
      <option value="2">Etudiant</option>
      <option value="3">Fonctionnaire</option>
      <option value="4">Privé</option>
      <option value="5">Retraité</option>
      <option value="6">Autre</option>
    </select>
    <br>
    <input type="submit" value="S'inscrire">
  </form>

<?php endif; ?>
</body>

</html>