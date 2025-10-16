<?php
header('Content-Type: text/plain; charset=UTF-8');

$path_base = 'c:/xampp/htdocs/';
include($path_base.'ap_controleacesso/bd.php');

$sql = "
  SELECT id, nome, ip, device_1, device_2
  FROM ac_leitores
  WHERE
    ( NULLIF(TRIM(device_1),'') IS NULL
      OR LOWER(TRIM(device_1)) IN ('notfound','n/a','na','none','0')
    )
    OR
    ( NULLIF(TRIM(device_2),'') IS NULL
      OR LOWER(TRIM(device_2)) IN ('notfound','n/a','na','none','0')
    )
";

$res = mysqli_query($con_ac, $sql);
if (!$res) { http_response_code(500); echo 'erro|falha_consulta'; exit; }

$faltando = [];
while ($r = mysqli_fetch_assoc($res)) {
  $d1 = trim((string)$r['device_1']);
  $d2 = trim((string)$r['device_2']);
  $faltando[] = "ID {$r['id']} ({$r['ip']}) d1=\"{$d1}\" d2=\"{$d2}\"";
}

if ($faltando) {
  echo 'erro|' . implode(' ; ', $faltando);
} else {
  echo 'ok';
}
exit;
