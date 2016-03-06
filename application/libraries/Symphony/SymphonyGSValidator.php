<?PHP
ini_set(error_reporting,E_ALL);
ini_set("display_errors",1);

$script_path = $argv[1];
$class = $argv[2];

// $script_path = "../Extract.php";
// $class = "Extract";

include $script_path;

class SymphonyGSValidator {

	public function __construct(){
	}

	public function validate($class_name){
		$class = new $class_name();
		$class_methods = get_class_methods($class);
		$class_vars = get_class_vars($class_name);

		$class_methods_count = (int)count($class_methods);
		$class_vars_count = (int)count($class_vars) * 2;

		if ($class_vars_count == $class_methods_count)
			print "";
		else
			print "Module $class_name has unwanted methods.";
	}
}

runkit_class_adopt('SymphonyGSValidator',$class);
$validator = new SymphonyGSValidator();
$validator->validate($class);
?>