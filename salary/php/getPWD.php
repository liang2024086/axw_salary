<?php
	require_once ('email.class.php');
	header("Content-Type: text/html;charset=UTF-8");

	$stuId = $_POST['stuId'];
	
	$mysqli = new mysqli('localhost','aixinwu_salary','$aixinwuSalary','aixinwu_salary');
	if(mysqli_connect_errno())
	{
        echo mysqli_connect_error();
    }
    $mysqli = mysqli_init();
    $mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 2);//设置超时时间
    $mysqli->real_connect('127.0.0.1', 'aixinwu_salary', '$aixinwuSalary', 'aixinwu_salary');

	$sql = "select name,pwd,mail from member where stuId='".$stuId."';";
	if ($result = $mysqli->query($sql)){
		if ($mysqli->affected_rows != 0){
			while ($row = $result->fetch_row()){
				$smtp = new smtp("smtp.163.com","25",true,"18817874995","liang2024086");
				//$smtp = new smtp("smtp.163.com","25",true,"aixinwu_salary","aixinwu5672");    //这里面的一个true是表示使用身份验证,否则不使用身份验证.这里的aaa为你的邮箱>    。
		    	$smtp->debug = FALSE;//是否显示发送的调试信息
		    	$smtp->sendmail($row[2], "18817874995@163.com", "爱心屋密码", $row[0]."同学:<br>&nbsp&nbsp 您好！<br> &nbsp&nbsp 您的密码为".$row[1], "HTML");
			    //$smtp->sendmail($row[2], "aixinwu_salary@163.com", "爱心屋密码", $row[0]."同学:<br>&nbsp&nbsp 您好！<br> &nbsp&nbsp 您的密码为".$row[1], "HTML");
//			echo $row[0].$row[1].$row[2];
			}
		echo "|发送成功";
		}
		else{
			echo "|学号错误";
		}
	}
	else{
		echo "|学号错误";
	}

//	$smtp = new smtp("smtp.163.com","25",true,"18817874995","liang2024086");//这里面的一个true是表示使用身份验证,否则不使用身份验证.这里的aaa为你的邮箱。
//	$smtp->debug = FALSE;//是否显示发送的调试信息
//	$smtp->sendmail('360323820@qq.com', "18817874995@163.com", "请查看你的新密码", "您的新密码为123456", "HTML");
	//$newpass=MD5($newpass);           //其中aaa最好跟上面的一样，不然很可能有错误。
	//$query=mysql_query("update `information` set `pwd`='$newpass' where `user`='$user'") or die ('密码修改失败');          //修改数据库中密码。
//	echo "<script>alert('新密码已发送至您的邮箱，请查看');location.href='login.php'</script>";

	error_reporting(E_ALL ^ E_NOTICE);
?>
