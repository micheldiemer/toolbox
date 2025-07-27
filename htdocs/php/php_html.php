<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>PHP et HTML</title>
</head>

<body>

Ceci est du code html

<?php
echo "<br><b>ceci est du code html généré par php</b>";

$uneVariable = 5;
?>
<br>La valeur de la variable $uneVariable est : <?= $uneVariable ?>.

<?php
$uneAutreVariable = 10;
echo "<br>La valeur de la variable \$uneAutreVariable est : $uneAutreVariable";
?>

</body>

</html>