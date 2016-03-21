<html>
    <head>
        <meta charset="UTF-8">
        <link href="<?= base_url() ?>application/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url(); ?>application/css/multi-select.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url() ?>application/css/jquery.tagit.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url() ?>application/js/ui/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url() ?>application/css/dropzone.css" rel="stylesheet" type="text/css"/>
        <script src="<?= base_url() ?>application/js/jquery-2.1.4.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?= base_url() ?>application/js/ui/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?= base_url() ?>application/js/tag-it.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?= base_url() ?>application/js/dropzone.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?= base_url() ?>application/js/jquery.multi-select.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?= base_url(); ?>application/js/jquery.Aplus.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?= base_url(); ?>application/js/mydatepicker.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?= base_url(); ?>application/js/jquery.quicksearch.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?= base_url(); ?>application/js/jquery.sortedlist.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?= base_url(); ?>application/js/jquery.tablesorter.min.js" type="text/javascript" charset="utf-8"></script>
    </head>
    <body>
        <div id="container">
            <div id="head">
                <img src="<?= base_url() ?>application/img/logo2.png" alt="Spec DB" width="138" height="51">
            </div>

            <div id="contents">
                <div id="menu">
                    <ul>
                        <li><a href="<?= base_url() ?>">HOME</a></li>
                        <li><?php echo $this->session->userdata('is_login') == TRUE ? anchor(base_url() . 'auth/logout', 'LOGOUT') : ''; ?></li>
                    </ul>
                </div>

                <div id="submenu">
                    <h2>案件メニュー</h2>
                    <div id="ankenmenu">
                        <ul>                        
                            <li><?= anchor('CaseController/ViewAllCase', '全案件を表示する'); ?></li>
                            <li><?= anchor('CaseController/AddNewCase', '新規案件を登録する'); ?></li>
                        </ul>
                    </div>
                </div>