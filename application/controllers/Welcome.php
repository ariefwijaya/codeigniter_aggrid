<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('view_test');
	}

	public function getGridRows()
    {
        $this->load->model('grid_model');
        $request = json_decode($this->input->post('request'));
        $this->grid_model->initiateUserData($request);
        $data['status'] = true;
        $data['data'] = $this->grid_model->getGridRows();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
    function deleteData()
    {
        $this->load->library('form_validation');
        $this->load->model('test_model');
        $varKey = array(
            array('field' => 'remarkdeleted', 'label' => 'Remarks', 'rules' => 'required'),
        );
        $this->form_validation->set_error_delimiters('', '')->set_rules($varKey);

        if ($this->form_validation->run() == FALSE) {
            $response['status'] = false;
            $response['validation'] = $this->form_validation->error_array(); //$validationError; 
            $this->output->set_content_type('application/json')->set_output(json_encode($response));
        } else {
            $dataProcess = array();
            foreach ($varKey as $key => $value) {
                $field = $value['field'];
                $valPost = $this->input->post($field);
                $formattedVal = $valPost == "" ? NULL : $valPost;
                if ($field == "remarkdeleted") {
                    $formattedVal = substr($valPost, 0, 199);
                }
                $dataProcess[$field] = $formattedVal;
            }

            // $dataProcess['dby'] = "Anonim";//$this->session->userdata('username');
            // $dataProcess['isdeleted'] = 1;
            // $date = new DateTime('now');
            // $dataProcess['ddt'] = $date->format('Y-m-d H:i:s');
            $whereId = $this->input->post('id');
            $statusProcess = $this->test_model->delete($whereId);
            if ($statusProcess) {
                $response['status'] = true;
                $response['data'] = "Data has been Deleted";
            } else {
                $response['status'] = false;
                $response['error'] = "Failed to delete data";
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($response));
        }
    }
	
	public function getListData()
    {
        $this->load->model('test_model');
        $search = $this->input->post('search');
        $pageNumber = $this->input->post('page');
        $rowPerPage = 5;
        // Row position
        $offset = is_null($pageNumber) || $pageNumber == 0 ? 0 : ($pageNumber - 1) * $rowPerPage;
        $result = $this->test_model->getListData($rowPerPage, $offset, $search);
        $total = $this->test_model->getListDataTotal($search);

        $response = array(
            "results" => $result,
            "pagination" => array(
                "more" => ($pageNumber * $rowPerPage) < $total
            )
        );

        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }
}
