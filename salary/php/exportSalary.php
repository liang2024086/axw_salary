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

	$date1 = $_POST['date1'];
	$date2 = $_POST['date2'];
	$type = $_POST['exportType'];
/*
	$date1 = '2016-02-08';
	$date2 = '2016-02-08';
	$type = '小组活动';
*/
	//创建一个excel对象
	$objPHPExcel = new PHPExcel();
	// Set properties  

/*	$objPHPExcel->getProperties()->setCreator("ctos")
	        ->setLastModifiedBy("ctos")
	        ->setTitle("Office 2007 XLSX Test Document")
	        ->setSubject("Office 2007 XLSX Test Document")
	        ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
	        ->setKeywords("office 2007 openxml php")
	        ->setCategory("Test result file");
	        */
	//设置excel的格式
	//set width  
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);

	//设置行高度  
	$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(22);

	//$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);

	//set font size bold  
	$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);
	//$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
	//$objPHPExcel->getActiveSheet()->getStyle('A2:J2')->getFont();

	$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
																		->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//	$objPHPExcel->getActiveSheet()->getStyle('A2:J2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

	//设置水平居中  
	//$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('E')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('F')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('G')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('H')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	//$objPHPExcel->getActiveSheet()->setCellValueExplicit('B'.$j,$result[1],PHPExcel_Cell_DataType::TYPE_STRING);
	
 //爱心屋工资
          $manager=20;
          $memberSal = 20;
          $teamWork = 20;
		  $holidaySal = 30;
		  $threshold = 800;

	if ($type == '导入表'){
		//$objPHPExcel->getActiveSheet()->mergeCells('A1:E1');
		// set table header content  
		$objPHPExcel->setActiveSheetIndex(0)
		        ->setCellValue('A1', '学号')
		        ->setCellValue('B1', '姓名')
		        ->setCellValue('C1','岗位名称')		        
		        ->setCellValue('D1', '起始日期')
		        ->setCellValue('E1', '结束日期')
		        ->setCellValue('F1', '总酬金')
		        ->setCellValue('G1','学校支付金额')
		        ->setCellValue('H1','聘用单位自付金额');

		//$sql = "select member.stuId,member.name,".$manager."*ifnull((select sum(hours) as hour from salary where date >= '".$date1."' && date <= '".$date2."' && duty = '值班经理' && stuId = member.stuId),0)+".$memberSal."*ifnull((select sum(hours) from salary where date >= '".$date1."' && date <= '".$date2."' && duty = '值班部员' && stuId = member.stuId),0)+".$teamWork."*ifnull((select sum(hours) from salary where date >= '".$date1."' && date <= '".$date2."' && duty = '小组活动' && stuId = member.stuId),0) from member where name != 'admin';";
		$sql = "select member.stuId,member.name,".$manager."*ifnull((select sum(hours) as hour from salary where date >= '".$date1."' && date <= '".$date2."' && duty = '经理值班' && stuId = member.stuId),0    )+".$memberSal."*ifnull((select sum(hours) from salary where date >= '".$date1."' && date <= '".$date2."' && duty = '部员值班' && stuId = member.stuId),0)+".$teamWork."*ifnull((select sum(hours) from salary where date >= '".$date1."' && date <= '".$date2."' && duty = '项目活动' && stuId = member.stuId),0)+".$holidaySal."*ifnull((select sum(hours) from salary where date >= '".$date1."' && date <= '".$date2."' && duty = '节假日值班' && stuId = member.stuId),0)+ifnull((select sum(hours) from salary where date >= '".$date1."' && date <= '".$date2."' && duty = '应加工资' && stuId = member.stuId),0)-ifnull((select sum(hours) from salary where date >= '".$date1."' && date <= '".$date2."' && duty = '应扣工资' && stuId = member.stuId),0)from member where name != 'admin' && wetherIn = '1';";
		if ($result = $mysqli->query($sql)){
			$i = 0;
			while($row = $result->fetch_row()){
				$totalMoney = ceil($row[2]);
			//	$objPHPExcel->getActiveSheet(0)->setCellValue('A' . ($i + 3), $row[0]);
				$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('A' . ($i + 2), $row[0],PHPExcel_Cell_DataType::TYPE_STRING);
			    $objPHPExcel->getActiveSheet(0)->setCellValue('C' . ($i + 2), '爱心屋');
			    $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('B' . ($i + 2), $row[1],PHPExcel_Cell_DataType::TYPE_STRING);
			    $objPHPExcel->getActiveSheet(0)->getStyle('B'. ($i + 2))->getNumberFormat()->setFormatCode("@");
			    $objPHPExcel->getActiveSheet(0)->setCellValue('D' . ($i + 2), $date1);
			    $objPHPExcel->getActiveSheet(0)->setCellValue('E' . ($i + 2), $date2);
			    $objPHPExcel->getActiveSheet(0)->setCellValue('F' . ($i + 2), $totalMoney);
			    if ($totalMoney > $threshold){
			    	$moreMoney = $totalMoney - $threshold;
			    	$objPHPExcel->getActiveSheet(0)->setCellValue('G' . ($i + 2), $threshold);
			    	$objPHPExcel->getActiveSheet(0)->setCellValue('H'.($i+2), $moreMoney);
			    }
			    else{
			    	$objPHPExcel->getActiveSheet(0)->setCellValue('G' . ($i + 2), $totalMoney);
			    	$objPHPExcel->getActiveSheet(0)->setCellValue('H'.($i+2), 0);
			    }
				$i++;
			}
		}

		// Rename sheet  
		$objPHPExcel->getActiveSheet()->setTitle('爱心屋工资记录');


		// Set active sheet index to the first sheet, so Excel opens this as the first sheet  
		$objPHPExcel->setActiveSheetIndex(0);


		// Redirect output to a client’s web browser (Excel5)  
		ob_end_clean();//清除缓冲区,避免乱码
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="爱心屋工资系统导入表(' . date('Ymd-His') . ').xls"');
		header('Cache-Control: max-age=0');
	}
	else if ($type == '详表'){
		$objPHPExcel->createSheet();  
		$objPHPExcel->getActiveSheet(0)->mergeCells('A1:K1');
		// set table header content  
		$objPHPExcel->setActiveSheetIndex(0)
		        ->setCellValue('A1', '上海交通大学绿色爱心屋 员工工资统计表')
		        ->setCellValue('A2', '序号')
		        ->setCellValue('B2', '学号')
		        ->setCellValue('C2', '姓名')
		        ->setCellValue('D2', '学院')
		        ->setCellValue('E2', '所属部门')
		        ->setCellValue('F2', '职务')
		        ->setCellValue('G2', '普通值班')
		        ->setCellValue('H2', '经理值班')
				->setCellValue('I2', '节假日值班')
		        ->setCellValue('J2', '组内小组活动')
		        ->setCellValue('K2', '其他')
		        ->setCellValue('L2', '共计');
		
		 $objPHPExcel->setActiveSheetIndex(1)
		        ->setCellValue('A1', '序号')
		        ->setCellValue('B1', '学号')
		        ->setCellValue('C1', '姓名')
		        ->setCellValue('D1', '学院')
		        ->setCellValue('E1', '所属部门')
		        ->setCellValue('F1', '职务')
		        ->setCellValue('G1', '普通值班')
		        ->setCellValue('H1', '经理值班')
				->setCellValue('I1', '节假日值班')
		        ->setCellValue('J1', '组内小组活动')
		        ->setCellValue('K1', '其他')
		        ->setCellValue('L1', '共计');
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$objPHPExcel->setActiveSheetIndex(0);

		$sql = "select member.stuId, member.name, member.school,member.team,member.duty,
		ifnull((select sum(hours) from salary where  salary.duty = '部员值班' && salary.date >='".$date1."' && salary.date <='".$date2."' 
			&& stuId = member.stuId),0) ,
		ifnull((select sum(hours) from salary where  salary.duty = '经理值班' && salary.date >='".$date1."' && salary.date <='".$date2."' 
			&& stuId = member.stuId),0) ,
		ifnull((select sum(hours) from salary where  salary.duty = '项目活动' && salary.date >='".$date1."' && salary.date <='".$date2."' 
			&& stuId = member.stuId),0) ,
		ifnull((select sum(hours) from salary where  salary.duty = '应加工资' && salary.date >='".$date1."' && salary.date <='".$date2."' 
		    && stuId = member.stuId),0)
		-ifnull((select sum(hours) from salary where  salary.duty = '应扣工资' && salary.date >='".$date1."' && salary.date <='".$date2."' 
		    && stuId = member.stuId),0),
		ifnull((select sum(hours) from salary where salary.duty = '节假日值班' && salary.date >='".$date1."' && salary.date <='".$date2."'
			&& stuId = member.stuId),0)
		from member where name != 'admin' && wetherIn = '1';";
		if ($result = $mysqli->query($sql)){
			$i = 0;
			$numOfmore = 0;
			while($row = $result->fetch_row()){
				$objPHPExcel->setActiveSheetIndex(0);
				$sumSal = $row[5]*$memberSal + $row[6]*$manager + $row[7]*$teamWork+$row[8]+$row[9]*$holidaySal;
				$objPHPExcel->getActiveSheet(0)->setCellValue('A' . ($i + 3), $i+1);
				$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('B' . ($i + 3), $row[0],PHPExcel_Cell_DataType::TYPE_STRING);
			    $objPHPExcel->getActiveSheet(0)->getStyle('B'. ($i + 3))->getNumberFormat()->setFormatCode("@");
			    $objPHPExcel->getActiveSheet(0)->setCellValue('C' . ($i + 3), $row[1]);
			    $objPHPExcel->getActiveSheet(0)->setCellValue('D' . ($i + 3), $row[2]);
			    $objPHPExcel->getActiveSheet(0)->setCellValue('E' . ($i + 3), $row[3]);
			    $objPHPExcel->getActiveSheet(0)->setCellValue('F' . ($i + 3), $row[4]);
			    $objPHPExcel->getActiveSheet(0)->setCellValue('G' . ($i + 3), $row[5]);
			    $objPHPExcel->getActiveSheet(0)->setCellValue('H' . ($i + 3), $row[6]);
			    $objPHPExcel->getActiveSheet(0)->setCellValue('J' . ($i + 3), $row[7]);
				$objPHPExcel->getActiveSheet(0)->setCellValue('K' . ($i + 3), $row[8]);
				$objPHPExcel->getActiveSheet(0)->setCellValue('I' . ($i + 3), $row[9]);
			    $objPHPExcel->getActiveSheet(0)->setCellValue('L' . ($i + 3), $sumSal);
				if ($sumSal > 600){
					$numOfmore++;
					$objPHPExcel->setActiveSheetIndex(1);
					$objPHPExcel->getActiveSheet(1)->setCellValue('A' . ($numOfmore+1), $numOfmore);
				    $objPHPExcel->getActiveSheet(1)->setCellValueExplicit('B' . ($numOfmore+1), $row[0],PHPExcel_Cell_DataType::TYPE_STRING);
				    $objPHPExcel->getActiveSheet(1)->getStyle('B'. ($numOfmore+1))->getNumberFormat()->setFormatCode("@");
				    $objPHPExcel->getActiveSheet(1)->setCellValue('C' . ($numOfmore+1), $row[1]);
				    $objPHPExcel->getActiveSheet(1)->setCellValue('D' . ($numOfmore+1), $row[2]);
				    $objPHPExcel->getActiveSheet(1)->setCellValue('E' . ($numOfmore+1), $row[3]);
				    $objPHPExcel->getActiveSheet(1)->setCellValue('F' . ($numOfmore+1), $row[4]);
				    $objPHPExcel->getActiveSheet(1)->setCellValue('G' . ($numOfmore+1), $row[5]);
				    $objPHPExcel->getActiveSheet(1)->setCellValue('H' . ($numOfmore+1), $row[6]);
				    $objPHPExcel->getActiveSheet(1)->setCellValue('J' . ($numOfmore+1), $row[7]);
				    $objPHPExcel->getActiveSheet(1)->setCellValue('K' . ($numOfmore+1), $row[8]);
					$objPHPExcel->getActiveSheet(1)->setCellValue('I' . ($numOfmore+1), $row[9]);
				    $objPHPExcel->getActiveSheet(1)->setCellValue('L' . ($numOfmore+1), $sumSal);
				}
			    $i++;
			}
		}

		// Rename sheet  
		$objPHPExcel->getActiveSheet(0)->setTitle('爱心屋工资记录');
		$objPHPExcel->setActiveSheetIndex(1);
		$objPHPExcel->getActiveSheet(1)->setTitle('600以上工资记录');

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet  
		$objPHPExcel->setActiveSheetIndex(0);


		// Redirect output to a client’s web browser (Excel5)  
		ob_end_clean();//清除缓冲区,避免乱码
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="爱心屋工资详表(' . date('Ymd-His') . ').xls"');
		header('Cache-Control: max-age=0');
	}
	else if($type == '项目活动'){
		$objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex(0)
		 	        ->setCellValue('A1', '学号')
			        ->setCellValue('B1', '姓名')
			        ->setCellValue('C1','总时长/小时')		        
			        ->setCellValue('D1', '日期')
			        ->setCellValue('E1', '内容')
			        ->setCellValue('F1', '时长/小时');

		$objPHPExcel->setActiveSheetIndex(1)
		            ->setCellValue('A1', '学号')
		            ->setCellValue('B1', '姓名')
		            ->setCellValue('C1','总时长/小时')              
		            ->setCellValue('D1', '日期')
		            ->setCellValue('E1', '内容')
		            ->setCellValue('F1', '时长/小时');

		$sql = "select member.stuId,member.name,ifnull((select sum(hours) from salary where  salary.duty = '项目活动' && salary.date >='".$date1."' && salary.date <='".$date2."'&& stuId = member.stuId),0) AS hour,DATE_FORMAT(salary.date,'%Y-%m-%d'),salary.comment,salary.hours
			from member,salary 
			where name != 'admin' && wetherIn = '1' && member.stuId = salary.stuId && salary.date >='".$date1."' && salary.date <='".$date2."' && salary.duty='项目活动';";
			//&& ifnull((select sum(hours) from salary where  salary.duty = '项目活动' && salary.date >='".$date1."' && salary.date <='".$date2."'&& stuId = member.stuId),0) >= 15;";
		$studentId = '';
		$studentId1 = '';
		if ($result = $mysqli->query($sql)){
			$i = 0;
			$j = 0;
			while($row = $result->fetch_row()){
				$objPHPExcel->setActiveSheetIndex(0);
			//	$objPHPExcel->getActiveSheet(0)->setCellValue('A' . ($i + 3), $row[0]);
			if ($studentId != $row[0]){
				$studentId = $row[0];
				$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('A' . ($i + 2), $row[0],PHPExcel_Cell_DataType::TYPE_STRING);
		    	$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('B' . ($i + 2), $row[1],PHPExcel_Cell_DataType::TYPE_STRING);
				$objPHPExcel->getActiveSheet(0)->getStyle('B'. ($i + 2))->getNumberFormat()->setFormatCode("@");
		    	$objPHPExcel->getActiveSheet(0)->setCellValue('C' . ($i + 2), $row[2]);
			}
			$objPHPExcel->getActiveSheet(0)->setCellValue('D' . ($i + 2), $row[3]);
			$objPHPExcel->getActiveSheet(0)->setCellValue('E' . ($i + 2), $row[4]);
			$objPHPExcel->getActiveSheet(0)->setCellValue('F' . ($i + 2), $row[5]);

			if ($row[2] > 15){
				$objPHPExcel->setActiveSheetIndex(1);
				if ($studentId1 != $row[0]){
	               $studentId1 = $row[0];
	               $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('A' . ($j + 2), $row[0],PHPExcel_Cell_DataType::TYPE_STRING);
	               $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('B' . ($j + 2), $row[1],PHPExcel_Cell_DataType::TYPE_STRING);
	               $objPHPExcel->getActiveSheet(0)->getStyle('B'. ($j + 2))->getNumberFormat()->setFormatCode("@");
	               $objPHPExcel->getActiveSheet(0)->setCellValue('C' . ($j + 2), $row[2]);
	           }
	           $objPHPExcel->getActiveSheet(0)->setCellValue('D' . ($j + 2), $row[3]);
	           $objPHPExcel->getActiveSheet(0)->setCellValue('E' . ($j + 2), $row[4]);
	           $objPHPExcel->getActiveSheet(0)->setCellValue('F' . ($j + 2), $row[5]);

			$j++;
			}
			$i++;
		}
		}

		// Rename sheet  
		$objPHPExcel->getActiveSheet()->setTitle('全体成员');
		$objPHPExcel->setActiveSheetIndex(1);
		$objPHPExcel->getActiveSheet()->setTitle('项目活动时间大于15小时');

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet  
		$objPHPExcel->setActiveSheetIndex(0);


		// Redirect output to a client’s web browser (Excel5)  
		ob_end_clean();//清除缓冲区,避免乱码
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="爱心屋项目活动统计表(' . date('Ymd-His') . ').xls"');
		header('Cache-Control: max-age=0');
	}
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');

	

	// Miscellaneous glyphs, UTF-8  


	

