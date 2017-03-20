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
		$type = $_POST['type'];
	?>
	<table id="salaryRecord" name="salaryRecord" cellspacing="0" >
<?php
	if ($type == "经理值班" || $type == "部员值班" || $type == '节假日值班'){?>
		<tr><th>日期</th><th>班次</th><th>时长</th><th>工资类型</th></tr>
		<?php
  		$sql = "select DATE_FORMAT(date,'%Y-%m-%d'),onDuty,hours,duty from salary where stuId='".$account."' && date >= '".$date1."' && date <= '".$date2."' && duty ='".$type."' order by date desc;";
		$sum = 0;
		if ($result = $mysqli->query($sql)){
		   while ($row = $result->fetch_row()) {
			  $sum = $sum + $row[2];
		      echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td></tr>";
		   }   
		}
		echo "<tr><td>总计</td><td></td><td>".$sum."</td><td></td></tr>";
   	}
	else if($type == "项目活动"){
?>
		<tr><th>日期</th><th>班次</th><th>时长</th><th>活动内容</th></tr>
<?php
       $sql = "select DATE_FORMAT(date,'%Y-%m-%d'),onDuty,hours,comment from salary where stuId='".$account."' && date >= '".$date1."' && date <= '".$date2."' && duty ='".$type."' order by date desc;";
       $sum = 0;
       if ($result = $mysqli->query($sql)){
           while ($row = $result->fetch_row()) {
           $sum = $sum + $row[2];
           echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td></tr>";
            }   
       }
         echo "<tr><td>总计</td><td></td><td>".$sum."</td><td></td></tr>";
	}
	else if($type == "全部"){?>
		<tr><th>开始日期</th><th>结束日期</th><th>工资类型</th><th>时长</th><th>工资/小时</th></tr>
		<?php
	//	$sql = "select DATE_FORMAT(date,'%Y-%m-%d'),onDuty,hours,duty from salary where stuId='".$account."' && date >= '".$date1."' && date <= '".$date2."' order by date desc;";
		$sql =" select sum(hours) , duty from salary where stuId='".$account."' && date >= '".$date1."' && date <= '".$date2."'  group by duty order by duty;";
		if ($result = $mysqli->query($sql)){
			$allSalary = 0;
			$hour_sal = 0;
 			while ($row = $result->fetch_row()) {
				if ($row[1] == "经理值班")
					$hour_sal = 20;
				else if ($row[1] == "部员值班")
					$hour_sal = 20;
				else if ($row[1] == "项目活动")
					$hour_sal = 20;
				else if ($row[1] == "节假日值班")
					$hour_sal = 30;
				else if ($row[1] == "应加工资")
					$hour_sal = 1;
				else if ($row[1] == "应扣工资")
					$hour_sal = -1;
				$allSalary = $allSalary + $row[0] * $hour_sal;
 				echo "<tr><td>".$date1."</td><td>".$date2."</td><td>".$row[1]."</td><td>".$row[0]."</td><td>".$hour_sal."</tr>";
			}
			echo "<tr><td></td><td></td><td></td><td>总金额</td><td>".$allSalary."</td></tr>";
  		}
	}
?>

	</table>
