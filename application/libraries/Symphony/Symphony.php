<?php

class Symphony{

	private $file_path;
	private $file_type;
	private $class_name;

	public function __construct(){

	}

	private function setVariables($arguments){
		$this->file_path 	= $arguments["file_path"];
		$this->file_type 	= $arguments["file_type"];

		$class_path = array_reverse(explode("/", $this->file_path));
		$file_name = explode(".",$class_path[0]);
		$this->class_name = $file_name[0];

	}

	public function validateModel($arguments){
		$this->setVariables($arguments);
		if ($this->file_type) {
			$message = exec("php -f application/libraries/Symphony/SymphonyGSValidator.php ".$this->file_path." ".$this->class_name);
		}
		return $message;
	}

	public function validateController($arguments){
		$this->setVariables($arguments);
		if ($this->file_type) {
			$message = exec("php -f application/libraries/Symphony/SymphonyControllerValidator.php ".$this->file_path);
		}
		return $message;
	}

	public function validateDuplicate($arguments){
		$this->setVariables($arguments);
		if ($this->file_type) {
			
			exec("phpcpd ".$this->file_path.' 2>&1', $output, $return_value);
			$message = "";

			if (count($output) && is_array($output)) {
				foreach ($output as $line) {
					if(strpos($line, "% duplicated lines") !== false && strpos($line, "0.00% duplicated lines") === false){
						$message = $line;
					}
				}
			}
		}
		return $message;
	}
}

?>