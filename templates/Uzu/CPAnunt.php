<h2>Control Panel</h2>
<div class="cpanel">
    <p>
        <i class="fa fa-chevron-right"></i>
        <a href="/anunt/edit/<?= $id ?>">Redactarea anuntului <i class="fa fa-pencil-square-o"></i></a>
    </p>

    <p>
        <i class="fa fa-chevron-right"></i>
        <a href="/anunt/remove/<?= $id ?>" id="remove_ajax">Stergerea anuntului <i class="fa fa-trash-o"></i></a>
    </p>
</div>

<script>
    $('#remove_ajax').click(function () {

        if (confirm('Sinteti siguri ca doriti sa stergeti?')) {

            $.ajax({
                url: $(this).attr('href'),
                success: function (res) {
                    res = JSON.parse(res);

                    if (Notice(res)) {
                        setTimeout(function () {
                            $(location).attr('href','/');
                        }, 2000);
                    }
                }
            });
        }

        return false;
    });
</script>