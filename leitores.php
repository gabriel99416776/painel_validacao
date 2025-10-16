<?php
include('conexao.php');
$sql_portarias = "SELECT id FROM `ac_portarias`";
$res_portarias = mysqli_query($con_apca, $sql_portarias);
$tot_portarias = mysqli_num_rows($res_portarias);
?>



<!doctype html>
<html lang="pt-br">

<head>
    <link rel="icon" href="img/logo-guia.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Leitores</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="leitores.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <?php
    include('header.php')
    ?>
    <section>

        <?php
        include('topo.php');
        ?>

        <?php
        $sql_l = "SELECT * FROM `ac_leitores`";
        $res_l = mysqli_query($con_apca, $sql_l);
        $tot_l = mysqli_num_rows($res_l);
        ?>

        <div class="container leitores-custom">
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="" id="selectAllCheckbox">
                <label class="form-check-label" for="selectAllCheckbox">Selecionar Todos</label>
                <button class="btn btn-primary botaoportaria" onclick="pegardados()">Pegar Portaria do Evento</button>
            </div>
            <ul class="list-group">
                <?php
                while ($row_l = mysqli_fetch_array($res_l)) {
                    $ip = $row_l['ip']; // define o IP do leitor atual
                    $url = "http://$ip/cgi-bin/FaceInfoManager.cgi?action=startFind";

                ?>

                    <li class="list-group-item d-flex justify-content-between flex-row">
                        <div class="status-container" id="status-<?php echo $row_l['ip']; ?>"></div>
                        <input class="form-check-input me-1 itemCheckbox" type="checkbox" value="<?php echo $row_l['id']; ?>" id="checkbox-<?php echo $row_l['id']; ?>">
                        <label class="form-check-label" for="checkbox-<?php echo $row_l['id']; ?>">ID: <?php echo $row_l['id']; ?> - <?php echo $row_l['nome']; ?> - IP <?php echo $row_l['ip']; ?> </label>
                        <div class="button-group">
                            <button class="btn btn-primary" onclick="limparleitor('<?php echo $row_l['ip']; ?>');">Limpar Leitor</button>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="editarLeitor('<?php echo $row_l['id']; ?>', '<?php echo $row_l['ip']; ?>')">Editar IP</button>
                            <a href="javascript:void(0);" onclick="mostrarInfo('<?php echo $row_l['ip']; ?>', '<?php echo $row_l['portaria']; ?>', '<?php echo $row_l['nome']; ?>')"><i class="bi bi-info-square"></i></a>
                        </div>
   

                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Ações
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <a class="dropdown-item" href="javascript:limparleitor('<?php echo $row_l['ip']; ?>');">Limpar Leitor</a>
                                <a class="dropdown-item " href="#" onclick="editarLeitor()">Editar</a>
                            </div>
                        </div>
                    </li>
                <?php
                }
                ?>
            </ul>

            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#adicionarLeitorModal">
                Adicionar Leitor
            </button>


            <button type="button" class="btn btn-primary button-editar" data-bs-toggle="modal" data-bs-target="#editPortariasModal">Editar Portarias</button>


        </div>

        <!-----------------------------MODAL DO EDITAR PORTARIAS----------------------->

        <div class="modal fade" id="editPortariasModal" tabindex="-1" aria-labelledby="editPortariasModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPortariasModalLabel">Editar Portarias</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="newPortaria">Nova Portaria:</label>
                        <input type="text" id="newPortaria" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary" onclick="editarPortarias()">Salvar</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal ADICIONAR LEITOR -->
        <div class="modal fade" id="adicionarLeitorModal" tabindex="-1" aria-labelledby="adicionarLeitorModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="adicionarLeitorModalLabel">Adicionar Leitor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>

                    <form id="formAdicionarLeitor">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="leitorId" class="form-label">ID:</label>
                                <input type="text" name="id" id="leitorId" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="leitorNome" class="form-label">Nome:</label>
                                <input type="text" name="nome" id="leitorNome" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="leitorIp" class="form-label">IP:</label>
                                <input type="text" name="ip" id="leitorIp" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="leitorPortaria" class="form-label">Portaria:</label>
                                <input type="text" name="portaria" id="leitorPortaria" class="form-control" required>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>


        <!-- Modal INFORMAÇÕES DO LEITOR-->
        <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="infoModalLabel">Informações do Leitor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>IP do Leitor:</strong> <span id="leitorIp"></span></p>
                        <p><strong>Portaria do Leitor:</strong> <span id="leitorPortaria"></span></p>
                        <p><strong>Nome do Leitor:</strong> <span id="leitorNome"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>

    </section>



    <?php
    include('scripts.php');
    ?>



    <script>
        document.getElementById('selectAllCheckbox').addEventListener('change', function() {
            var checkboxes = document.querySelectorAll('.itemCheckbox');
            for (var checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
        });



        var limparleitor = function(i_ip) {

            $.post('limpaleitor.php', {
                qip: i_ip
            }, function(result) {
                alert(result);
            });

        }

        function pegardados() {
            $.post('pegarportaria.php', function(result) {
                alert(result);
            }).fail(function() {
                alert("Erro ao executar a portaria.");
            });
        }


        var editarLeitor = function(id, currentIp) {
            var novoIp = prompt('Trocar IP', currentIp);
            if (novoIp) {
                $.post('editar_leitor.php', {
                    id: id,
                    ip: novoIp
                }, function(result) {
                    alert(result);
                    location.reload();
                });
            }
        }


        function mostrarInfo(ip, portaria, nome) {
            document.getElementById('leitorIp').innerText = ip;
            document.getElementById('leitorPortaria').innerText = portaria;
            document.getElementById('leitorNome').innerText = nome;
            var infoModal = new bootstrap.Modal(document.getElementById('infoModal'), {});
            infoModal.show();
        }



        function editarPortarias() {
            var selectedIds = [];
            document.querySelectorAll('.itemCheckbox:checked').forEach(function(checkbox) {
                selectedIds.push(checkbox.value);
            });

            var newPortaria = document.getElementById('newPortaria').value;

            if (selectedIds.length > 0 && newPortaria) {
                $.post('editar_portaria.php', {
                    ids: selectedIds,
                    portaria: newPortaria
                }, function(result) {
                    alert(result);
                    location.reload();
                });
            } else {
                alert("Selecione algum leitor para inserir uma portaria");
            }
        }

        document.getElementById("formAdicionarLeitor").addEventListener("submit", function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch("adicionarleitor.php", {
                    method: "POST",
                    body: formData
                })
                .then(res => res.text())
                .then(data => {
                    if (data.trim() === "success") {
                        alert("Leitor adicionado com sucesso!");
                        var modal = bootstrap.Modal.getInstance(document.getElementById('adicionarLeitorModal'));
                        modal.hide();
                        this.reset();
                        location.reload();
                    } else {
                        alert("Erro ao adicionar leitor: " + data);
                    }
                });
        });
    </script>


</body>

</html>