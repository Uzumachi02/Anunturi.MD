<div class="addanunt" id="addanunt">
    <h2 class="content-h2">Adaugarea anuntului</h2>
    <form class="addanunt-form" id="add_anunt" enctype="multipart/form-data" method="POST" action="#">

        <p>
            <label for="title" class="col-md-3">Denumirea</label>
            <input class="col-md-9" type="text" name="title" id="title" required>
            <div class="clearfix"></div>
        </p>

        <p>
            <label class="col-md-3" for="categor">Categoria</label>
            <select class="col-md-9" name="categor" id="categor" required>
                <option value>Alegeti:</option>
                <option value="1">Vinzare</option>
                <option value="2">Schimbare</option>
                <option value="3">Chirie</option>
            </select>
        <div class="clearfix"></div>
        </p>

        <p>
            <label class="col-md-3" for="locc">Localitatea</label>
            <select class="col-md-9" name="location" id="locc" required>
                <option value>Alegeti:</option>
                <option value="1">Balti</option>
                <option value="2">Chisinau</option>
                <option value="3">Orhei</option>
            </select>
        <div class="clearfix"></div>
        </p>

        <p>
            <label class="col-md-3" for="starea">Starea</label>
            <select class="col-md-9" name="starea" id="starea" required>
                <option value>Alegeti:</option>
                <option value="1">Euro reparatie</option>
                <option value="2">Necesita reparatie</option>
                <option value="3">Buna</option>
            </select>
        <div class="clearfix"></div>
        </p>

        <p>
            <label class="col-md-3" for="marimea">Marimea, in m2</label>
            <input class="col-md-9" type="text" name="marimea" id="marimea" required>
        <div class="clearfix"></div>
        </p>

        <p>
            <label class="col-md-3" for="nrcam">Numarul de cameri</label>
            <input class="col-md-9" type="text" name="nrcam" id="nrcam" required>
        <div class="clearfix"></div>
        </p>

        <p>
            <label class="col-md-3" for="pret">Pretul, in euro</label>
            <input class="col-md-9" type="text" name="pret" id="pret" required>
        <div class="clearfix"></div>
        </p>

        <p>
            <label class="col-md-3" for="desrc">Descriere</label>
            <textarea class="col-md-9" name="desrc" id="desrc" rows="5" required></textarea>
        <div class="clearfix"></div>
        </p>
        <p>
            <label class="col-md-3" for="foto">Fotografii</label>
            <input class="col-md-9" name="phFile[]" type="file" id="foto" multiple="true"/>
            <div class="clearfix"></div>
        </p>
        <span>
            <button class="btn-succ" name="submit" type="submit" value="ok">Adaugare</button>
            <button class="btn-fail" type="reset" >Resetare</button>
        </span>
    </form>
</div>

<?php if (isset($error) && is_array($error)): ?>
    <div class="notice notice-error">

    <?php foreach ($error as $err): ?>
        <?= $err ?>
    <?php endforeach; ?>
    </div>
<?php endif; ?>
<script>
    $('#').submit(function () {
        var check = false;
        console.log('test');
        //$('#notice').html('Ok,./.').show();
        $.ajax({
            type: "POST",
            url: '/anunt/save',
            data: $(this).serialize(),
            success: function (res) {
                //$('#notice').addClass('notice-error').show(100).text(res);
                res =JSON.parse(res);

                if (Notice (res)) {
                    return true;
                }
            }
        });
        return false;
    });
</script>