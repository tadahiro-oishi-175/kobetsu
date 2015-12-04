<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link href="<?= base_url()?>application/css/style.css" rel="stylesheet" type="text/css"/>
        <script>
            $(document).ready(function () {
                //$('#tag-input').tagit();
                //$('#tag-input').tagit({placeholderText: "タグをつけよう", fieldName: "tags[]"});
                $('#tags').tagit({
                    fieldName: "tags",
                    singleField: true,
                    readOnly: true,
                    sortable: 'handle',
                    onTagClicked: function (event, ui) {
                        window.alert(ui.tagLabel);
                    }
                });
            });
        </script>
        <title></title>
    </head>
    <body>
        <?= form_open('TagController/AddTag') ?>
        <?= form_submit('go_AddNewTag', 'タグ追加') ?>
        <div id="main">
            <div style="width: 800px">
                <?= $tags ?>
            </div>
        </div>
        <?= form_close() ?>
    </body>
</html>
