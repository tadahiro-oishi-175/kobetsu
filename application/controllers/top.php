<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Top
 *
 * @author Oishi-Tadahiro
 */
class Top extends MY_Controller{
    
    function __construct() {
      parent::__construct();    
    }
    
    public function index()
	{
            $this->load->database();
            $this->load->view('top_page');
	}
}
