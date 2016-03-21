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
class DeveloperModel extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->my_table_name = $this->table_developer_master;
    }

    public function getDeveloper($where) {
        return $this->GetRecord($this->my_table_name, $where);
    }

    public function getAllDevelopers() {
        $result = array();
        $objs = $this->db->get($this->my_table_name)->result();
        foreach($objs as $obj) {
            $result += array($obj->DeveloperID => $obj->DeveloperName);
        }
        return $result;
    }
    
    public function insertDeveloper($data) {
        return $this->InsertRecord($this->my_table_name, $data);
    }

    public function updateDeveloper($where, $data) {
        return $this->UpdateRecord($this->my_table_name, $where, $data);
    }

    public function deleteDeveloper($where) {
        return $this->DeleteRecord($this->my_table_name, $where);
    }
}
