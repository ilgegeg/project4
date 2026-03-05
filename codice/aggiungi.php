<?php

require "carica.php";

$codCategoriaTot = $pdo->query("SELECT codCategoria, nomeCategoria FROM categoria")->fetchAll();
$codProdottoTot = $pdo->query("SELECT codProdotto, nomeProdotto FROM prodotto")->fetchAll();

if(isset($_GET["categoria"]) && $_GET["categoria"]==1){
    $nomeCategoria = $_POST["nomeCategoria"];
    $pdo->exec("INSERT INTO categoria (nomeCategoria) VALUES ('$nomeCategoria')");
    $_GET["categoria"]=0;
}

if(isset($_GET["prodotto"]) && $_GET["prodotto"]==1){
    $nomeProdotto = $_POST["nomeProdotto"];
    $prezzo = $_POST["prezzoProdotto"];
    $codCategoria = $_POST["codCategoriaProdotto"];
    $pdo->exec("INSERT INTO prodotto (nomeProdotto, prezzo, codCategoria) VALUES ('$nomeProdotto', '$prezzo', '$codCategoria')");
    $_GET["prodotto"]=0;
}

if(isset($_GET["vendita"]) && $_GET["vendita"]==1){
    $codProdotto = $_POST["codProdottoVendita"];
    $dataVendita = $_POST["dataVendita"];
    $quantita = $_POST["quantitaVendita"];
    $pdo->exec("INSERT INTO vendita (codProdotto, dataVendita, quantita) VALUES ('$codProdotto', '$dataVendita', '$quantita')");
    $_GET["vendita"]=0;
}

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi Dati Retail</title>
</head>
<body>

    <h1>Aggiungi Categoria</h1>
    <form action="aggiungi.php?categoria=1" method="post">
        Inserisci nome categoria (es. Abbigliamento, Elettronica)
        <input type="text" name="nomeCategoria" required><br><br>
        <button type="submit">INVIA</button><br><br>
    </form><br><br>

    <h1>Aggiungi Prodotto</h1>
    <form action="aggiungi.php?prodotto=1" method="post">
        Inserisci nome prodotto
        <input type="text" name="nomeProdotto" required><br><br>
        Inserisci prezzo base
        <input type="number" step="0.01" name="prezzoProdotto" required><br><br>
        Seleziona categoria di appartenenza
        <select name="codCategoriaProdotto" required>
            <?php foreach($codCategoriaTot as $cat): ?>
                <option value="<?php echo $cat[0] ?>"><?php echo $cat[1] ?></option>
            <?php endforeach; ?>
        </select><br><br>
        <button type="submit">INVIA</button><br><br>
    </form><br><br>

    <h1>Aggiungi Vendita (Record storico)</h1>
    <form action="aggiungi.php?vendita=1" method="post">
        Seleziona prodotto venduto
        <select name="codProdottoVendita" required>
            <?php foreach($codProdottoTot as $prod): ?>
                <option value="<?php echo $prod[0] ?>"><?php echo $prod[1] ?></option>
            <?php endforeach; ?>
        </select><br><br>
        Inserisci data vendita
        <input type="date" name="dataVendita" required><br><br>
        Inserisci quantità venduta
        <input type="number" name="quantitaVendita" required><br><br>
        <button type="submit">INVIA</button><br><br>
    </form><br><br>

</body>
</html>