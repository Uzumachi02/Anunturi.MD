<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Anunturile
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-pie-chart"></i> <a href="/adminpanel">Statistica</a>
            </li>
            <li class="active">
                <i class="fa fa-users"></i> Anunturile
            </li>
        </ol>
    </div>
</div>
<div class="col-lg-12 col-md-12">
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>Titlu <i class="fa fa-chevron-down"></i></th>
                <th>Localitatea <i class="fa fa-chevron-down"></i></th>
                <th>Categoria <i class="fa fa-chevron-down"></i></th>
                <th>Pretul <i class="fa fa-chevron-down"></i></th>
                <th>Valabil <i class="fa fa-chevron-down"></i></th>
                <th>AddData <i class="fa fa-chevron-down"></i></th>
                <th>Setari <i class="fa fa-chevron-down"></i></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($lastAnunt as $anunt): ?>
                <tr>
                    <td><?=$anunt['title']?></td>
                    <td><?=Anunturi::getLocText($anunt['id_loc'])?></td>
                    <td><?=Anunturi::getCategoriaText($anunt['categorie'])?></td>
                    <td><?=$anunt['pret']?></td>
                    <td><?= ($anunt['valabil']) ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>';?></td>
                    <td><?=Anunturi::getDate($anunt['add_data'], 'H:i - d.m.Y')?></td>
                    <td class="edit_icon">
                        <a href="/anunt/<?=$anunt['id']?>" target="_blank"><i class="fa fa-eye"
                                                                                       data-toggle="tooltip"
                                                                                       data-placement="top"
                                                                                       title="Vizionarea anuntului"></i></a>

                        <a href="/anunt/edit/<?=$anunt['id']?>" target="_blank"><i class="fa fa-pencil-square-o"
                                                                                       data-toggle="tooltip"
                                                                                       data-placement="top"
                                                                                       title="Redactarea anuntului"></i></a>

                        <a href="/anunt/remove/<?=$anunt['id']?>" id="remove_ajax"><i class="fa fa-trash"
                                      data-toggle="tooltip"
                                      data-placement="top"
                                      title="Stergerea anuntului"></i></a>
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
</script>