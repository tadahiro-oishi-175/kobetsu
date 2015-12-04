<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CaseModel
 *
 * @author Oishi-Tadahiro
 */
class UserModel extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->my_table_name = $this->table_user_master;
    }

    public function getAllUsers() {
        return $this->GetAllRecords($this->my_table_name);
    }
    
    public function getUser($where) {
        return $this->GetRecord($this->my_table_name, $where);
    }
    
    public function insertUser($data) {
        return $this->InsertRecord($this->my_table_name, $data);
    }
    
    public function updateUser($where, $data) {
        return $this->UpdateRecord($this->my_table_name, $where, $data);
    }
    
    public function deleteUser($where) {
        return $this->DeleteRecord($this->my_table_name, $where);
    }
}
