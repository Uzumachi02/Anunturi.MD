<div class="addanunt" id="addanunt">

    <h2 class="content-h2">Redactarea utilizatorului: <u><?= $param ?></u></h2>

    <form class="addanunt-form" id="edit_user" method="POST">

        <p>
            <label for="nume" class="col-md-3">Numele</label>
            <input class="col-md-9" type="text" name="nume" id="nume" value="<?=$user['nume']?>">
            <div class="clearfix"></div>
        </p>

        <p>
            <label class="col-md-3" for="email">Email</label>
            <input class="col-md-9" type="text" name="email" id="email" value="<?=$user['email']?>">
            <div class="clearfix"></div>
        </p>

        <p>
            <label class="col-md-3" for="phone">Telefonul</label>
            <input class="col-md-9" type="text" name="phone" id="phone" value="<?=$user['phone']?>">
            <div class="clearfix"></div>
        </p>

        <h3>Schimbarea parolei</h3>
        <hr />

        <?php if ($dostup < 2): ?>

            <p>
                <label class="col-md-3" for="thisPass">Parola curenta</label>
                <input class="col-md-9" type="password" name="thisPass" id="thisPass">
                <div class="clearfix"></div>
            </p>

        <?php endif; ?>

        <p>
            <label class="col-md-3" for="newPass">Parola noua</label>
            <input class="col-md-9" type="password" name="newPass" id="newPass">
            <div class="clearfix"></div>
        </p>

        <input type="hidden" name="login" value="<?=$user['login']?>">

        <p>
            <label class="col-md-3" for="confNewPass">Confirmarea parolei</label>
            <input class="col-md-9" type="password" name="confNewPass" id="confNewPass">
            <div class="clearfix"></div>
        </p>

        <span>
            <button class="btn-succ" type="submit">Salvare</button>
            <button class="btn-fail" type="reset">Resetare</button>
        </span>
    </form>
</div>

<script>
    $('#edit_user').submit(function () {
        console.log('test');
        //$('#notice').html('Ok,./.').show();
        $.ajax({
            type: "POST",
            url: '/profile/save/<?=$user['login']?>',
            data: $(this).serialize(),
            success: function (res) {
                res =JSON.parse(res);

                if (Notice (res)) {
                    setTimeout(function () {
                        $(location).attr('href','/profile/view/<?=$user['login']?>');
                    }, 2000);
                }
            }
        });
        return false;
    });
</script>