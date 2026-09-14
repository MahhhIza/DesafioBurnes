<?php
    if (!isset($pagina)) exit;

    if (!empty($id)) {
        // selecionar o banner selecionado
        $sql = "select * from banner where id = :id limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id", $id);
        $consulta->execute();

        $dadosBanner = $consulta->fetch(PDO::FETCH_OBJ);
    }

    $id = $dadosBanner->id ?? NULL;
    $descricao = $dadosBanner->descricao ?? NULL;
    $banner = $dadosBanner->banner ?? NULL;
    $ativo = $dadosBanner->ativo ?? "S";
?>

<div class="card shadow">
    <div class="card-header">
        <div class="float-start">
            <h2>Cadastro de Banner</h2>
        </div>

        <div class="float-end">
            <a href="cadastrar/banner" class="btn btn-success">
                Novo Registro
            </a>

            <a href="listar/banner" class="btn btn-info">
                Listar
            </a>
        </div>
    </div>

    <div class="card-body">

        <form name="formCadastrar"
              method="post"
              action="salvar/banner"
              enctype="multipart/form-data"
              data-parsley-validate>

            <div class="row">

                <div class="col-12 col-md-2">
                    <label for="id">ID:</label>

                    <input type="text"
                           name="id"
                           id="id"
                           class="form-control"
                           readonly
                           value="<?= $id ?>">
                </div>

                <div class="col-12 col-md-10">
                    <label for="descricao">Descrição:</label>

                    <input type="text"
                           name="descricao"
                           id="descricao"
                           class="form-control"
                           maxlength="100"
                           required
                           data-parsley-required-message="Preencha este campo"
                           value="<?= $descricao ?>">
                </div>

            </div>

            <br>

            <div class="row">

                <div class="col-12 col-md-8">
                    <label for="banner">Imagem do Banner:</label>

                    <input type="file"
                           name="banner"
                           id="banner"
                           class="form-control"
                           accept="image/jpeg,image/png">
                </div>

                <div class="col-12 col-md-4">
                    <label for="ativo">Ativo:</label>

                    <select name="ativo"
                            id="ativo"
                            class="form-control"
                            required>

                        <option value="S" <?= ($ativo == "S") ? "selected" : "" ?>>
                            Sim
                        </option>

                        <option value="N" <?= ($ativo == "N") ? "selected" : "" ?>>
                            Não
                        </option>

                    </select>
                </div>

            </div>

            <?php
                if (!empty($banner)) {
                    ?>
                    <div class="mt-3">
                        <p><strong>Imagem atual:</strong></p>

                        <img src="../arquivos/<?= $banner ?>"
                             alt="<?= $descricao ?>"
                             style="max-width: 500px;"
                             class="img-fluid rounded shadow">
                    </div>
                    <?php
                }
            ?>

            <br>

            <button type="submit" class="btn btn-success float-end">
                Salvar Registro
            </button>

        </form>

    </div>
</div>