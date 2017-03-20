<?php
	//第四个位置填所选数据库名字
		$mysqli = new mysqli('localhost','aixinwu_salary','$aixinwuSalary','aixinwu_salary');
		if(mysqli_connect_errno())
		{
		    echo mysqli_connect_error();
		}
		$mysqli = mysqli_init();
		$mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 2);//设置超时时间
		$mysqli->real_connect('127.0.0.1', 'aixinwu_salary', '$aixinwuSalary', 'aixinwu_salary');
		
		$account = $_POST['stuId'];
		$date1 = $_POST['date1'];
		$date2 = $_POST['date2'];
	?>
	<table id="searchRecordSalary" name="searchRecordSalary" cellspacing="0" >
		<tr><th>日期</th><th>班次</th><th>学号</th><th>姓名</th><th>时长</th><th>工资类型</th><th></th></tr>
		<?php
  		$sql = "select DATE_FORMAT(salary.date,'%Y-%m-%d'),salary.onDuty,salary.stuId,member.name,salary.hours,salary.duty from salary,member where salary.stuId = member.stuId && recorder='".$account."' && date >= '".$date1."' && date <= '".$date2."' order by date desc;";
		if ($result = $mysqli->query($sql)){
		   while ($row = $result->fetch_row()) {
		      echo "<tr id='".$row[0]."|".$row[1]."|".$row[2]."'><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td>".$row[5]."</td><td><button onclick=\"deleteRow1('".$row[0]."|".$row[1]."|".$row[2]."');\">删除</button></td></tr>";
//echo "<tr id='".$row[0]."|".$row[1]."|".$row[2]."'><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td>".$row[5]."</td><td><button onclick=\"addRo()\">删除</button></td></tr>";
			}   
		}
?>

	</table>
