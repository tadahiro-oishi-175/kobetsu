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
class StatusController extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function ViewAllStatus() {
        $result['allstatus'] = $this->requester_model->getAllStatus();
        $this->load->view('status/view_all_status', $result);
    }

    public function AddStatus() {
        if ($this->input->post('submit_AddNewStatus') != NULL) {
            $this->BeginTransaction();
            $data = array(
                'StatusName' => $this->input->post('StatusName'),
            );
            
            $id = $this->status_model->insertStatus($data);
            $this->EndTransaction();
            $this->ViewAllStatus();
        } else {
            $result['selectOS'] = NULL;
            $this->load->view('status/view_add_newStatus', $result);
        }
    }

    public function EditStauts($StatusID) {
        if ($this->input->post('submit_EditStatus') != NULL) {
            $this->BeginTransaction();

            // Edit
            $this->status_model->updateStatus($where, $data);

            $this->EndTransaction();
        } else {
            $result = NULL;
            $this->load->view('', $result);
        }
    }

    public function DeleteStatus($StatusID) {
        $this->BeginTransaction();

        // Delete
        $this->status_model->deleteStatus($where);

        $this->EndTransaction();
    }
}
