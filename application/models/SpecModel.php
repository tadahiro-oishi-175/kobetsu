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
class SpecModel extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->my_table_name = $this->table_spec_master;
    }

    public function getSpec($where) {
        return $this->GetRecord($this->my_table_name, $where);
    }

    public function insertSpec($data) {
        return $this->InsertRecord($this->my_table_name, $data);
    }

    public function updateSpec($where, $data) {
        return $this->UpdateRecord($this->my_table_name, $where, $data);
    }

    public function deleteSpec($where) {
        $devObjs = $this->development_model->getDevelopment($where);
        if (is_array($devObjs)) {
            foreach ($devObjs as $devObj) {
                $this->development_model->deleteDevelopment(array('DevelopmentID' => $devObj->DevelopmentID));
            }
        } else {
            $devObj = $devObjs;
            $this->development_model->deleteDevelopment(array('DevelopmentID' => $devObj->DevelopmentID));
        }

        $this->DeleteRecord($this->table_spec_pdl, $where);
        $this->DeleteRecord($this->table_spec_os, $where);
        $this->DeleteRecord($this->table_spec_product, $where);
        $this->DeleteRecord($this->table_spec_lang, $where);
        return $this->DeleteRecord($this->my_table_name, $where);
    }

    public function updateTargetInfo($specID, $target, $valueArray) {
        switch ($target) {
            case 'Product':
                $table = $this->table_spec_product;
                $column = 'ProductID';
                break;
            case 'OS':
                $table = $this->table_spec_os;
                $column = 'OSID';
                break;
            case 'PDL':
                $table = $this->table_spec_pdl;
                $column = 'PDLID';
                break;
            case 'Lang':
                $table = $this->table_spec_lang;
                $column = 'LangID';
                break;
            default:
                break;
        }
        $this->DeleteRecord($table, array('SpecID' => $specID));
        foreach ($valueArray as $value) {
            $data = array(
                'SpecID' => $specID,
                $column => $value,
            );
            $this->InsertRecord($table, $data);
        }
    }

    public function addSpecAgreeDoc($data) {
        return $this->InsertRecord($this->table_spec_agreedoc, $data);
    }

    public function updateSpecAgreeDoc($where, $data) {
        $this->UpdateRecord($this->table_spec_agreedoc, $where, $data);
    }
    
    public function delSpecAgreeDoc($where) {
        $this->DeleteRecord($this->table_spec_agreedoc, $where);
    }

    public function getSpecAgreeDocs($SpecID) {
        $this->db->order_by('SequenceNo');
        $objs = $this->db->get_where($this->table_spec_agreedoc, array('SpecID' => $SpecID))->result();
        foreach ($objs as $obj) {
            $agreedocObj = $this->agreedoc_model->getAgreeDoc(array('AgreeDocID' => $obj->AgreeDocID));
            $obj->DocID = $obj->AgreeDocID;
            $obj->DocName = $agreedocObj->AgreeDocName;
        }
        return $objs;
    }

    public function getMaxSequenceNo($where) {
        $this->db->select_max('SequenceNo');
        return $this->db->get_where($this->table_spec_agreedoc, $where)->row()->SequenceNo;
    }

    public function getSpecAgreeDocArray($where) {
        $result = array();
        $this->db->order_by('AgreeDocID');
        $objs = $this->db->get_where($this->table_spec_agreedoc, $where)->result();
        foreach ($objs as $obj) {
            $result += array($obj->AgreeDocID => $obj->SequenceNo);
        }
        return $result;
    }

}
