<?php
	
	header("Content-Type: text/html; charset=UTF-8");

	include '../PHPExcel.php';
	include '../PHPExcel/Writer/Excel2007.php';


	//第四个位置填所选数据库名字
	$mysqli = new mysqli('localhost','sjtu','dywb!3396','sjtu_aixin');
	if(mysqli_connect_errno())
	{
	    echo mysqli_connect_error();
	}
	$mysqli = mysqli_init();
	$mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 2);//设置超时时间
	$mysqli->real_connect('127.0.0.1', 'sjtu', 'dywb!3396', 'sjtu_aixin');

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
	if (true){
		//$objPHPExcel->getActiveSheet()->mergeCells('A1:E1');
		// set table header content  
		$objPHPExcel->setActiveSheetIndex(0)
		        ->setCellValue('A1', '编号')
		        ->setCellValue('B1', '手机号');

		//$sql = "select member.stuId,member.name,".$manager."*ifnull((select sum(hours) as hour from salary where date >= '".$date1."' && date <= '".$date2."' && duty = '经理值班' && stuId = member.stuId),0    )+".$memberSal."*ifnull((select sum(hours) from salary where date >= '".$date1."' && date <= '".$date2."' && duty = '部员值班' && stuId = member.stuId),0)+".$teamWork."*ifnull((select sum(hours) from salary where date >= '".$date1."' && date <= '".$date2."' && duty = '项目活动' && stuId = member.stuId),0)+".$holidaySal."*ifnull((select sum(hours) from salary where date >= '".$date1."' && date <= '".$date2."' && duty = '节假日值班' && stuId = member.stuId),0)+ifnull((select sum(hours) from salary where date >= '".$date1."' && date <= '".$date2."' && duty = '应加工资' && stuId = member.stuId),0)-ifnull((select sum(hours) from salary where date >= '".$date1."' && date <= '".$date2."' && duty = '应扣工资' && stuId = member.stuId),0)from member where name != 'admin' && wetherIn = '1';";

		$sql = "select * from app_user_info";

		if ($result = $mysqli->query($sql)){
			$i = 0;
			while($row = $result->fetch_row()){
				$totalMoney = ceil($row[2]);
			//	$objPHPExcel->getActiveSheet(0)->setCellValue('A' . ($i + 3), $row[0]);
				$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('A' . ($i + 2), $row[0],PHPExcel_Cell_DataType::TYPE_STRING);
			    $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('B' . ($i + 2), $row[1],PHPExcel_Cell_DataType::TYPE_STRING);
			    $objPHPExcel->getActiveSheet(0)->getStyle('B'. ($i + 2))->getNumberFormat()->setFormatCode("@");
				$i++;
			}
		}

		// Rename sheet  
		$objPHPExcel->getActiveSheet()->setTitle('爱心屋APP手机号');


		// Set active sheet index to the first sheet, so Excel opens this as the first sheet  
		$objPHPExcel->setActiveSheetIndex(0);


		// Redirect output to a client’s web browser (Excel5)  
		ob_end_clean();//清除缓冲区,避免乱码
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="爱心屋APP手机号(' . date('Ymd-His') . ').xls"');
		header('Cache-Control: max-age=0');
	}
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');

?>
