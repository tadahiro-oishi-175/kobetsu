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
class WorkerController extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function ViewAllWorkers() {
        $result['workers'] = $this->worker_model->getAllWorkers();
        $this->load->view('worker/view_all_worker', $result);
    }

    public function AddWorker() {
        if ($this->input->post('submit_AddNewWorker') != NULL) {
            $this->BeginTransaction();
            $data = array(
                'WorkerName' => $this->input->post('WorkerName'),
            );
            
            $id = $this->worker_model->insertWorker($data);
            $this->EndTransaction();
            $this->ViewAllWorkers();
        } else {
            $result['selectOS'] = NULL;
            $this->load->view('worker/view_add_newWorker', $result);
        }
    }

    public function EditStauts($WorkerID) {
        if ($this->input->post('submit_EditWorker') != NULL) {
            $this->BeginTransaction();

            // Edit
            $this->worker_model->updateWorker($where, $data);

            $this->EndTransaction();
        } else {
            $result = NULL;
            $this->load->view('', $result);
        }
    }

    public function DeleteWorker($WorkerID) {
        $this->BeginTransaction();

        // Delete
        $this->worker_model->deleteWorker($where);

        $this->EndTransaction();
    }
}
