<?php

require "db.php";

$pdo->exec("CREATE TABLE IF NOT EXISTS categoria(
    codCategoria INTEGER AUTO_INCREMENT PRIMARY KEY,
    nomeCategoria VARCHAR(50) NOT NULL
)");

$pdo->exec("CREATE TABLE IF NOT EXISTS prodotto(
    codProdotto INTEGER AUTO_INCREMENT PRIMARY KEY,
    nomeProdotto VARCHAR(50) NOT NULL,
    prezzo FLOAT NOT NULL,
    codCategoria INTEGER NOT NULL, 
    FOREIGN KEY (codCategoria) REFERENCES categoria(codCategoria)
)");

$pdo->exec("CREATE TABLE IF NOT EXISTS vendita(
    idVendita INTEGER AUTO_INCREMENT PRIMARY KEY,
    codProdotto INTEGER NOT NULL, 
    dataVendita DATE NOT NULL, 
    quantita INTEGER NOT NULL, 
    FOREIGN KEY (codProdotto) REFERENCES prodotto(codProdotto)
)");

?>