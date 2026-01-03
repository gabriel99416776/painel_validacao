<?php
include('conexao.php');

function get_ping_time($ip)
{
    $output = [];
    $latencia = null;
    exec("ping -n 1 -w 1000 $ip", $output);

    foreach ($output as $linha) {
        if (preg_match('/tempo[=<](\d+)\s*ms/i', $linha, $matches)) {
            $latencia = intval($matches[1]);
            break;
        }
    }

    return $latencia; 
}

$sql = "SELECT ip FROM ac_leitores";
$result = mysqli_query($con_apca, $sql);

$ips_status = [];

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $ip = $row['ip'];

        $latencia = get_ping_time($ip);
        $status = $latencia !== null ? 'online' : 'offline';

        $ips_status[] = [
            'ip' => $ip,
            'status' => $status,
            'ping' => $latencia !== null ? $latencia . ' ms' : 'Sem Conexão'
        ];
    }
} else {
    echo json_encode(['status' => 'no_ips']);
    exit;
}

header('Content-Type: application/json');
echo json_encode($ips_status);
