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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
                        <!-- <div class="status-container" id="status-<?php echo $row_l['ip']; ?>"></div> -->
                        <input class="form-check-input me-1 itemCheckbox" type="checkbox"
                            value="<?php echo $row_l['id']; ?>" id="checkbox-<?php echo $row_l['id']; ?>">
                        <label class="form-check-label" for="checkbox-<?php echo $row_l['id']; ?>">ID:
                            <?php echo $row_l['id']; ?> - <?php echo $row_l['nome']; ?> - IP <?php echo $row_l['ip']; ?>
                        </label>
                        <div class="button-group">
                            <button class="btn btn-primary" onclick="limparleitor('<?php echo $row_l['ip']; ?>');">Limpar
                                Leitor</button>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal"
                                onclick="editarLeitor('<?php echo $row_l['id']; ?>', '<?php echo $row_l['ip']; ?>')">Editar
                                IP</button>
                            <a href="javascript:void(0);"
                                onclick="mostrarInfo('<?php echo $row_l['ip']; ?>', '<?php echo $row_l['portaria']; ?>', '<?php echo $row_l['nome']; ?>')"><i
                                    class="bi bi-info-square"></i></a>
                        </div>


                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Ações
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <a class="dropdown-item"
                                    href="javascript:limparleitor('<?php echo $row_l['ip']; ?>');">Limpar Leitor</a>
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


            <button type="button" class="btn btn-primary button-editar" data-bs-toggle="modal"
                data-bs-target="#editPortariasModal">Editar Portarias</button>


        </div>

        <!-----------------------------MODAL DO EDITAR PORTARIAS----------------------->

        <div class="modal fade" id="editPortariasModal" tabindex="-1" aria-labelledby="editPortariasModalLabel"
            aria-hidden="true">
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
        <div class="modal fade" id="adicionarLeitorModal" tabindex="-1" aria-labelledby="adicionarLeitorModalLabel"
            aria-hidden="true">
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
    $sql_l = "SELECT * FROM `ac_leitores`";
    $res_l = mysqli_query($con_apca, $sql_l);
    $tot_l = mysqli_num_rows($res_l);


    ?>


    <table class="table" style="width: 70%; margin: auto">
        <thead>
            <tr style="text-align: center;">
                <th>
                    <input type="checkbox" id="checkAll" class="cb-custom">
                </th>


                <th scope="col">
                    <i class="bi bi-gear"></i>
                </th>

                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">IP</th>
                <th scope="col">Portaria</th>
                <th scope="col">Limpar Leitor</th>
                <th scope="col">STATUS</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
            while ($row_l = mysqli_fetch_array($res_l)) {
                $ip = $row_l['ip']; // define o IP do leitor atual
                $url = "http://$ip/cgi-bin/FaceInfoManager.cgi?action=startFind";
            ?>
                <tr class="leitor-row" data-ip="<?= $row_l['ip'] ?>" style="text-align: center;">
                    <td>
                        <input type="checkbox" class="cb-custom checkLeitor" value="<?= $row_l['id'] ?>">
                    </td>

                    <td>
                        <button class="btn btn-light btn-sm border" onclick="abrirModalEditar(<?= $row_l['id'] ?>)">

                            <i class="bi bi-pencil-fill"></i>
                        </button>
                        <button
                            class="btn btn-danger btn-sm ms-1"
                            onclick="abrirModalExcluir(<?= $row_l['id'] ?>)">
                            <i class="bi bi-trash-fill"></i>
                        </button>

                    </td>
                    <td><?php echo $row_l['id']; ?></td>
                    <td><?php echo $row_l['nome']; ?></td>
                    <td><?php echo $row_l['ip']; ?></td>
                    <td><?php echo $row_l['portaria']; ?></td>
                    <td>
                        <button class="botao-limpar-tabela" onclick="limparleitor('<?php echo $row_l['ip']; ?>');">
                            🧹 Limpar Leitor
                        </button>
                    </td>
                    <td>
                        <div class="status-container" id="status-<?= $row_l['ip'] ?>"></div>

                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>


    <div class="modal fade" id="modalExcluir" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title text-danger">
                        <i class="bi bi-exclamation-triangle"></i> Excluir Leitor
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body text-center">
                    <p>Digite a senha para confirmar:</p>

                    <input
                        type="password"
                        id="senhaExcluir"
                        class="form-control text-center"
                        placeholder="Senha">

                    <input type="hidden" id="leitorExcluirId">

                    <div id="erroSenha" class="text-danger mt-2 d-none">
                        Senha incorreta
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-danger" onclick="confirmarExclusao()">
                        Confirmar
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- ============ EDITAR MODAL ================= -->
    <div class="modal fade" id="modalEditar" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title text-info">
                        <i class="bi bi-pencil-fill"></i> Editar Leitor
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="editarId">

                    <div class="mb-2">
                        <label>Nome</label>
                        <input type="text" id="editarNome" class="form-control">
                    </div>

                    <div class="mb-2">
                        <label>IP</label>
                        <input type="text" id="editarIp" class="form-control">
                    </div>

                    <div class="mb-2">
                        <label>Portaria</label>
                        <input type="text" id="editarPortaria" class="form-control">
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-info" onclick="salvarEdicao()">
                        Salvar
                    </button>
                </div>

            </div>
        </div>
    </div>




    <?php
    include('scripts.php');
    ?>



    <script>
        let modalEditar = new bootstrap.Modal(document.getElementById('modalEditar'));

        function abrirModalEditar(id) {
            fetch(`buscar_leitor.php?id=${id}`)
                .then(r => r.json())
                .then(dados => {
                    document.getElementById('editarId').value = dados.id;
                    document.getElementById('editarNome').value = dados.nome;
                    document.getElementById('editarIp').value = dados.ip;
                    document.getElementById('editarPortaria').value = dados.portaria;
                    modalEditar.show();
                });
        }

        function salvarEdicao() {
            let id = editarId.value;
            let nome = editarNome.value;
            let ip = editarIp.value;
            let portaria = editarPortaria.value;

            fetch('editar_leitorv2.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `id=${id}&nome=${nome}&ip=${ip}&portaria=${portaria}`
                })
                .then(r => r.text())
                .then(resp => {
                    if (resp === 'OK') {
                        location.reload();
                    } else {
                        alert('Erro ao editar leitor');
                    }
                });
        }


        let modalExcluir = new bootstrap.Modal(document.getElementById('modalExcluir'));

        function abrirModalExcluir(id) {
            document.getElementById('leitorExcluirId').value = id;
            document.getElementById('senhaExcluir').value = '';
            document.getElementById('erroSenha').classList.add('d-none');
            modalExcluir.show();
        }

        function confirmarExclusao() {
            let senha = document.getElementById('senhaExcluir').value;
            let id = document.getElementById('leitorExcluirId').value;

            fetch('excluir_leitor.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `id=${id}&senha=${senha}`
                })
                .then(resp => resp.text())
                .then(resp => {
                    if (resp.trim() === 'OK') {
                        location.reload();
                    } else if (resp === 'SENHA_INCORRETA') {
                        document.getElementById('erroSenha').classList.remove('d-none');
                    } else {
                        alert('Erro ao excluir leitor');
                    }
                });

        }


        document.getElementById('checkAll').addEventListener('change', function() {
            document.querySelectorAll('.checkLeitor').forEach(cb => {
                cb.checked = this.checked;
            });
        });

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
                        var modal = bootstrap.Modal.getInstance(document.getElementById(
                            'adicionarLeitorModal'));
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