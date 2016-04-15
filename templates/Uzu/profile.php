<div class="row">
    <div class="col-sm-10 col-md-10">
        <h2 class="content-h2">Utilizatorul: <u><?= $user['nume'] ?></u></h2>
    </div>
    <div class="col-sm-2 col-md-2">
        <div class="edit_user">

            <?php if ($sess == $user['login'] or $dostup > 1): ?>
            <a href="/profile/edit/<?= $user['login'] ?>">
                <i class="fa fa-pencil-square-o"
                   data-toggle="tooltip"
                   data-placement="top"
                   title="Redactarea profilului"></i>
            </a>
            <?php endif; ?>

            <?php if ($dostup > 1): ?>

                <a href="">
                    <i class="fa fa-trash"
                       data-toggle="tooltip"
                       data-placement="top"
                       title="Stergerea profilului"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="news">
    <div class="profile">
        <p><b>Login: </b> <?= $user['login'] ?></p>
        <p><b>Nume: </b> <?= $user['nume'] ?></p>
        <p><b>Grupa: </b> <?= $user['denumire'] ?></p>
        <p><b>E-Mail: </b> <?= $user['email'] ?></p>
        <p><b>Telefonul: </b> <?= $user['phone'] ?></p>
        <p><b>Data inregistrarii: </b> <?= User::getDate($user['reg_date'], 'H:i:s d.m.Y') ?></p>
    </div>
    <div class="addnews">

        <?php if (isset($news_user) && !empty($news_user)): ?>
            <h3>Anuntuile adaugate:</h3>

            <?php foreach ($news_user as $anunt): ?>

                <a href="/anunt/<?= $anunt['id'] ?>" class="addnews-prev" target="_blank">
                    <span class="addnews-title col-md-10"><?= $anunt['title'] ?></span>
                    <span class="addnews-date col-md-2"><?= Anunturi::getDate($anunt['add_data']) ?></span>
                    <div class="clearfix"></div>
                </a>

            <?php endforeach; ?>
        <?php endif; ?>

    </div>
</div>
