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
class DocumentController extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function ViewAllOutputDocs() {
        $result['outputs'] = $this->outputdoc_model->getAllOutputs();
        $this->load->view('output/view_all_output', $result);
    }

    public function AddOutput() {
        if ($this->input->post('submit_AddNewOutput') != NULL) {
            $this->BeginTransaction();
            $data = array(
                'OutputName' => $this->input->post('OutputName'),
            );

            $id = $this->output_model->insertOutput($data);
            $this->EndTransaction();
            $this->ViewAllOutputs();
        } else {
            $result['selectOS'] = NULL;
            $this->load->view('output/view_add_newOutput', $result);
        }
    }

    public function EditOutput($OutputID) {
        if ($this->input->post('submit_EditOutput') != NULL) {
            $this->BeginTransaction();

            // Edit
            $this->output_model->updateOutput($where, $data);

            $this->EndTransaction();
        } else {
            $result = NULL;
            $this->load->view('', $result);
        }
    }

    public function DeleteDocument($category, $id) {
        $this->BeginTransaction();
        switch ($category) {
            case 'AttachedDoc':
                $this->case_model->delCaseAttached(array('AttachedID' => $id));
                $this->attached_model->deleteAttached(array('AttachedID' => $id));
                break;
            case 'HandOffDoc':
                $this->requirement_model->delRequirementHandOff(array('HandOffDocID' => $id));
                $this->handoffdoc_model->deleteHandOffDoc(array('HandOffDocID' => $id));
                break;
            case 'AgreeDoc':
                $this->spec_model->delSpecAgreeDoc(array('AgreeDocID' => $id));
                $this->agreedoc_model->deleteAgreeDoc(array('AgreeDocID' => $id));
                break;
            default:
                break;
        }
        $this->EndTransaction();
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function DeleteOutput($OutputID) {
        $this->BeginTransaction();

        // Delete
        $this->output_model->deleteOutput($where);

        $this->EndTransaction();
    }

    public function UpdateSequence($category, $id) {
        $newOrderArray = array_flip($this->input->post('item'));
        ksort($newOrderArray);

        switch ($category) {
            case 'AttachedDoc':
                $where = array('CaseID' => $id);
                $currentOrderArray = $this->case_model->getCaseAttached($where);
                if (key($newOrderArray) == key($currentOrderArray)) {
                    $this->BeginTransaction();
                    foreach ($currentOrderArray as $key => $val) {
                        if ($val != $newOrderArray[$key]) {
                            $data = array('SequenceNo' => $newOrderArray[$key]);
                            $this->case_model->updateCaseAttached(array('AttachedID' => $key), $data);
                        }
                    }
                    $this->EndTransaction();
                }
                break;
            case 'HandOffDoc':
                $where = array('RequirementID' => $id);
                $currentOrderArray = $this->requirement_model->getRequirementHandOffArray($where);
                if (key($newOrderArray) == key($currentOrderArray)) {
                    $this->BeginTransaction();
                    foreach ($currentOrderArray as $key => $val) {
                        if ($val != $newOrderArray[$key]) {
                            $data = array('SequenceNo' => $newOrderArray[$key]);
                            $this->requirement_model->updateRequirementHandOff(array('HandOffDocID' => $key), $data);
                        }
                    }
                    $this->EndTransaction();
                }
                break;
            case 'AgreeDoc':
                $where = array('SpecID' => $id);
                $currentOrderArray = $this->spec_model->getSpecAgreeDocArray($where);
                if (key($newOrderArray) == key($currentOrderArray)) {
                    $this->BeginTransaction();
                    foreach ($currentOrderArray as $key => $val) {
                        if ($val != $newOrderArray[$key]) {
                            $data = array('SequenceNo' => $newOrderArray[$key]);
                            $this->spec_model->updateSpecAgreeDoc(array('AgreeDocID' => $key), $data);
                        }
                    }
                    $this->EndTransaction();
                }
                break;
            default:
                break;
        }
    }

}
