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
class ProductController extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function ViewAllProducts() {
        $result['outputs'] = $this->product_model->getAllProducts();
        $this->load->view('product/view_all_product', $result);
    }

    public function AddProduct() {
        if ($this->input->post('submit_AddNewProduct') != NULL) {
            $this->BeginTransaction();
            $data = array(
                'ProductName' => $this->input->post('ProductName'),
            );
            
            $id = $this->product_model->insertProduct($data);
            $this->EndTransaction();
            $this->ViewAllProducts();
        } else {
            $result['selectOS'] = NULL;
            $this->load->view('product/view_add_newProduct', $result);
        }
    }

    public function EditProduct($ProductID) {
        if ($this->input->post('submit_EditProduct') != NULL) {
            $this->BeginTransaction();

            // Edit
            $this->product_model->updateProduct($where, $data);

            $this->EndTransaction();
        } else {
            $result = NULL;
            $this->load->view('', $result);
        }
    }

    public function DeleteProduct($ProductID) {
        $this->BeginTransaction();

        // Delete
        $this->product_model->deleteProduct($where);

        $this->EndTransaction();
    }
}
