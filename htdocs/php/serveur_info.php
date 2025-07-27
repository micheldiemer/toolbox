<pre><code>
<?php
// INFORMATIONS SERVEUR UTILES
echo "\$_SERVER['REQUEST_METHOD'] permet de récupérer la méthode http " . PHP_EOL;
echo "\$_SERVER['REQUEST_URI'] permet de récupérer l’uri " . PHP_EOL;

echo '<hr>';
echo "Méthode http : " . $_SERVER['REQUEST_METHOD'] . PHP_EOL;
echo "Méthode uri : " . $_SERVER['REQUEST_URI'] . PHP_EOL;
?>
<!-- PAGE BLANCHE ARTIFICUELLE -->
<div style="height: 100vh"></div>
<?php
// AFFICHE DU CONTENU DE LA VARIABLE $_SERVER
highlight_string(
    '<?php ' . PHP_EOL  . PHP_EOL .
    ' $_SERVER = ' .
    var_export($_SERVER,true)
    . ';'
);

?>
</pre></code>