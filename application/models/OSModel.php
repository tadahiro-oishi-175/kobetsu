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
class OSModel extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->my_table_name = $this->table_os_master;
    }

    public function getAllOSs() {
        return $this->GetAllRecords($this->my_table_name);
    }

    public function getOS($where) {
        return $this->GetRecord($this->my_table_name, $where);
    }

    public function insertOS($data) {
        return $this->InsertRecord($this->my_table_name, $data);
    }

    public function updateOS($where, $data) {
        return $this->UpdateRecord($this->my_table_name, $where, $data);
    }

    public function deleteOS($where) {
        return $this->DeleteRecord($this->my_table_name, $where);
    }

    public function getSupportedOSIDArray($category, $where) {
        switch ($category) {
            case 'Requirement':
                $table = $this->table_requirement_os;
                break;
            case 'Spec':
                $table = $this->table_spec_os;
                break;
            default:
                $table = '';
                break;
        }
        $this->db->select('OSID');
        $result = array();
        $objs = $this->GetRecord($table, $where);

        if (is_array($objs)) {
            foreach ($objs as $obj) {
                array_push($result, $obj->OSID);
            }
        } else {
            array_push($result, $objs->OSID);
        }
        return $result;
    }

}
