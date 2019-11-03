<?php

try {
    $pdo = new PDO("mysql:dbname=projeto_rating;host=localhost", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    die("Erro: " . $ex->getMessage());
}
$sql = $pdo->query("SELECT * FROM filmes");
if ($sql->rowCount() > 0) {
    foreach ($sql->fetchAll() as $filme) {
    ?>
<fieldset>
    <b><?php echo $filme['titulo'];?></b><br>
    <a href="votar.php?id=<?php echo $filme['id'];?>&voto=1"><img src="star.png" height="20"/></a> 
    <a href="votar.php?id=<?php echo $filme['id'];?>&voto=2"><img src="star.png" height="20"/></a> 
    <a href="votar.php?id=<?php echo $filme['id'];?>&voto=3"><img src="star.png" height="20"/></a> 
    <a href="votar.php?id=<?php echo $filme['id'];?>&voto=4"><img src="star.png" height="20"/></a> 
    <a href="votar.php?id=<?php echo $filme['id'];?>&voto=5"><img src="star.png" height="20"/></a> 
    (<?php echo number_format($filme['media'],2,",","");?>)
</fieldset>
    <?php

    }
} else {
    echo "Não há filmes cadastrados!";
}
