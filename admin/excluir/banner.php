<?php
    if (!isset($pagina)) exit;

    if (!empty($id)) {

        // Busca o nome da imagem antes de excluir
        $sql = "select banner from banner where id = :id limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id", $id);
        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        // Exclui o registro do banco
        $sql = "delete from banner where id = :id limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id", $id);

        if ($consulta->execute()) {

            // Exclui a imagem do servidor
            if (!empty($dados->banner)) {
                $arquivo = "../arquivos/{$dados->banner}";

                if (file_exists($arquivo)) {
                    unlink($arquivo);
                }
            }

            mensagem("Sucesso!", "Banner excluído", "success");

        } else {
            mensagem("Erro", "Erro ao excluir o banner", "error");
        }

    } else {
        mensagem("Erro", "Banner não encontrado", "error");
    }
?>