<div class="container p-5">

    <?php
        $sqlBanners = "select id, descricao, banner
            from banner
            where ativo = 'S'
            order by id desc";

        $consultaBanners = $pdo->prepare($sqlBanners);
        $consultaBanners->execute();
        $dadosBanners = $consultaBanners->fetchAll(PDO::FETCH_OBJ);
    ?>

    <?php if (count($dadosBanners) > 0) { ?>

        <div id="carouselBanners" class="carousel slide mb-5 shadow" data-bs-ride="carousel">

            <div class="carousel-indicators">

                <?php
                    foreach ($dadosBanners as $i => $banner) {
                ?>

                    <button type="button"
                            data-bs-target="#carouselBanners"
                            data-bs-slide-to="<?= $i ?>"
                            class="<?= $i == 0 ? 'active' : '' ?>"
                            aria-current="<?= $i == 0 ? 'true' : 'false' ?>"
                            aria-label="Banner <?= $i + 1 ?>">
                    </button>

                <?php
                    }
                ?>

            </div>

            <div class="carousel-inner">

                <?php
                    foreach ($dadosBanners as $i => $banner) {
                ?>

                    <div class="carousel-item <?= $i == 0 ? 'active' : '' ?>">

                        <img src="arquivos/<?= $banner->banner ?>"
                             alt="<?= $banner->descricao ?>"
                             class="d-block w-100">

                    </div>

                <?php
                    }
                ?>

            </div>

            <?php if (count($dadosBanners) > 1) { ?>

                <button class="carousel-control-prev"
                        type="button"
                        data-bs-target="#carouselBanners"
                        data-bs-slide="prev">

                    <span class="carousel-control-prev-icon"></span>

                    <span class="visually-hidden">
                        Anterior
                    </span>

                </button>

                <button class="carousel-control-next"
                        type="button"
                        data-bs-target="#carouselBanners"
                        data-bs-slide="next">

                    <span class="carousel-control-next-icon"></span>

                    <span class="visually-hidden">
                        Próximo
                    </span>

                </button>

            <?php } ?>

        </div>

    <?php } ?>


    <h2>Destaques de Hoje:</h2>

    <div class="row">

        <?php

            $sqlDestaques = "select f.id, f.titulo, f.ano, f.original, f.capa, c.categoria

                from filme f

                inner join categoria c on (c.id = f.categoria_id)

                order by rand() limit 4";

            $consulta = $pdo->prepare($sqlDestaques);

            $consulta->execute();

            $dadosDestaques = $consulta->fetchAll(PDO::FETCH_OBJ);

            foreach ($dadosDestaques as $dados) {

                ?>

                <div class="col-12 col-md-3">

                    <div class="card shadow">

                        <img src="arquivos/<?= $dados->capa ?>"
                             alt="<?= $dados->titulo ?>"
                             class="w-100">

                        <div class="card-body">

                            <h3><?= $dados->titulo ?></h3>

                            <p>
                                <i><?= $dados->original ?></i>
                                (<?= $dados->ano ?>)
                            </p>

                            <p>
                                Categoria: <?= $dados->categoria ?>
                            </p>

                            <p>

                                <a href="filme/<?= $dados->id ?>"
                                   title="Detalhes"
                                   class="btn btn-warning w-100">

                                    Detalhes

                                </a>

                            </p>

                        </div>

                    </div>

                </div>

                <?php

            }

        ?>

    </div>

</div>