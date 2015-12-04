<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of frameSet
 *
 * @author Oishi-Tadahiro
 */
class FrameSet {
    
    function __construct() {
        $this->ci =& get_instance();
    }
    
    public function beforeFilter() {
        $ci =& get_instance();
        $ci->load->view('frame');        
    }
    
    public function afterFilter() {
        $ci =& get_instance();
        $ci->load->view('footer');
    }
    //put your code here
}
