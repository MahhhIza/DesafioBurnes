<?php

    if (!isset($pagina)) exit;

    // verificar se foi dado POST
    if ($_POST) {

        // recuperar as variáveis
        $id = htmlspecialchars(trim($_POST["id"] ?? NULL));
        $descricao = htmlspecialchars(trim($_POST["descricao"] ?? NULL));
        $ativo = htmlspecialchars(trim($_POST["ativo"] ?? "S"));

        $banner = NULL;

        // verificar se foi enviada uma imagem
        if (!empty($_FILES["banner"]["name"])) {

            // gerar um nome único para a imagem
            $banner = time();
            $banner = "{$banner}.jpg";

            // copiar arquivo para o servidor
            if (!move_uploaded_file(
                $_FILES["banner"]["tmp_name"],
                "../arquivos/{$banner}"
            )) {

                mensagem(
                    "Erro",
                    "Erro ao copiar arquivo para o servidor",
                    "error"
                );

            }
        }

        // se o id estiver vazio - INSERT
        // se a imagem estiver vazia - UPDATE sem alterar a imagem
        // senão - UPDATE alterando também a imagem

        if (empty($id)) {

            $sql = "insert into banner
                (id, descricao, banner, ativo) values
                (NULL, :descricao, :banner, :ativo)";

            $consulta = $pdo->prepare($sql);

            $consulta->bindParam(":descricao", $descricao);
            $consulta->bindParam(":banner", $banner);
            $consulta->bindParam(":ativo", $ativo);

        } else if (empty($banner)) {

            $sql = "update banner set
                descricao = :descricao,
                ativo = :ativo
                where id = :id limit 1";

            $consulta = $pdo->prepare($sql);

            $consulta->bindParam(":descricao", $descricao);
            $consulta->bindParam(":ativo", $ativo);
            $consulta->bindParam(":id", $id);

        } else {

            $sql = "update banner set
                descricao = :descricao,
                banner = :banner,
                ativo = :ativo
                where id = :id limit 1";

            $consulta = $pdo->prepare($sql);

            $consulta->bindParam(":descricao", $descricao);
            $consulta->bindParam(":banner", $banner);
            $consulta->bindParam(":ativo", $ativo);
            $consulta->bindParam(":id", $id);

        }

        // verificar se vai executar
        if ($consulta->execute()) {

            mensagem(
                "Sucesso!",
                "Registro salvo",
                "success"
            );

        } else {

            mensagem(
                "Erro",
                "Erro ao gravar",
                "error"
            );

        }

    } else {

        mensagem(
            "Erro",
            "Requisição inválida",
            "error"
        );

    }