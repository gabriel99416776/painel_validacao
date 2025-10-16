        <?php
        while ($row_l = mysqli_fetch_array($res_l)) {

            $ip = $row_l['ip']; // define o IP do leitor atual
            $url = "http://$ip/cgi-bin/FaceInfoManager.cgi?action=startFind";

            // Fazendo a requisição
            $resposta = @file_get_contents($url); // @ para suprimir warnings temporariamente

            if ($resposta !== false) {
                $dados = json_decode($resposta, true);
                echo "<pre>";
                print_r($dados);
                echo "</pre>";
            } else {
                echo "Não foi possível conectar ao leitor $ip<br>";
            }
        }
        ?>