<?php include TPL . 'header.php'; ?>

    <div class="content">
        <div class="rows">
            <div class="col-md-9">
                <?php include TPL . $content; ?>
            </div>
            <div class="col-md-3" style="background-color: #666; min-height: 200px;">
                <div class="find" id="spider">
                    <?php include TPL . $sideBar; ?>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="notice" id="notice" style="display: none;"></div>
<?php include TPL . 'footer.php'; ?>