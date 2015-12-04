<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CaseController
 *
 * @author Oishi-Tadahiro
 */
class OSController extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function ViewAllOS() {
        $result['tags'] = $this->os_model->getAllOSs();
        $this->load->view('tag/view_all_os', $result);
    }

    public function AddTag() {
        if ($this->input->post('submit_AddNewOS') != NULL) {
            $this->BeginTransaction();
            $data = array(
                'OSName' => $this->input->post('OSName'),
            );
            
            $id = $this->os_model->insertTag($data);
            $this->EndTransaction();
            $this->ViewAllTag();
        } else {
            $result['selectOS'] = NULL;
            $this->load->view('tag/view_add_newOS', $result);
        }
    }

    public function EditTag($OSID) {
        if ($this->input->post('submit_EditOS') != NULL) {
            $this->BeginTransaction();

            // Edit

            $this->EndTransaction();
        } else {
            $result = NULL;
            $this->load->view('', $result);
        }
    }

    public function DeleteOS($OSID) {
        $this->BeginTransaction();

        // Delete

        $this->EndTransaction();
    }
}
