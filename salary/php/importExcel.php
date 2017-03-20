<?php

	set_time_limit(120);
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

	$judge = 1;
	

  if ($_FILES["file"]["error"] > 0)
  {
  echo "Error: " . $_FILES["file"]["error"] . "<br />";
  }
  else
  {
#  echo "Upload: " . $_FILES["file"]["name"] . "<br />";
#  echo "Type: " . $_FILES["file"]["type"] . "<br />";
#  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
#  echo "Stored in: " . $_FILES["file"]["tmp_name"] . "<br>";
  $filename = "upload/" . $_FILES["file"]["name"];
  if (file_exists($filename))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      	if (file_exists($_FILES["file"]["tmp_name"])){
      		//将编码方式改成utf-8才能成功
      		if( move_uploaded_file( $_FILES["file"]["tmp_name"],mb_convert_encoding($filename,"gbk", "utf-8")))
      			echo "Stored in: " . $filename;
      	}
      
      }

    echo "<br> ";

    $filename = mb_convert_encoding($filename,"gbk", "utf-8");
    // Check prerequisites
	if (!file_exists($filename)) {
		exit("not found "+$filename+"\n");
	}

	$reader = PHPExcel_IOFactory::createReader('Excel2007'); //设置以Excel2007格式
	$PHPExcel = $reader->load($filename); // 载入excel文件
	$sheet = $PHPExcel->getSheet(0); // 读取第一個工作表
	$highestRow = $sheet->getHighestRow(); // 取得总行数
	$highestColumm = $sheet->getHighestColumn(); // 取得总列数
	$highestColumm= PHPExcel_Cell::columnIndexFromString($highestColumm); //字母列转换为数字列 如:AA变为27

	/** 循环读取每个单元格的数据 */
	for ($row = 1; $row <= $highestRow; $row++){//行数是以第1行开始
	    /*for ($column = 0; $column < $highestColumm; $column++) {//列数是以第0列开始
	        $columnName = PHPExcel_Cell::stringFromColumnIndex($column);
	        echo $columnName.$row.":".$sheet->getCellByColumnAndRow($column, $row)->getValue()."";
	    }*/
	    $name = $sheet->getCellByColumnAndRow(0, $row)->getValue();
	    $gender = $sheet->getCellByColumnAndRow(1, $row)->getValue();
	    if ('' != $sheet->getCellByColumnAndRow(2, $row)->getValue())
	    	$team = $sheet->getCellByColumnAndRow(2, $row)->getValue();
	    $duty = $sheet->getCellByColumnAndRow(3, $row)->getValue();
	    $stuId = $sheet->getCellByColumnAndRow(4, $row)->getValue();
	    $school = $sheet->getCellByColumnAndRow(5, $row)->getValue();
	    $phone = $sheet->getCellByColumnAndRow(6, $row)->getValue();
	    $e_mail = $sheet->getCellByColumnAndRow(7, $row)->getValue();
	    $pwd = $stuId;
	    $wetherIn = 1;
	    if ($duty == '辅导员' || $duty == '部长')
	    	$authority = 'ttttt';
		else
			$authority = 'tffff';

/*	    elseif ($duty == '副部长' || $duty == '代理副部长') {
	    	$authority ='ttttf';
	    }
	    elseif ($duty == '项目负责人' || $duty == '值班经理') {
	    	$authority = 'tftff';
	    }
	    elseif ($duty == '部员') {
	    	$authority = 'tffff';
	    }
		else{
			$authority = 'tffff';
		}
*/
	   if ($row == 1){
	    	if ($name == '姓名' && $gender == '性别' && $team == '团队' && $duty=='职务' && $stuId == '学号' && $school=='学院' && $phone=='联系方式' && $e_mail == '邮箱')
	    	{
	    		$sql = "update member set wetherIn = '0' where name != 'admin';";
	    		if ($mysqli->query($sql) == false){
	    			echo $stuId."update error <br>";
	    		}
	    		else{
	    			echo $stuId."update succeed <br>";
	    		}
	    		continue;
	    	}
	    	else break;
	    }
	    if ($name == '') break;
	    if ($team == '团队')
	    	$team = '';
	    $sql = "select name from member where stuId = '".$stuId."';";
	    if ($result = $mysqli->query($sql)){

	    	if ($result->fetch_row() != null){
	    		$sql = "update member set team= '".$team."',duty = '".$duty."', wetherIn = '1', authority='".$authority."', phone = '".$phone."' where stuId = '".$stuId."';";
	    		if ($mysqli->query($sql) == false){
	    			echo $stuId."update failed ".$sql."<br>";
	    			$judge = 0;
	    		}
	    		else echo $stuId."update succeed<br>";
	    	}
	    	else{
	    		$sql = "insert into member (name,pwd,gender,team,duty,stuId,school,phone,mail,authority,wetherIn) values('".$name."','".$pwd."','".$gender."','".$team."','".$duty."','".$stuId."','".$school."','".$phone."','".$e_mail."','".$authority."','".$wetherIn."');";
			    if ($mysqli->query($sql) == false){
			    	echo $name."ERROR<br>";
			    	$judge = 0;
			    }
			    else echo $name . " " .$gender." " .$team." " . $duty ." " . $stuId ." " .$school." " .$phone." " .$e_mail."<br>";
	    	}
	    }

	    


	}

	if ($judge == 0){
		?>
		<script>
						alert("导入失败，请重新导入");
		</script>
	<?php
	}

	elseif ($judge == 1) {
	?>
			    	<script>
						alert("导入成功");
					</script>
	
	<?php	
	}
	?>
	<script>
		window.location.href="../index.php";
	</script>

	<?php

  }

  $mysqli->close();

?>
