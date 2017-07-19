<?php
/*
bu dokumandaki kodlar tarafıma (özgün eşim) aittir. izinsiz kullanılamaz!
ozgunesim@gmail.com
http://inoverse.com
*/

if (!defined('BASEPATH')) exit('No direct script access allowed');


//bu fonksyon ogrenci listesi icerigini parse edip array dondurur. hata durumunda false dondurur.
function parseStudentExcel($fullPath){
	//dosyadan gelen encoding tipi: CP1254.
	$source = iconv('CP1254','UTF-8', file_get_contents($fullPath));
	$lines = explode("\n", $source);
	$headerFound = false;
	if ($lines) {
		$students = array();
		foreach ($lines as $line) {
			if($headerFound === true){
				$tempArray = explode("\t", $line);
					//exit(var_dump($tempArray));
				if($tempArray == null || empty($tempArray) || empty($tempArray[0])){
					$headerFound = false;
					break;
					return;
				}
				try{
					$student = new stdClass();
					$student->index = $tempArray[0];
					$student->number = $tempArray[1];
					$student->failure = $tempArray[2];
					$student->surname = $tempArray[3];
					$student->name = $tempArray[4];
					$student->department = $tempArray[5];
					$student->email = $tempArray[6];
					$student->grade = $tempArray[7];
					$student->retake = $tempArray[8];
					$student->state = $tempArray[9];

					array_push($students, $student);
				}catch(Exception $e){
					$headerFound = false;
					return false;
					break;
				}
			}else if(mb_strpos($line, 'Sıra') !== false && mb_strpos($line, 'Email') !== false ){
				$headerFound = true;
				continue;
			}
		}
		if(count($students) > 0)
			return $students;
		else
			return false;

			//fclose($handle);
	} else {
    return false;
	} 
}
?>