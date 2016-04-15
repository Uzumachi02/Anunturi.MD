<h2 id="test">Logare</h2>
<form class="find-form" id="login_user" method="POST">
    <p>
        <label for="login">Loginu</label>
        <input type="text" name="login" id="login" required>
    </p>
    <p>
        <label for="pass">Parola</label>
        <input type="password" name="password" id="pass" required>
    </p>
    <p>
        <button type="submit">Intra</button>
    </p>
</form>

<script>
    $('#login_user').submit(function () {
        console.log('test');
        //$('#notice').html('Ok,./.').show();
        $.ajax({
            type: "POST",
            url: '/user/login',
            data: $(this).serialize(),
            success: function (res) {
                res =JSON.parse(res);

                if (Notice (res)) {
                    setTimeout(function () {
                        $(location).attr('href','/');
                    }, 2000);
                }
            }
        });
        return false;
    });
</script>
