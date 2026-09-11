<?php

    if (!isset($pagina)) exit;

    // buscar os banners cadastrados
    $sql = "select * from banner
            order by id desc";

    $consulta = $pdo->prepare($sql);

    $consulta->execute();

    $banners = $consulta->fetchAll(PDO::FETCH_OBJ);

?>

<div class="card shadow">

    <div class="card-header">

        <div class="float-start">
            <h2>Lista de Banners</h2>
        </div>

        <div class="float-end">

            <a href="cadastrar/banner" class="btn btn-success">
                Novo Banner
            </a>

        </div>

    </div>

    <div class="card-body">

        <?php if (empty($banners)) { ?>

            <div class="alert alert-info">
                Nenhum banner cadastrado.
            </div>

        <?php } else { ?>

            <div class="table-responsive">

                <table class="table table-striped table-hover align-middle">

                    <thead>

                        <tr>
                            <th>ID</th>
                            <th>Imagem</th>
                            <th>Descrição</th>
                            <th>Ativo</th>
                            <th>Ações</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($banners as $dados) { ?>

                            <tr>

                                <td>
                                    <?= $dados->id ?>
                                </td>

                                <td>

                                    <img
                                        src="../arquivos/<?= htmlspecialchars($dados->banner) ?>"
                                        alt="<?= htmlspecialchars($dados->descricao) ?>"
                                        style="width: 200px; height: 80px; object-fit: cover;"
                                        class="img-thumbnail"
                                    >

                                </td>

                                <td>
                                    <?= htmlspecialchars($dados->descricao) ?>
                                </td>

                                <td>

                                    <?php if ($dados->ativo == "S") { ?>

                                        <span class="badge bg-success">
                                            Sim
                                        </span>

                                    <?php } else { ?>

                                        <span class="badge bg-secondary">
                                            Não
                                        </span>

                                    <?php } ?>

                                </td>

                                <td>

                                    <a
                                        href="cadastrar/banner/<?= $dados->id ?>"
                                        class="btn btn-primary btn-sm">
                                        Editar
                                    </a>

                                    <a
                                        href="excluir/banner/<?= $dados->id ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Deseja realmente excluir este banner?');">
                                        Excluir
                                    </a>

                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        <?php } ?>

    </div>

</div>