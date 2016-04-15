<h2 class="content-h2"><?= $anunt['title'] ?></h2>
<div class="echo-news">
    <hr>

    <?php if (!$anunt['valabil']): ?>
        <div class="alert notice-error" style="margin-top: 0; margin-bottom: 15px;">
             <b>Atentie:</b> Anuntul nu mai este <u>Valabil.</u>
        </div>
    <?php endif; ?>

    <?php if (!empty($anunt['foto'])): ?>
        <div class="fotoram-center">
            <div class="fotorama"
                 data-autoplay="3000"
                 data-width="100%"
                 data-ratio="16/9"
                 data-allowfullscreen="native"
                 data-nav="thumbs"
            >

            <?php foreach ($photo as $var): ?>
                <img src="/uploads/<?=$var ?>" alt="<?= $anunt['title'] ?>">
            <?php endforeach; ?>

            </div>
        </div>
    <?php endif; ?>

    <p><?= $anunt['descriere'] ?></p>
    <br />
    <h3>Informatie:</h3>
    <p><b>Categoria: </b><?= Anunturi::getCategoriaText($anunt['categorie']) ?></p>
    <p><b>Marimea: </b><?= $anunt['marimea'] ?> m2</p>
    <p><b>Camere: </b><?= $anunt['nr_cam'] ?></p>
    <p><b>Starea: </b><?= Anunturi::getStareaText($anunt['starea']) ?></p>
    <p><b>Regiunea: </b><?= $anunt['name_loc'] ?></p>
    <br />
    <h3>Contacte:</h3>
    <p><b>Stapinu: </b> <a href="/profile/view/<?= $anunt['login'] ?>"><?= $anunt['nume'] ?></a></p>
    <p><b>Mobil: </b> <?= $anunt['phone'] ?></p>
    <p><b>Email: </b> <?= $anunt['email'] ?></p>
    <p class="echo-pret"><b>Pretul: </b><?= $anunt['pret'] ?> €</p>
    <hr>
    <span class="echo-date">
        <em data-toggle="tooltip" data-placement="top" title="<?= Anunturi::getDate($anunt['add_data'], 'H:i d.m.Y') ?>">
            <?= Anunturi::getDate($anunt['add_data']) ?>
        </em>
    </span>
    <span class="echo-date">
        <em data-toggle="tooltip" data-placement="right" title="<?= $anunt['vizionari'] ?> Vizionari">
            <?= $anunt['vizionari'] ?> <i class="fa fa-eye"></i>
        </em>
    </span>
</div>