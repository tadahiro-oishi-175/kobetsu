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
class UserController extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function ViewAllUsers() {
        $result['allusers'] = $this->user_model->getAllUsers();
        $this->load->view('users/view_all_user', $result);
    }

    public function AddUser() {
        if ($this->input->post('submit_AddNewUser') != NULL) {
            $this->BeginTransaction();
            $data = array(
                'UserName' => $this->input->post('UserName'),
                'Password' => $this->input->post('Password') != NULL ? $this->input->post('Password') : NULL,
                'WorkerID' => $this->input->post('WorkerID') != NULL ? $this->input->post('WokerID') : NULL,
            );
            
            $id = $this->status_model->insertUser($data);
            $this->EndTransaction();
            $this->ViewAllUsers();
        } else {
            $this->load->view('user/view_add_newUser', $result);
        }
    }

    public function EditUser($UserID) {
        if ($this->input->post('submit_EditUser') != NULL) {
            $this->BeginTransaction();

            // Edit
            $this->user_model->updateUser($where, $data);

            $this->EndTransaction();
        } else {
            $result = NULL;
            $this->load->view('', $result);
        }
    }

    public function DeleteUser($UserID) {
        $this->BeginTransaction();

        // Delete
        $this->user_model->deleteUser($where);

        $this->EndTransaction();
    }
}
