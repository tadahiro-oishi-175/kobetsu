<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
            <h2>案件</h2>
            <ul>                        
                <li><?= anchor('CaseController/ViewAllCase', '案件一覧'); ?></li>
                <li><?= anchor('CaseController/AddNewCase', '案件登録'); ?></li>
                <li><?= anchor('TagController/ViewAllTag', 'タグ追加'); ?></li>
            </ul>
        </div>