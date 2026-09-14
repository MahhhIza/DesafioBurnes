<?php
    if (!isset($pagina)) exit;

    // verificar se foi informado um ID
    if (empty($id)) {

        mensagem(
            "Erro",
            "Banner não encontrado",
            "error"
        );

        exit;
    }

    // buscar o banner
    $sql = "select * from banner where id = :id limit 1";

    $consulta = $pdo->prepare($sql);

    $consulta->bindParam(":id", $id);

    $consulta->execute();

    $dados = $consulta->fetch(PDO::FETCH_OBJ);

    // verificar se encontrou
    if (!$dados) {

        mensagem(
            "Erro",
            "Banner não encontrado",
            "error"
        );

        exit;
    }

    // excluir o registro
    $sql = "delete from banner where id = :id limit 1";

    $consulta = $pdo->prepare($sql);

    $consulta->bindParam(":id", $id);

    // executar
    if ($consulta->execute()) {

        // excluir também a imagem do servidor
        if (!empty($dados->banner)) {

            $arquivo = "../arquivos/{$dados->banner}";

            if (file_exists($arquivo)) {
                unlink($arquivo);
            }
        }

        mensagem(
            "Sucesso!",
            "Banner excluído",
            "success"
        );

    } else {

        mensagem(
            "Erro",
            "Erro ao excluir banner",
            "error"
        );
    }
?>