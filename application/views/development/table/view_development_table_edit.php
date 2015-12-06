<html>    
    <head>
        <meta charset="UTF-8">
        <link href="<?= base_url() ?>application/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url() ?>application/css/dropzone.css" rel="stylesheet" type="text/css"/>
        <script src="<?= base_url() ?>application/js/jquery-2.1.4.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?= base_url() ?>application/js/dropzone.js" type="text/javascript" charset="utf-8"></script>
        <title>View Spec</title>
    </head>
    <body>
        <div id="main">
            <?= form_open("SpecController/EditSpecDevelopment/$specObj->SpecID/$prodObj->ProductID"); ?>
            <label>仕様詳細</label>
            <table class="InputForm">
                <tr>
                    <th>対象機種</th>
                    <td><?= $prodObj->ProductName ?></td>
                </tr>
                <tr>
                    <th>対象PDL</th>
                    <td><?= $selectPDL ?></td>
                </tr>
                <tr>
                    <th>対象言語</th>
                    <td></td>
                </tr>
            </table>
            <?php echo form_submit('submit_EditSpecDevelopment', '保存'); ?>
            <?php echo form_close(); ?> 
        </div>
    </body>
</html>