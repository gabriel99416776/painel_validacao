<?php
// executar_portaria.php

// Caminho para o script que você quer executar
$script_path = 'C:\xampp\htdocs\ap_controleacesso\getdados\ev_portaria.php';

// Verifique se o arquivo existe
if (file_exists($script_path)) {
    // Execute o script
    include($script_path);
    echo "Portaria executada com sucesso";
} else {
    echo "Erro: Arquivo não encontrado.";
}
?>