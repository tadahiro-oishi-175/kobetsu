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
class LangController extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function ViewAllLang() {
        $result['langs'] = $this->lang_model->getAllLangs();
        $this->load->view('tag/view_all_lang', $result);
    }

    public function AddTag() {
        if ($this->input->post('submit_AddNewLang') != NULL) {
            $this->BeginTransaction();
            $data = array(
            );
            $id = $this->lang_model->insertLang($data);
            $this->EndTransaction();
            $this->ViewAllLang();
        } else {
            $result['selectOS'] = NULL;
            $this->load->view('case/view_add_newTag', $result);
        }
    }

    public function EditLang($LangID) {
        if ($this->input->post('submit_EditLang') != NULL) {
            $this->BeginTransaction();

            // Edit
            $this->lang_model->updateLang($where, $data);

            $this->EndTransaction();
        } else {
            $result = NULL;
            $this->load->view('', $result);
        }
    }

    public function DeleteTag($LangID) {
        $this->BeginTransaction();

        // Delete
        $this->lang_model->deleteLang($where);

        $this->EndTransaction();
    }
}
