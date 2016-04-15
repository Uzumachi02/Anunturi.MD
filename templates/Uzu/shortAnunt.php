<h2 class="content-h2"><?= $h2text ?></h2>

<?php if(count($ultimeleAnunturi) > 0):?>

    <?php foreach ($ultimeleAnunturi as $anunt): ?>

        <div class="news news-hover">
            <div class="rows">
                <a href="/anunt/<?= $anunt['id'] ?>">
                    <div class="col-md-3">
                        <img src="/<?= $anunt['foto'] ?>" alt="<?= $anunt['title'] ?>">
                    </div>
                    <div class="col-md-9">
                        <h3><?= $anunt['title'] ?></h3>
                        <p><?=substr($anunt['descriere'], 0, 290).'...'?></p>
                        <div class="info">
                            <span class="pret"><b><?= $anunt['pret'] ?> €</b></span>
                            <span class="data"><?= Anunturi::getDate($anunt['add_data']) ?></span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="clearfix"></div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <?php include TPL . 'Error.php'; ?>
<?php endif; ?>
