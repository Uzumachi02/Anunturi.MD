<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Utilizatorii
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-pie-chart"></i> <a href="/adminpanel">Statistica</a>
            </li>
            <li class="active">
                <i class="fa fa-users"></i> Utilizatorii
            </li>
        </ol>
    </div>
</div>
<div class="col-lg-12">
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>Login <i class="fa fa-chevron-down"></i></th>
                <th>Nume/Prenume <i class="fa fa-chevron-down"></i></th>
                <th>Email <i class="fa fa-chevron-down"></i></th>
                <th>Phone <i class="fa fa-chevron-down"></i></th>
                <th>RegData <i class="fa fa-chevron-down"></i></th>
                <th>Setari <i class="fa fa-chevron-down"></i></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($lastUsers as $user): ?>
                <tr>
                    <td><?=$user['login']?></td>
                    <td><?=$user['nume']?></td>
                    <td><?=$user['email']?></td>
                    <td><?=$user['phone']?></td>
                    <td><?=User::getDate($user['reg_date'], 'H:i - d.m.Y')?></td>
                    <td class="edit_icon">
                        <a href="/profile/view/<?=$user['login']?>" target="_blank"><i class="fa fa-eye"
                                      data-toggle="tooltip"
                                      data-placement="top"
                                      title="Vizionarea utilizatorului"></i></a>

                        <a href="/profile/edit/<?=$user['login']?>" target="_blank"><i class="fa fa-pencil-square-o"
                                      data-toggle="tooltip"
                                      data-placement="top"
                                      title="Redactarea utilizatorului"></i></a>

                        <a href="#" onclick="removeUser(<?=$user['id']?>); return false;"><i class="fa fa-trash"
                                      data-toggle="tooltip"
                                      data-placement="top"
                                      title="Stergerea utilizatorului"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    function removeUser (id) {
        if (confirm('Sinteti siguri ca doriti sa stergeti?')) {

            $.ajax({
                url: '/profile/remove/' + id,
                success: function (res) {
                    res = JSON.parse(res);

                    if (Notice(res)) {
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        }

        return false;
    }
</script>