<h2 id="test">Inregistrare</h2>
<form class="find-form" id="register_user" method="POST">
    <p>
        <label for="login">Loginu</label>
        <input type="text" name="login" id="login" required>
    </p>
    <p>
        <label for="pass">Parola</label>
        <input type="password" name="password" id="pass" required>
    </p>
    <p>
        <label for="pass1">Repeta paropa</label>
        <input type="password" name="password1" id="pass1" required>
    </p>
    <p>
        <label for="name">Numele / Prenumele</label>
        <input type="text" name="name" id="name" required>
    </p>
    <p>
        <label for="email">E-Mail</label>
        <input type="email" name="email" id="email" required>
    </p>
    <p>
        <label for="phone">Numarul de telefon</label>
        <input type="text" name="phone" id="phone" required>
    </p>
    <p>
        <button type="submit">Registrare</button>
    </p>
</form>

<script>
    $('#register_user').submit(function () {
        console.log('test');
        //$('#notice').html('Ok,./.').show();
        $.ajax({
            type: "POST",
            url: '/user/register',
            data: $(this).serialize(),
            success: function (res) {
                res =JSON.parse(res);

                if (Notice (res)) {
                    $('#spider').load('templates/Uzu/login.php');
                }
            }
        });
        return false;
    });
</script>