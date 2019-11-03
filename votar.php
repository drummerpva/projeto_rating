<?php
try {
    $pdo = new PDO("mysql:dbname=projeto_rating;host=localhost", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    die("Erro: " . $ex->getMessage());
}
if(!empty($_GET['id']) && !empty($_GET['voto'])){
    $id = intval(addslashes($_GET['id']));
    $voto = intval(addslashes($_GET['voto']));
    if($voto > 0 || $voto <=5){
        $sql = $pdo->prepare("INSERT INTO votos SET id_filme = ?, nota = ?");
        $sql->execute(array($id,$voto));
        if($pdo->lastInsertId()>0){
            $sql = $pdo->prepare("UPDATE filmes SET media = (SELECT (SUM(nota)/COUNT(1)) FROM votos WHERE votos.id_filme = filmes.id) WHERE id = ?");
            $sql->execute(array($id));
        }
    }
    header("Location: ./");
}