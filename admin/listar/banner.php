<?php
    if (!isset($pagina)) exit;
?>

<div class="card shadow">

    <div class="card-header">

        <div class="float-start">
            <h2>Listagem de Banner</h2>
        </div>

        <div class="float-end">
            <a href="cadastrar/banner" class="btn btn-success">
                Novo Registro
            </a>

            <a href="listar/banner" class="btn btn-info">
                Listar
            </a>
        </div>

        <div class="clearfix"></div>

    </div>

    <div class="card-body">

        <table class="table table-striped table-bordered align-middle">

            <thead>
                <tr>
                    <td>ID</td>
                    <td>Descrição</td>
                    <td>Banner</td>
                    <td>Ativo</td>
                    <td>Opções</td>
                </tr>
            </thead>

            <tbody>

                <?php

                    $sql = "select * from banner order by id desc";

                    $consulta = $pdo->prepare($sql);

                    $consulta->execute();

                    while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {

                ?>

                    <tr>

                        <td>
                            <?= $dados->id ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($dados->descricao) ?>
                        </td>

                        <td>

                            <img
                                src="../arquivos/<?= htmlspecialchars($dados->banner) ?>"
                                alt="<?= htmlspecialchars($dados->descricao) ?>"
                                style="width: 180px; height: 70px; object-fit: cover;"
                                class="rounded shadow-sm"
                            >

                        </td>

                        <td>
                            <?= ($dados->ativo == "S") ? "Sim" : "Não" ?>
                        </td>

                        <td>

                            <a
                                href="cadastrar/banner/<?= $dados->id ?>"
                                class="btn btn-info btn-sm"
                            >
                                Editar
                            </a>

                            <a
                                href="javascript:excluir(<?= $dados->id ?>)"
                                class="btn btn-danger btn-sm"
                            >
                                Excluir
                            </a>

                        </td>

                    </tr>

                <?php

                    }

                ?>

            </tbody>

        </table>

    </div>

</div>

<script>

function excluir(id) {

    if (confirm("Deseja mesmo excluir?")) {

        location.href = "excluir/banner/" + id;

    }

}

</script>