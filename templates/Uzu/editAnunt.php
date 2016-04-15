<div class="addanunt" id="addanunt">
    <h2 class="content-h2">Redactarea anuntului</h2>
    <form class="addanunt-form" id="edit_anunt" method="POST">

        <?php if (isset($photo)): ?>

            <div class="fotothumb">

                <?php foreach ($photo as $var): ?>
                    <img src="/uploads/<?=$var ?>" alt="<?= $anunt['title'] ?>">
                <?php endforeach; ?>

            </div>

        <?php endif; ?>


        <p>
            <label for="title" class="col-md-3">Denumirea</label>
            <input class="col-md-9" type="text" name="title" id="title" value="<?=$anunt['title']?>">
        <div class="clearfix"></div>
        </p>

        <p>
            <label class="col-md-3" for="categor">Categoria</label>
            <select class="col-md-9" name="categor" id="categor">
                <option value>Alegeti:</option>
                <option <?php if ($anunt['categorie'] == 1 ) echo 'selected' ; ?> value="1">Vinzare</option>
                <option <?php if ($anunt['categorie'] == 2 ) echo 'selected' ; ?> value="2">Schimbare</option>
                <option <?php if ($anunt['categorie'] == 3 ) echo 'selected' ; ?> value="3">Chirie</option>
            </select>
        <div class="clearfix"></div>
        </p>

        <p>
            <label class="col-md-3" for="locc">Localitatea</label>
            <select class="col-md-9" name="location" id="locc">
                <option value>Alegeti:</option>
                <option <?php if ($anunt['id_loc'] == 1 ) echo 'selected' ; ?> value="1">Balti</option>
                <option <?php if ($anunt['id_loc'] == 2 ) echo 'selected' ; ?> value="2">Chisinau</option>
                <option <?php if ($anunt['id_loc'] == 3 ) echo 'selected' ; ?> value="3">Orhei</option>
            </select>
            <input type="hidden" name="id_user" value="<?=$anunt['id_user']?>">
        <div class="clearfix"></div>
        </p>

        <p>
            <label class="col-md-3" for="starea">Starea</label>
            <select class="col-md-9" name="starea" id="starea">
                <option value>Alegeti:</option>
                <option <?php if ($anunt['starea'] == 1 ) echo 'selected' ; ?> value="1">Euro reparatie</option>
                <option <?php if ($anunt['starea'] == 2 ) echo 'selected' ; ?> value="2">Necesita reparatie</option>
                <option <?php if ($anunt['starea'] == 3 ) echo 'selected' ; ?> value="3">Buna</option>
            </select>
            <input type="hidden" name="id" value="<?=$anunt['id']?>">
        <div class="clearfix"></div>
        </p>

        <p>
            <label class="col-md-3" for="marimea">Marimea, in m2</label>
            <input class="col-md-9" type="text" name="marimea" id="marimea" value="<?=$anunt['marimea']?>">
        <div class="clearfix"></div>
        </p>

        <p>
            <label class="col-md-3" for="nrcam">Numarul de cameri</label>
            <input class="col-md-9" type="text" name="nrcam" id="nrcam" value="<?=$anunt['nr_cam']?>">
        <div class="clearfix"></div>
        </p>

        <p>
            <label class="col-md-3" for="pret">Pretul, in euro</label>
            <input class="col-md-9" type="text" name="pret" id="pret" value="<?=$anunt['pret']?>">
        <div class="clearfix"></div>
        </p>

        <p>
            <label class="col-md-3" for="valb">Valabil</label>
            <input class="col-md-9"
                   type="checkbox"
                   name="valb"
                   id="valb"
                <?php if ($anunt['valabil'] == 1 ) echo 'checked' ; ?>>
        <div class="clearfix"></div>
        </p>

        <p>
            <label class="col-md-3" for="desrc">Descriere</label>
            <textarea class="col-md-9" name="desrc" id="desrc" rows="5"><?=$anunt['descriere']?></textarea>
        <div class="clearfix"></div>
        </p>

        <span>
            <button class="btn-succ" type="submit">Salvare</button>
            <button class="btn-fail" type="reset" >Resetare</button>
        </span>
    </form>
</div>

<script>
    $('#edit_anunt').submit(function () {
        console.log('test');
        //$('#notice').html('Ok,./.').show();
        $.ajax({
            type: "POST",
            url: '/anunt/save/<?=$param?>',
            data: $(this).serialize(),
            success: function (res) {
                res =JSON.parse(res);

                if (Notice (res)) {
                    setTimeout(function () {
                        $(location).attr('href','/anunt/<?=$param?>');
                    }, 2000);
                }
            }
        });
        return false;
    });
</script>