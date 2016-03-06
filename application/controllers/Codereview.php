<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Codereview extends CI_Controller {

	public function index()
	{
        $filePath = $this->input->post();
        
        $modelResponse = "";
        $controllerResponse = "";
        $this->load->library('Symphony/Symphony');
        if (strstr($filePath['file_path'], "models")) {
        	$modelResponse = $this->symphony->validateModel(array('file_type' => 'model', 'file_path' => $filePath['file_path']));
        }
        
        if (strstr($filePath['file_path'], "controllers")) {
        	$controllerResponse = $this->symphony->validateController(array('file_type' => 'controller', 'file_path' => $filePath['file_path']));
        }
        
        // $duplicateResponse = $this->symphony->validateDuplicate(array('file_type' => 'duplicate_code', 'file_path' => $filePath['file_path']));

        $output = array($modelResponse, $controllerResponse);
        print json_encode($output);
	}
}
