<?php
	$mysqli = new mysqli('localhost','aixinwu_salary','$aixinwuSalary','aixinwu_salary');
    if(mysqli_connect_errno())
    {
        echo mysqli_connect_error();
    }
    $mysqli = mysqli_init();
    $mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 2);//设置超时时间
    $mysqli->real_connect('127.0.0.1', 'aixinwu_salary', '$aixinwuSalary', 'aixinwu_salary');

	$account = $_POST['stuId'];
	$date = $_POST['date'];
	$onDuty = $_POST['duty'];

	$sql = "delete from salary where stuId='".$account."' && date = '".$date."' && onDuty='".$onDuty."';";
//	echo $sql;
	if ($mysqli->query($sql) == false)
		echo "删除失败";
	else echo "删除成功";
?>
