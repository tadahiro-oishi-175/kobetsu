<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<div id="tags">
    <ul>
        <?php foreach($tags as $tag): ?>
        <li><?= $tag->TagName ?></li>
        <?php endforeach; ?>
    </ul>
</div>