/*	if ($type == '全部')
	//	$sql = "select member.name,member.stId,salary.date,sum(hours) as hour from salary,member where salary.date >='".$date1."' && salary.date <='".$date2."' && member.stuId = salary.stuId group by stuId;";
//$sql = "select  member.stuId, member.name,A.hour * 20 + B.hour * 15 + C.hour * 17 from (select stuId, sum(hours) as hour from salary where date >= '".$date1."' && date <= '".$date2."' && duty = '值班经理' group by stuId) AS A,(select stuId, sum(hours) as hour from salary where date >= '".$date1."' && date <= '".$date2."' && duty = '值班部员' group by stuId) AS B,(select stuId, sum(hours) as hour from salary where date >= '".$date1."' && date <= '".$date2."' && duty = '小组活动' group by stuId) AS C,member where A.stuId = B.stuId && B.stuId = C.stuId && C.stuId = member.stuId;";
		$sql = "select member.name,member.stuId,".$manager."*ifnull((select sum(hours) as hour from salary where date >= '".$date1."' && date <= '".$date2."' && duty = '值班经理' && stuId = member.stuId),0)+".$memberSal."*ifnull((select sum(hours) from salary where date >= '".$date1."' && date <= '".$date2."' && duty = '值班部员' && stuId = member.stuId),0)+".$teamWork."*ifnull((select sum(hours) from salary where date >= '".$date1."' && date <= '".$date2."' && duty = '小组活动' && stuId = member.stuId),0) from member;";
	else
	//	$sql = "select member.name,member.stuId,salary.date,sum(hours) as hour from salary,member where salary.duty = '".$type."' && salary.date >='".$date1."' && salary.date <='".$date2."' && member.stuId = salary.stuId group by stuId;";
		$sql = "select member.name, member.stuId, ifnull((select sum(hours) from salary where  salary.duty = '".$type."' && salary.date >='".$date1."' && salary.date <='".$date2."' && stuId = member.stuId),0) from member;";
	echo $sql."<br>";
	if ($result = $mysqli->query($sql)){
		while($row = $result->fetch_row()){
			for ($i = 0; $i < count($row); $i++)
				echo $row[$i].' ';
			echo '<br>';
		}
	}
*/
/*
	for ($i = 0; $i < count($result) - 1; $i++) {
	    $objPHPExcel->getActiveSheet(0)->setCellValue('A' . ($i + 3), $result[$i]['id']);
	    $objPHPExcel->getActiveSheet(0)->setCellValue('B' . ($i + 3), $result[$i]['realname']);
	    $objPHPExcel->getActiveSheet(0)->setCellValue('C' . ($i + 3), $result[$i]['customer_name']);
	    $objPHPExcel->getActiveSheet(0)->setCellValue('D' . ($i + 3), $OrdersData[$i]['create_time']);
	    $objPHPExcel->getActiveSheet(0)->setCellValue('E' . ($i + 3), $result[$i]['require_product']);
	    $objPHPExcel->getActiveSheet(0)->setCellValue('F' . ($i + 3), $result[$i]['require_count']);
	    $objPHPExcel->getActiveSheet(0)->setCellValue('G' . ($i + 3), $result[$i]['require_time']);
	    $objPHPExcel->getActiveSheet(0)->setCellValue('H' . ($i + 3), $result[$i]['product_bom_encoding']);
	    $objPHPExcel->getActiveSheet(0)->setCellValue('I' . ($i + 3), $result[$i]['delivery_time']);
	    $objPHPExcel->getActiveSheet(0)->setCellValue('J' . ($i + 3), $result[$i]['delivery_memo']);
	    $objPHPExcel->getActiveSheet()->getStyle('A' . ($i + 3) . ':J' . ($i + 3))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	    $objPHPExcel->getActiveSheet()->getStyle('A' . ($i + 3) . ':J' . ($i + 3))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	    $objPHPExcel->getActiveSheet()->getRowDimension($i + 3)->setRowHeight(16);
	}


	// Rename sheet  
	$objPHPExcel->getActiveSheet()->setTitle('订单汇总表');


	// Set active sheet index to the first sheet, so Excel opens this as the first sheet  
	$objPHPExcel->setActiveSheetIndex(0);


	// Redirect output to a client’s web browser (Excel5)  
	ob_end_clean();//清除缓冲区,避免乱码
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="订单汇总表(' . date('Ymd-His') . ').xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
*/
?>
