<?php

	header("Content-Type: text/html; charset=UTF-8");

	include '../PHPExcel.php';
	include '../PHPExcel/Writer/Excel2007.php';


	//第四个位置填所选数据库名字
	$mysqli = new mysqli('localhost','root','liang','aixinwuSalary');
	if(mysqli_connect_errno())
	{
	    echo mysqli_connect_error();
	}
	$mysqli = mysqli_init();
	$mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 2);//设置超时时间
	$mysqli->real_connect('127.0.0.1', 'root', 'liang', 'aixinwuSalary');


	$errArr = array();
	$inputs = $_POST['salaryHidden'];
	$arr = explode(",", $inputs);
	foreach ($arr as $key) {
		$arr2 = explode(",", $_POST[$key]);
	/*	foreach ($arr2 as $key2) {
			echo $key2."<br>";
		}
		echo $arr2[0] . " " .$arr2[1] . " " .$arr2[2] . " " .$arr2[3] . " " .$arr2[4] . " " .$arr2[5]."<br>" ;
*/
		$sql = "insert into salary (stuId,date,hours,onDuty,duty,recorder) values('".$arr2[0]."','".$arr2[1]."','".$arr2[3]."','".$arr2[2]."','".$arr2[4]."','".$arr2[5]."');";
	//	echo $sql."<br>";
		if ($mysqli->query($sql) == false){
			$errArr[] = $arr2[0];
		}
			/*<script type="text/javascript">
				alert($arr2.'添加失败');
			</script>*/

	}

	if (count($errArr) == 0){?>
		<script type="text/javascript">
			alert('添加成功');
		</script>
	<?php
	}
	else{
		$errInfo = "";
		foreach ($errArr as $eInfo) {
			$errInfo = $errInfo . "," .$eInfo;
		}
		echo "<input type='hidden' id='output' value='".$errInfo."'/>";
		?>
		<script type="text/javascript">
			alert(document.getElementById('output').value+'添加失败');		
		</script>
		<?php
	}	
?>

<script>
	window.location.href="../login.html";
</script>