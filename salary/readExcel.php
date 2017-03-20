<html><body><h1>It works!</h1>
<!--<?php phpinfo()?>-->
<?php
/*$filename = "d:\\BugReport.txt";
$handle = fopen($filename,"r");
$contents = fread($handle,filesize($filename));
if (!$contents) echo "failed";
else echo $contents,"sjdiof";
fclose($handle);*/
?>

<?php 
$link=mysqli_connect("localhost","root","liang"); 
if(!$link) echo "FAILD!连接错误，用户名密码不对"; 
else echo "OK!可以连接"; 
echo "djsofjsodfjo";
?> 

<?php
include 'PHPExcel.php';
include 'PHPExcel/Writer/Excel2007.php';
$filename = "E:/Apache24/htdocs/test/test.xlsx";
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
    for ($column = 0; $column < $highestColumm; $column++) {//列数是以第0列开始
        $columnName = PHPExcel_Cell::stringFromColumnIndex($column);
        echo $columnName.$row.":".$sheet->getCellByColumnAndRow($column, $row)->getValue()."<br />";
    }
}
?>

</body></html>