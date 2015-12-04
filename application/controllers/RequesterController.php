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
class RequesterController extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function ViewAllRequesters() {
        $result['requesters'] = $this->requester_model->getAllRequesters();
        $this->load->view('requester/view_all_requester', $result);
    }

    public function AddRequester() {
        if ($this->input->post('submit_AddNewRequester') != NULL) {
            $this->BeginTransaction();
            $data = array(
                'RequesterName' => $this->input->post('RequesterName'),
            );
            
            $id = $this->requester_model->insertRequester($data);
            $this->EndTransaction();
            $this->ViewAllRequesters();
        } else {
            $result['selectOS'] = NULL;
            $this->load->view('requester/view_add_newRequester', $result);
        }
    }

    public function EditRequester($RequesterID) {
        if ($this->input->post('submit_EditRequester') != NULL) {
            $this->BeginTransaction();

            // Edit
            $this->requester_model->updateRequester($where, $data);

            $this->EndTransaction();
        } else {
            $result = NULL;
            $this->load->view('', $result);
        }
    }

    public function DeleteRequester($RequesterID) {
        $this->BeginTransaction();

        // Delete
        $this->requester_model->deleteRequester($where);

        $this->EndTransaction();
    }
}
