<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<div style="display: inline-block; text-align: justify">
    <p style="margin-top: 5px; width: max-content; background: lightgoldenrodyellow;">x86</p>
    <?php foreach ($x86 as $x86os): ?>
    <label><?= form_checkbox('targetOS[]', $x86os->OSID, in_array($x86os->OSID, $supportedOSID) ? TRUE : FALSE) ?><?= $x86os->OSName?></label>
    <?php endforeach; ?>
        
    <p style="margin: 0px; width: max-content; background: lightgoldenrodyellow;">x64</p>
    <?php foreach ($x64 as $x64os): ?>
    <label><?= form_checkbox('targetOS[]', $x64os->OSID, in_array($x64os->OSID, $supportedOSID) ? TRUE : FALSE) ?><?= $x64os->OSName?></label>
    <?php endforeach; ?>
</div>