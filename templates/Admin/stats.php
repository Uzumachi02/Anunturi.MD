<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Statistica
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-pie-chart"></i> Statistica
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?=$users?></div>
                        <div>Utilizatori!</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-newspaper-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?=$sumAnunt?></div>
                        <div>Total Anunturi!</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-check-square-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?=$actAnunt?></div>
                        <div>Anunturi Active!</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-square-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?=$NoactAnunt?></div>
                        <div>Anunturi Ne Active!</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-users fa-fw"></i> Utltimii 5 utilizatori</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Login <i class="fa fa-chevron-down"></i></th>
                            <th>Nume/Prenume <i class="fa fa-chevron-down"></i></th>
                            <th>Email <i class="fa fa-chevron-down"></i></th>
                            <th>Phone <i class="fa fa-chevron-down"></i></th>
                            <th>RegData <i class="fa fa-chevron-down"></i></th>
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
                            </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-newspaper-o fa-fw"></i> Utltimiele 5 anunturi</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Titlu <i class="fa fa-chevron-down"></i></th>
                            <th>Pret <i class="fa fa-chevron-down"></i></th>
                            <th>Stapin <i class="fa fa-chevron-down"></i></th>
                            <th>AddData <i class="fa fa-chevron-down"></i></th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($lastAnunt as $anunt): ?>
                            <tr>
                                <td><?=$anunt['title']?></td>
                                <td><?=$anunt['pret']?></td>
                                <td><?=$anunt['login']?></td>
                                <td><?=Anunturi::getDate($anunt['add_data'], 'H:i - d.m.Y')?></td>
                            </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>