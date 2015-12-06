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
class ProductModel extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->my_table_name = $this->table_product_master;
    }

    public function getAllProducts() {
        return $this->GetAllRecords($this->my_table_name);
    }

    public function getAllProductNameArray() {
        $result = array();
        $productObjs = $this->getAllProducts();
        foreach ($productObjs as $prodObj) {
            $result += array($prodObj->ProductID => $prodObj->ProductName);
        }
        return $result;
    }

    public function getProduct($where) {
        return $this->GetRecord($this->my_table_name, $where);
    }

    public function insertProduct($data) {
        return $this->InsertRecord($this->my_table_name, $data);
    }

    public function updateProduct($where, $data) {
        return $this->UpdateRecord($this->my_table_name, $where, $data);
    }

    public function deleteProduct($where) {
        return $this->DeleteRecord($this->my_table_name, $where);
    }

    public function getSupportedProductIDArray($category, $where) {
        switch ($category) {
            case 'Requirement':
                $table = $this->table_requirement_product;
                break;
            case 'Spec':
                $table = $this->table_spec_product;
                break;
            default:
                $table = '';
                break;
        }
        $this->db->select('ProductID');
        $result = array();
        $objs = $this->GetRecord($table, $where);

        if (is_array($objs)) {
            foreach ($objs as $obj) {
                array_push($result, $obj->ProductID);
            }
        } else {
            array_push($result, $objs->ProductID);
        }
        return $result;
    }

}
