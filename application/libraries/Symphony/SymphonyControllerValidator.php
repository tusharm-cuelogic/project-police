<?PHP
$script_path = $argv[1];

include $script_path;

class SymphonyControllerValidator {

	private $fileContent;

	public function __construct($script_path){

		$this->fileContent = "";
		print $this->validate($script_path);
	}

	private function validate($script_path){
		$duplicateReturnStatements = (int)$this->actionUsagePurpose($script_path);
		$queriesStatements = (int)$this->findQueries();

		$result = array();
		if($duplicateReturnStatements > 0){
			$result["duplicate-return"] = "Functions has code to render HTML as well as returning JSON. Occurrence: " . ($duplicateReturnStatements / 2);
		}
		if($queriesStatements > 0){
			$result["queries-in-controller"] = "Code has MySQL queries in controller. Occurrence: " . $queriesStatements;
		}

		return (count($result) == 0) ? "" : json_encode($result);
	}

	private function actionUsagePurpose($script_path){
		$fileObject = fopen($script_path, "r") or die("Unable to open file!");

		$duplicateReturnStatements = array();

		// Output one line until end-of-file
		while(!feof($fileObject)) {

		  $line = str_replace(" ","",trim(fgets($fileObject)));
		  $this->fileContent = $this->fileContent . $line;

		  // Controller having API and template rendering
			if (strpos($line, 'return') !== false || strpos($line, '$this->render(') 
				|| strpos($line, 'newResponse(') || strpos($line, 'newRedirectResponse(') 
				|| strpos($line, 'newJsonResponse(') !== false) {
		    $duplicateReturnStatements[] = $line;
			}
		}

		fclose($fileObject);

		return count($duplicateReturnStatements);
	}

	private function findQueries(){

		preg_match_all('/(SELECT).*(FROM)/', $this->fileContent, $select, PREG_PATTERN_ORDER);
		preg_match_all('/(UPDATE).*(SET)/', $this->fileContent, $update, PREG_PATTERN_ORDER);
		preg_match_all('/(INSERT).*(INTO)/', $this->fileContent, $insert, PREG_PATTERN_ORDER);
		preg_match_all('/(DELETE).*(FROM)/', $this->fileContent, $delete, PREG_PATTERN_ORDER);

		if (count($select[0][0]) || count($update[0][0]) || count($insert[0][0]) || count($delete[0][0])){
			return true;
		} else {
			return false;
		}
	}
}

new SymphonyControllerValidator($script_path);

?>