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

	$orgiPwd = $_POST['orgiPwd'];
	$changePwd = $_POST['changePwd'];
	$stuId = $_POST['changeID'];


	$sql = "update member set pwd='".$changePwd."' where stuId='".$stuId."';";
	if ($mysqli->query($sql) == false){
		?>
		<script type="text/javascript">
			alert('修改失败');
		</script>
	<?php
	}
	else{
		?>
		<script type="text/javascript">
			alert('修改成功');
		</script>
		<?php
	}
?>

<script type="text/javascript">
	window.location.href="../index.php";
</script>
