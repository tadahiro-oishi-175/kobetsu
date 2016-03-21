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
        $this->ci = & get_instance();
    }

    public function beforeFilter() {

        //$result['tags'] = $this->ci->tag_model->getTagDataListHtml();
        $result['search_menu'] = $this->ci->load->view('search_menu', NULL, TRUE);
        $this->ci->load->view('frame', $result);
    }

    public function afterFilter() {
        $this->ci->load->view('footer');
    }

}
