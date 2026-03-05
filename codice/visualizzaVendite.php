<?php

require "carica.php";

$vendite = [];
$vendite = $pdo->query("SELECT * FROM vendita JOIN prodotto ON vendita.codProdotto = prodotto.codProdotto ORDER BY dataVendita DESC")->fetchAll();

if(isset($_GET["elimina"]) && $_GET["elimina"]==1){
    $id = $_POST['venditaEliminare'];
    $pdo->exec("DELETE FROM vendita WHERE idVendita=$id");
    header("Location: visualizzaVendite.php");
}

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizza Storico Vendite</title>
    <style>
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h1>Storico Vendite Registrate</h1>

    <table>
        <tr>
            <th>ID Vendita</th>
            <th>Nome Prodotto</th>
            <th>Data Vendita</th>
            <th>Quantità</th>
            <th>Ricavo Totale (Prezzo x Q.tà)</th>
        </tr>
        <?php foreach($vendite as $v): ?>
            <tr>
                <td><?php echo $v['idVendita'] ?></td>
                <td><?php echo $v['nomeProdotto'] ?></td>
                <td><?php echo $v['dataVendita'] ?></td>
                <td><?php echo $v['quantita'] ?></td>
                <td><?php echo number_format($v['prezzo'] * $v['quantita'], 2) ?> €</td>
            </tr>
        <?php endforeach; ?>
    </table><br><br><br>

    <h1>Elimina Record Vendita</h1>
    <form action="visualizzaVendite.php?elimina=1" method="post">
        ID Vendita da eliminare:
        <select name="venditaEliminare">
            <?php foreach($vendite as $v): ?>
                <option value="<?php echo $v['idVendita'] ?>"><?php echo "ID: " . $v['idVendita'] . " - " . $v['nomeProdotto'] . " (" . $v['dataVendita'] . ")" ?></option>
            <?php endforeach; ?>
        </select><br><br>
        <button type="submit">ELIMINA</button>
    </form>
</body>
</html>