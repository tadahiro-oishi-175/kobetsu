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
class PDLModel extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->my_table_name = $this->table_pdl_master;
    }

    public function getAllPDLs() {
        return $this->GetAllRecords($this->my_table_name);
    }

    public function getPDL($where) {
        return $this->GetRecord($this->my_table_name, $where);
    }

    public function insertPDL($data) {
        return $this->InsertRecord($this->my_table_name, $data);
    }

    public function updatePDL($where, $data) {
        return $this->UpdateRecord($this->my_table_name, $where, $data);
    }

    public function deletePDL($where) {
        return $this->DeleteRecord($this->my_table_name, $where);
    }

    public function getSupportedPDLIDArray($category, $where) {
        switch ($category) {
            case 'Requirement':
                $table = $this->table_requirement_pdl;
                break;
            case 'Spec':
                $table = $this->table_spec_pdl;
                break;
            default:
                $table = '';
                break;
        }
        $this->db->select('PDLID');
        $result = array();
        $objs = $this->GetRecord($table, $where);

        if (is_array($objs)) {
            foreach ($objs as $obj) {
                array_push($result, $obj->PDLID);
            }
        } else {
            array_push($result, $objs->PDLID);
        }
        return $result;
    }

}
