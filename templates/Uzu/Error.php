<div class="alert notice-error">
    <b>Erroare, </b> <?= $errorText?>
    <button class="alert-btn" id="redirect" type="button">×</button>
</div>

<script>
    $("#redirect").click(function () {
        $(location).attr('href','/');
    });
</script>