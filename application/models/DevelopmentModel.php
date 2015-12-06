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
class DevelopmentModel extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->my_table_name = $this->table_development_master;
    }

    public function getDevelopment($where) {
        return $this->GetRecord($this->my_table_name, $where);
    }

    public function insertDevelopment($data) {
        return $this->InsertRecord($this->my_table_name, $data);
    }

    public function updateDevelopment($where, $data) {
        return $this->UpdateRecord($this->my_table_name, $where, $data);
    }

    public function deleteDevelopment($where) {
        $this->DeleteRecord($this->table_development_os, $where);
        $this->DeleteRecord($this->table_development_pdl, $where);
        $this->DeleteRecord($this->table_development_lang, $where);
        return $this->DeleteRecord($this->my_table_name, $where);
    }

    public function updateTargetInfo($developmentID, $target, $valueArray) {
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

//    public function updateTargetInfo($specID, $target, $valueArray) {
//        switch ($target) {
//            case 'OS':
//                $this->DeleteRecord($this->table_spec_os, array('SpecID' => $specID));
//                foreach ($valueArray as $value) {
//                    $data = array(
//                        'SpecID' => $specID,
//                        'OSID' => $value,
//                    );
//                    $this->InsertRecord($this->table_spec_os, $data);
//                }
//                break;
//            default:
//                break;
//        }
//    }
}
