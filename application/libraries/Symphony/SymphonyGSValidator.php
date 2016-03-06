#!/usr/bin/php5
<?PHP
ini_set(error_reporting,E_ALL);
ini_set("display_errors",1);

class myParent {
  function parentFunc() {
    echo "Parent Function Output\n";
  }
}

class myChild {
}

print 1;

runkit_class_adopt('myChild','myParent');
print 2;
$mychilde = new myChild();
$mychilde->parentFunc();

// $script_path = $argv[1];
// print $class = $argv[2];

// // $script_path = "../Extract.php";
// // $class = "Extract";

// include $script_path;

// class SymphonyGSValidator {

// 	public function __construct(){
// 	}

// 	public function validate($class_name){
// 		$class = new $class_name();
// 		$class_methods = get_class_methods($class);
// 		$class_vars = get_class_vars($class_name);

// 		print count($class_vars);

// 		print ((count($class_vars) * 2) == count($class_methods)) ? "" : "Module $class has unwanted methods.";
// 	}
// }

// print "1";
// runkit_class_adopt('SymphonyGSValidator',$class);
// print "2";
// $validator = new SymphonyGSValidator();
// $validator->validate($class);
?>