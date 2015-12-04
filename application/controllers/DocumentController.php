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
class DocumentController extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function ViewAllOutputDocs() {
        $result['outputs'] = $this->outputdoc_model->getAllOutputs();
        $this->load->view('output/view_all_output', $result);
    }

    public function AddOutput() {
        if ($this->input->post('submit_AddNewOutput') != NULL) {
            $this->BeginTransaction();
            $data = array(
                'OutputName' => $this->input->post('OutputName'),
            );
            
            $id = $this->output_model->insertOutput($data);
            $this->EndTransaction();
            $this->ViewAllOutputs();
        } else {
            $result['selectOS'] = NULL;
            $this->load->view('output/view_add_newOutput', $result);
        }
    }

    public function EditOutput($OutputID) {
        if ($this->input->post('submit_EditOutput') != NULL) {
            $this->BeginTransaction();

            // Edit
            $this->output_model->updateOutput($where, $data);

            $this->EndTransaction();
        } else {
            $result = NULL;
            $this->load->view('', $result);
        }
    }

    public function DeleteOutput($OutputID) {
        $this->BeginTransaction();

        // Delete
        $this->output_model->deleteOutput($where);

        $this->EndTransaction();
    }
}
