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

	$stuId = $_POST['stuId'];
	$auth = $_POST['auth'];

	$sql = "update member set authority ='".$auth."' where stuId='".$stuId."';";
	$result = $mysqli->query($sql);
	if (!$result){
		echo "更新失败";
	}
	else{
		if ($mysqli->affected_rows == 0)
			echo "权限未变";
		else echo "更新成功";
	}
?>
