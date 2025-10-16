<?php
$pdo = new PDO("mysql:host=localhost;dbname=ap_controleacesso", "root", "");

$id       = $_POST['id'] ?? '';
$nome     = $_POST['nome'] ?? '';
$ip       = $_POST['ip'] ?? '';
$portaria = $_POST['portaria'] ?? '';
$evento          = 1;
$u_idusers       = 0;
$tstamp_uacesso  = 0;
$exec_uacesso    = 0;
$ativo           = 'sim';

$stmt = $pdo->prepare("INSERT INTO ac_leitores 
    (id, nome, ip, portaria, evento, u_idusers, tstamp_uacesso, exec_uacesso, ativo)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
");
$stmt->execute([
    $id,
    $nome,
    $ip,
    $portaria,
    $evento,
    $u_idusers,
    $tstamp_uacesso,
    $exec_uacesso,
    $ativo
]);

echo "success";
?>
