<?php

	header("Content-Type: text/html; charset=UTF-8");

	include '../PHPExcel.php';
	include '../PHPExcel/Writer/Excel2007.php';


	//第四个位置填所选数据库名字
	$mysqli = new mysqli('localhost','aixinwu_salary','$aixinwuSalary','aixinwu_salary');
	if(mysqli_connect_errno())
	{
	    echo mysqli_connect_error();
	}
	$mysqli = mysqli_init();
	$mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 2);//设置超时时间
	$mysqli->real_connect('127.0.0.1', 'aixinwu_salary', '$aixinwuSalary', 'aixinwu_salary');

	$errArr = array();
	$inputs = $_POST['salarys'];
	$arr3 = explode("#", $inputs);
	foreach ($arr3 as $sal) {
		if($sal != ""){
			$arr2 = explode("$", $sal);
//			echo $arr2[0] . " " .$arr2[1] . " " .$arr2[2] . " " .$arr2[3] . " " .$arr2[4] . " " .$arr2[5]." ".$arr2[6]."<br>" ;
		
			$sql = "insert into salary (stuId,date,hours,onDuty,duty,recorder,comment) values('".$arr2[0]."','".$arr2[1]."','".$arr2[3]."','".$arr2[2]."','".$arr2[4]."','".$arr2[5]."','".$arr2[6]."');";
			if ($mysqli->query($sql) == false){
				$errArr[] = $arr2[0];
			}
		}
	}
		if(count($errArr) == 0)
			echo "";
		else{
			$errInfo = "";
			foreach ($errArr as $eInfo) {
				$errInfo = $errInfo .$eInfo . "," ;
			}
			echo $errInfo;
	}
?>

