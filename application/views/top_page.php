<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link href="<?= APPPATH ?>css/style.css" rel="stylesheet" type="text/css"/>
        <link href="<?= APPPATH ?>css/jquery.tagit.css" rel="stylesheet" type="text/css"/>
        <link href="<?= APPPATH ?>js/ui/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <script src="<?= APPPATH ?>js/jquery-2.1.4.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?= APPPATH ?>js/ui/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?= APPPATH ?>js/tag-it.js" type="text/javascript" charset="utf-8"></script>    
        <script>
            $(document).ready(function () {
                $("button").button().click(function() {
                    //window.alert($(this).text());
                });
                $("#myTags").tagit();
                $("#myTags").tagit("add", {label:'hoge', value: 12});
            });
        </script>    
    </head>
    <body>
        <button value="hogehoge" style="margin: 2px;">aaa</button>
        <ul id="myTags"></ul>
        <div id="main">
        </div>
    </body>
</html>