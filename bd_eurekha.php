
<?php
$bd_ev = "eventos"; /* nome do banco */
$user_ev = "eventos45"; /* nome do usuário */
$pass_ev = "e1952$#!!"; /* senha do usuário */
//$host_ev = "efolia45.cluster-c5kb5g3oksul.us-east-1.rds.amazonaws.com"; /* host do bd */
//$host_ev = "efoliatemp80-cluster.cluster-c5kb5g3oksul.us-east-1.rds.amazonaws.com";
$host_ev = "efolia25-cluster.cluster-c5kb5g3oksul.us-east-1.rds.amazonaws.com";
@$con_evei = mysqli_connect("$host_ev", "$user_ev", "$pass_ev", "$bd_ev") or die('Erro - Falha na Conexão vendas');
mysqli_set_charset($con_evei, "utf8mb4");
?>
