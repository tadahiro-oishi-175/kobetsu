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
class SWController extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function ViewAllSWs() {
        $result['sws'] = $this->sw_model->getAllSWs();
        $this->load->view('sw/view_all_SWs', $result);
    }

    public function AddSW() {
        if ($this->input->post('submit_AddNewSW') != NULL) {
            $this->BeginTransaction();
            
            $data = array(
                'SWName' => $this->input->post('SWName'),
            );
            
            $id = $this->sw_model->insertSW($data);
            $this->EndTransaction();
            $this->ViewAllSWs();
        } else {
            $result['selectOS'] = NULL;
            $this->load->view('sw/view_add_newSW', $result);
        }
    }

    public function EditSW($SWID) {
        if ($this->input->post('submit_EditSW') != NULL) {
            $this->BeginTransaction();

            // Edit
            $this->sw_model->updateSW($where, $data);

            $this->EndTransaction();
        } else {
            $result = NULL;
            $this->load->view('', $result);
        }
    }

    public function DeleteSW($SWID) {
        $this->BeginTransaction();

        // Delete
        $this->sw_model->deleteSW($where);
        
        $this->EndTransaction();
    }
}
