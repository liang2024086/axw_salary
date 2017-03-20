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

	//创建一个excel对象
	$objPHPExcel = new PHPExcel();
	// Set properties  

	$objPHPExcel->getProperties()->setCreator("ctos")
	        ->setLastModifiedBy("ctos")
	        ->setTitle("Office 2007 XLSX Test Document")
	        ->setSubject("Office 2007 XLSX Test Document")
	        ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
	        ->setKeywords("office 2007 openxml php")
	        ->setCategory("Test result file");

	//set width  
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(50);
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(12);
	$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(12);
	$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(30);

	//设置行高度  
	$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(22);

	$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);

	//set font size bold  
	$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);
	$objPHPExcel->getActiveSheet()->getStyle('A2:J2')->getFont()->setBold(true);

	$objPHPExcel->getActiveSheet()->getStyle('A2:J2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('A2:J2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

	//设置水平居中  
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	$objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('F')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('G')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('H')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('I')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	//  
	$objPHPExcel->getActiveSheet()->mergeCells('A1:J1');

	// set table header content  
	$objPHPExcel->setActiveSheetIndex(0)
	        ->setCellValue('A1', '订单数据汇总  时间:' . date('Y-m-d H:i:s'))
	        ->setCellValue('A2', '订单ID')
	        ->setCellValue('B2', '下单人')
	        ->setCellValue('C2', '客户名称')
	        ->setCellValue('D2', '下单时间')
	        ->setCellValue('E2', '需求机型')
	        ->setCellValue('F2', '需求数量')
	        ->setCellValue('G2', '需求交期')
	        ->setCellValue('H2', '确认BOM料号')
	        ->setCellValue('I2', 'PMC确认交期')
	        ->setCellValue('J2', 'PMC交货备注');

	// Miscellaneous glyphs, UTF-8  

/*	for ($i = 0; $i < count($result) - 1; $i++) {
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
*/

	// Rename sheet  
	$objPHPExcel->getActiveSheet()->setTitle('订单汇总表');


	// Set active sheet index to the first sheet, so Excel opens this as the first sheet  
	$objPHPExcel->setActiveSheetIndex(0);


	// Redirect output to a client’s web browser (Excel5)  
	ob_end_clean();//清除缓冲区,避免乱码
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="订单汇总表(' . date('Ymd-His') . ').xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');

?>