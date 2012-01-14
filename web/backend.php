<?php

$filename  = dirname(__FILE__).'/data.txt';
$filename2  = dirname(__FILE__).'/data2.txt';

// store new message in the file
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
if ($msg != '')
{
  file_put_contents($filename,$msg);
  die();
}

$msg2 = isset($_GET['msg2']) ? $_GET['msg2'] : '';
if ($msg2 != '')
{
  file_put_contents($filename2,$msg2);
  die();
}

// infinite loop until the data file is not modified
$lastmodif    = isset($_GET['timestamp']) ? $_GET['timestamp'] : 0;
$lastmodif2    = isset($_GET['timestamp2']) ? $_GET['timestamp2'] : 0;

$currentmodif = filemtime($filename);
$currentmodif2 = filemtime($filename2);

while ($currentmodif <= $lastmodif || $currentmodif2 <= $lastmodif2 ) // check if the data file has been modified
{
  usleep(10000); // sleep 10ms to unload the CPU
  clearstatcache();
  
 // if($currentmodif > $lastmodif)
// if(isset($_GET['msg'])){
		$currentmodif = filemtime($filename);
	//}else{
		//$currentmodif2 = filemtime($filename2);
	//}

}

// return a json array

	
	// if(isset($_GET['msg'])){
		$response = array();
		$response['msg']       = file_get_contents($filename);
		$response['timestamp'] = $currentmodif;
		echo json_encode($response);
	// }elseif (isset($_GET['msg2'])){
	
	// $response = array();
	// $response['msg2']       = file_get_contents($filename2);
	// $response['timestamp2'] = $currentmodif2;
	// echo json_encode($response);
	// }



flush();

?>