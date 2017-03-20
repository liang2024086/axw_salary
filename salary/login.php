<!DOCTYPE html>

<?php
/*
	if (isset($_COOKIE['aixinwuSalaryUser'])){
		$account = $_COOKIE['aixinwuSalaryUser'];
		$passwd = $_COOKIE['aixinwuSalaryPwd'];
		echo $account . "  ".$passwd;
	}
	else{
		//获取表单内容
		$account = $_POST['account'];
		$passwd = $_POST['pwd'];
		if ($account == ''){?>
			<script type="text/javascript">
				window.location.href="index.php";
			</script>
<?php
		}
		else{
			setcookie('aixinwuSalaryUser',$account,time()-3600,'/');
			setcookie('aixinwuSalaryPwd',$passwd,time()-3600,'/');
		}		
	}
*/
?>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title> 爱心屋工资</title>

<link type="text/css" rel="stylesheet" href="css/body.css">
<link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css"/>
<link rel="stylesheet" type="text/css" href="css/table.css">

<script src="js/jquery.js"></script>
<script src="js/jquery.datetimepicker.js"></script>
<script src="js/show.js"></script>
<script type="text/javascript">

	var SalaryArry = new Array();

//************************************************************************	

	function deleteSalary(stuId,date1,onDuty){
		$.ajax({
			type:'POST',
			url:'php/deleteSalary.php',
			data: "stuId="+stuId+"&date="+date1+"&duty="+onDuty,
			success:function(data){
				alert(data);
			}
		}
		);
	}

	function changeAuth(stuId,auth){

		$.ajax({
		type: 'POST', 
		url : 'php/changeAuthority.php', 
		data:	"stuId="+stuId+"&auth="+auth, 
		success: function(data){ 
			alert(data);
		/*	var partn = /<script.*>.*<\/script>/;
			if( data == 'empty' && 	partn.test(data) ){return;}

			eval_r("data="+data);*/
		//	document.getElementById("authorityShow").innerHTML=data;
			}
		}
		);
	}

	function addSal(salarys){
		$.ajax({
		type: 'POST', 
		url : 'php/addSalary.php', 
		data:	"salarys="+salarys, 
		success: function(data){ 
			var strs = new Array();
			if (data != "\n"){
				alert(data+"未添加");
			}
			else
				alert("添加成功");
			strs = data.split(",");
				/*for (var j = 0; j < strs.length-1; j++){
						alert(strs[j]);
				}*/
			
			document.getElementById("salaryAdd").innerHTML=data;
			for (var i = 0; i < SalaryArry.length;){
				var tmp = SalaryArry[i].substring(5,SalaryArry[i].length);
				if (strs.indexOf(tmp) == -1){
					//alert(tmp);
					deltr(tmp);
				}
				else i++;				
			}
			}
		}
		);
	}

	function salRecord(stuId,date1,date2,type){
				$.ajax({
					type: 'POST', 
					url : 'php/salaryRecord.php', 
					data:	"stuId="+stuId+"&date1="+date1+"&date2="+date2+"&type="+type, 
					success: function(data){ 
//					alert(data);
				/*	var partn = /<script.*>.*<\/script>/;
					if( data == 'empty' && 	partn.test(data) ){return;}
					eval_r("data="+data);*/
					document.getElementById("salaryRecord1").innerHTML=data;	}
					}
				);
	}

	function searchSalPage(stuId,date1,date2){
		        $.ajax({
		           type: 'POST', 
		           url : 'php/searchRecordSal.php', 
		           data:   "stuId="+stuId+"&date1="+date1+"&date2="+date2, 
		           success: function(data){ 
		 //                  alert(data);
		    /*  var partn = /<script.*>.*<\/script>/;
		           if( data == 'empty' &&  partn.test(data) ){return;}
		           eval_r("data="+data);*/
		          document.getElementById("searchRecord").innerHTML=data;    }
				  }
	    		);
	}


//************************************************************************

//************************************************************************
	function searchSal(account){
		var date1 = document.getElementById("record1").value;
		var date2 = document.getElementById("record2").value;
		if (date1 > date2)
			alert("前面的日期应早于后面的日期");
		else
			searchSalPage(account,date1,date2);
	}

	function addExternSal(account){
//		alert("add"+account);
		var stuId = document.getElementById("peopleID").value;
		var adddate = document.getElementById("addDate").value;
		var money = document.getElementById("addMoney").value;
		if (stuId == "" || adddate == "" || money == "")
			alert("添加工资信息未填写完整");
		else addSal(stuId+"$"+adddate+"$ $"+money+"$"+"应加工资$"+account+"$"+document.getElementById("addComment").value);
	}

	function delExternSal(account){
//		alert("del"+account);
		var stuId = document.getElementById("peopleDelID").value;
		var deldate = document.getElementById("delDate").value;
		var money = document.getElementById("delMoney").value;
		if (stuId == "" || deldate == "" || money == "")
			alert("扣除工资信息未填写完整");
		else addSal(stuId+"$"+deldate+"$ $"+money+"$"+"应扣工资$"+account+"$"+document.getElementById("delComment").value);
	}

	function salRec(stuId){
		var date1 = document.getElementById("datetimepickerSal1").value;
		var date2 = document.getElementById("datetimepickerSal2").value;
		var type = document.getElementById("salaryRecordType").value;
		if (date1 == "" || date2 == "" || type == ""){
			alert("请将信息填写完整");
		}
		else {
			if (date1 > date2)
				alert("前面的日期应早于后面的日期");
			else{
				salRecord(stuId,date1,date2,type);
			}
		}
	}

	//删除其中一行
	function deltr(trid)
	{    //alert(trid);
	    var tab=document.getElementById("salaryTable"); 
	    var row=document.getElementById(trid);   
	    var index=row.rowIndex;//rowIndex属性为tr的索引值，从0开始  
	    tab.deleteRow(index);  //从table中删除

	    var inputDel = document.getElementById("input"+trid);
	    if (inputDel != null){
	    	inputDel.remove();
	    }

	    SalaryArry.splice(SalaryArry.indexOf("input"+trid),1);
	}

	function addRo(){
		alert("A"+"B");
	}

	function addRow(addPerson){
		var date = document.getElementById('datetimepicker').value;
		var work = document.getElementById('whichWork').value;
		var time = document.getElementById('times').value;
		var name = document.getElementById('peopleName').value;
		var salaryType = document.getElementById('salaryType').value;

		var tmpArray = name.split(" ");
		name = tmpArray[1];

		var newComment = document.getElementById('comment').value;
		newComment = newComment.replace(/(^\s+)|(\s+$)/g,"");

		if (date == "" || work == "" || time == "" || name == "" || salaryType == ""){
			alert("请将信息填写完整。");
		}
		else if (document.getElementById(name)) {
			alert("同一人一次只能有一条记录。");
		}
		else if (salaryType!='项目活动' && time > 2){
			alert("经理值班和部员值班的时间一次不能超过两个小时");
		}
		else if (salaryType == '项目活动'  && newComment == ''){
			alert('添加项目活动需填写备注');
		}
		else{
			var Table = document.getElementById("salaryTable");   //取得自定义的表对象
			var length = Table.rows.length; //获取行数
		    var NewRow = Table.insertRow();                        //添加行
			var NewCell = NewRow.insertCell();
		    var NewCell1= NewRow.insertCell();                     //添加列
		    var NewCell2=NewRow.insertCell();
		    var NewCell3=NewRow.insertCell();
		    var NewCell4=NewRow.insertCell();
		    var NewCell5=NewRow.insertCell();
		    var NewCell6=NewRow.insertCell();
		    NewRow.id = name;
			NewCell.innerHTML = tmpArray[0];
		    NewCell1.innerHTML = name;          //添加数据
		    NewCell2.innerHTML=date; 
		    NewCell3.innerHTML=work;
		    NewCell4.innerHTML=time;
		    NewCell5.innerHTML=salaryType;
		    NewCell6.innerHTML="<button onclick=\"deltr('" + name + "')\">删除</button>";

		    //rowNum = rowNum + 1;
		    
		    //alert(length);
		    //alert(date+" " +work+" " + time + " " + name + " " +salaryType);

		    var formSubmit = document.getElementById("submitSalary");
		    var newInput = document.createElement("input");
		    newInput.type = "hidden";
		    newInput.name = "input"+name;
		    newInput.id = "input"+name;
		    newInput.value = name+"$"+date+"$"+work+"$"+time+"$"+salaryType+"$"+addPerson+"$"+document.getElementById('comment').value;
		    formSubmit.appendChild(newInput);
		    SalaryArry.push(newInput.name);
		   // alert(newInput.value);
		}	
	}

	function subSal(){
		var salarys = "";

		if (SalaryArry.length == 0)
			alert("未添加任何人！");
		else{
			for (var i = 0; i < SalaryArry.length; i++){
				salarys = salarys + document.getElementById(SalaryArry[i]).value+"#";
			}
			//alert(salarys);
			addSal(salarys);
		}
	}

	function chagePWD(pwd){
		var orgiPwd = document.getElementById("orgiPwd").value;
		var changePwd = document.getElementById("changePwd").value;
		var confirmPwd = document.getElementById("confirmPwd").value;

		if (orgiPwd == '' || changePwd == '' || confirmPwd == ''){
			alert("未输入完整");
		}
		else if (changePwd != confirmPwd){
			alert("两次输入的密码不同");
		}
		else if(orgiPwd != pwd){
			alert("原密码错误");
		}
		else if(changePwd.length < 6 || changePwd.length > 30){
			alert("密码位数需在6到30位之间");
		}
		else{
			document.getElementById("pwdChange").submit();
		}
	}

	function changeAuthority(){
		var auth = '';
		var checkbox1 = document.getElementById("authority1");
		var checkbox2 = document.getElementById("authority2");
		var checkbox3 = document.getElementById("authority3");
		var checkbox4 = document.getElementById("authority4");
		var checkbox5 = document.getElementById("authority5");

		if (checkbox1.checked == true)
			auth += 't';
		else auth += 'f';

		if (checkbox2.checked == true)
			auth += 't';
		else auth += 'f';

		if (checkbox3.checked == true)
			auth += 't';
		else auth += 'f';

		if (checkbox4.checked == true)
			auth += 't';
		else auth += 'f';

		if (checkbox5.checked == true)
			auth += 't';
		else auth += 'f';

		//alert(auth);

		var inputValue = document.getElementById("studentName").value;
		if (inputValue == "")
			alert("请选择学号");
		else{
			//alert(inputValue);
			changeAuth(inputValue,auth);
		}
		
	}

	function expSal(){
		var date1 = document.getElementById('date1').value;
		var date2 = document.getElementById('date2').value;
		var type = document.getElementById('exportType').value;
		if (date1 == '' || date2 == '')
			alert("请选择日期");
		else if(date1 > date2)
			alert("前面的日期应早于后面的日期");
		else
			document.getElementById('exportForm').submit();
	}

</script>
</head>

<body>
	<!-- 连接数据库 -->
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
	
	//获取表单内容
		$account = $_POST['account'];
		$passwd = $_POST['pwd'];

	?>

	<div id="main_body">
		<?php
			
			$sql = 'select wetherIn,authority,name from member where stuId=\''.$account.'\' && pwd = \''.$passwd.'\';';
			if ($result = $mysqli->query($sql))
			{
				/* fetch object array */
			    $row = $result->fetch_row();
			    if ($row == null){
			    	//setcookie('aixinwuSalaryUser',$account,time()-3600,'/');
					//setcookie('aixinwuSalaryPwd',$passwd,time()-3600,'/');
			    	?>
			    	<script>
						alert("学号或密码错误，请重新输入。");
						window.location.href="index.php";
					</script>
			    <?php			        
			    }
			    else {
			    	if ($row[0] == '1'){
			    		$myAuthrity = $row[1];
			    		$name = $row[2];
			    	}
			    	else{
			    		//setcookie('aixinwuSalaryUser',$account,time()-3600,'/');
						//setcookie('aixinwuSalaryPwd',$passwd,time()-3600,'/');
			    		?>
				    	<script>
							alert("学号或密码错误，请重新输入。");
							window.location.href="index.php";
						</script>
			    	<?php	
			    	}
			    }
			    
			    /* free result set */
			    $result->close();
					
			}
		//	echo $myAuthrity;
		?>
		<!--
<div style="background-color:#e0e0e0;height:30px;">-->
	
	<div style="top:4px;left:860px;position:relative;width:100px;">
		<?php echo $name ?> &nbsp&nbsp
		<input type="button" value="退出" onclick="window.location.href='exit.php';" >
	</div>
	

	<div style="background-color:#e0e0e0; height:0px; top:10px; position:relative;float:top;">
		<img src="imgs/aixinwu.png" style="height:200px;">
	</div>

	<?php
		if ($myAuthrity[0] =='t'){?>
			<div id="blocks"  onclick="show_salary()">
			<?php 
				echo "<a id='a1' onclick=\"chooseFunction('a1','".$myAuthrity."');\">工资记录</a>";
				?>	
			</div>

			<div id="blocks"  onclick="show_mail()">
				<?php 
				echo "<a id='a2' onclick=\"chooseFunction('a2','".$myAuthrity."');\">查看通讯录</a>";
				?>	
			</div>

			<div id="blocks" onclick="show_pwd()">
				<?php 
				echo "<a id='a3' onclick=\"chooseFunction('a3','".$myAuthrity."');\">更改密码</a>";
				?>	
			</div>
	<?php	}?>
		
	<?php
		if ($myAuthrity[1] == 't'){?>
			<div id="blocks"  onclick="show_import()">
				<?php 
				echo "<a id='a4' onclick=\"chooseFunction('a4','".$myAuthrity."');\">导入通讯录</a>";
				?>	
			</div>
	<?php	}?>

	<?php
		if ($myAuthrity[2] == 't'){?>
			<div id="blocks"  onclick="show_add()">
				<?php 
				echo "<a id='a5' onclick=\"chooseFunction('a5','".$myAuthrity."');\">添加工资</a>";
				?>	
			</div>
	<?php	}?>

	<?php
		if ($myAuthrity[3] == 't'){?>
			<div id="blocks" onclick="show_export()">
				<?php 
				echo "<a id='a6' onclick=\"chooseFunction('a6','".$myAuthrity."');\">导出工资</a>";
				?>	
			</div>
	<?php	}?>

	<?php
		if ($myAuthrity[4] == 't'){?>
			<div id="blocks" onclick="show_change()">
				<?php 
				echo "<a id='a7' onclick=\"chooseFunction('a7','".$myAuthrity."');\">更改权限</a>";
				?>	
			</div>

			<div id="blocks" onclick="show_advance()">
				<?php 
					echo "<a id='a8' onclick=\"chooseFunction('a8','".$myAuthrity."');\">高级选项</a>";
					?>	
			</div>
	<?php	}?>		

		<br>

<div style="width:960px;height:2px;background-color:#000;top:220px;position:relative;"></div>
		<p id="show" style="top:0px; position:relative;"><span id="showtime">

		<?php
			if ($myAuthrity[0] == 't'){?>
			<!-- 工资记录 -->
			<div id="salaryRecord" style="display:none;">
				<div style="top:20px;left:20px;position:relative;">
				日期范围：
				<input type="text" value=""  id="datetimepickerSal1"/>&nbsp 到 &nbsp
				<input type="text" value=""  id="datetimepickerSal2"/> &nbsp &nbsp &nbsp
				工资类型：
				<select style="margin:-2;" id="salaryRecordType">
					<option value="全部" > 全部 </option>
					<option value="经理值班" style="background:#e8eaeb;">经理值班</option> 
					<option value="部员值班">部员值班</option> 
					<option value="项目活动" style="background:#e8eaeb;">项目活动</option>
					<option value="节假日值班">节假日值班</option>
				</select>&nbsp &nbsp &nbsp 
				<?php
                    echo "<button onclick=\"salRec('".$account."');\">  查询</button>";
                ?>
				</div>
				<div id="salaryRecord1"> </div>
			</div>
		<?php }?>

		<?php if ($myAuthrity[2] == 't'){?>
			<!-- 添加工资 -->
			<div id="addSalary" style="display:none;">

				<div style="top:20px;position:relative;">
							
					<div id="inputBlock">
						日期:
							<input type="text" value="" id="datetimepicker"/>
					</div>

					<div id="inputBlock">
						班次:
								
						<select style="margin:-2;" id="whichWork"> 
						<option value="10:00 - 12:00" style="background:#e8eaeb;">10:00 - 12:00</option> 
						<option value="12:00 - 14:00">12:00 - 14:00</option> 
						<option value="14:00 - 16:00" style="background:#e8eaeb;">14:00 - 16:00</option> 
						<option value="16:00 - 18:00">16:00 - 18:00</option> 
						<option value="18:00 - 20:00" style="background:#e8eaeb;">18:00 - 20:00</option> 
						<option value="20:00 - 22:00">20:00 - 22:00</option> 
						</select> 
					</div>

					<div id="inputBlock">
						时长:

						<input type="text" value="2" style="width:25px;" id = "times" /> h
					</div>

					<div id="inputBlock">
						姓名:
						<input list="pasta" id="peopleName">
							<datalist id="pasta">
							<?php
								$sql = "select name,stuId from member where name != 'admin' && wetherIn='1';";
		echo $sql."<br>";
								if ($result = $mysqli->query($sql)){
									$tmp = 0;
									while ($row = $result->fetch_row()){
										echo "<option value=\"".$row[0].' '.$row[1]."\"></option>"; 
									}
								}
							?>
							</datalist>
					</div>

					<div id="inputBlock">
						工资类型:
								
						<select style="margin:-2;" id="salaryType"> 
						<option value="经理值班" style="background:#e8eaeb;">经理值班</option> 
						<option value="部员值班">部员值班</option> 
						<option value="项目活动" style="background:#e8eaeb;">项目活动</option>
						<option value="节假日值班">节假日值班</option>
						</select> 
					</div>

					<div id="inputBlock">
					<?php
						echo "<button onclick=\"addRow('".$account."');\"> 添加</button>";
					?>
					</div>

					<div id="inputBlock">
						<div style="top:7px;position:relative;">备注</div>
						<textarea id="comment" value="" maxlength=200 style="height:30px;width:300px;left:30px;top:-20px;position:relative;"> </textarea>
					</div>
				</div>
<br>
<br>
<br>

				<!-- 添加的工资信息  -->
				<table id="salaryTable" name="salaryTable" cellspacing="0" >
					    <tr><th>姓名</th><th>学号</th><th>日期</th><th>班次</th><th>时长</th><th>工资类型</th><th></th></tr>

				</table>

				<br>
				<form method="post" action="php/addSalary.php" id="submitSalary" name="submitSalary"> 
				</form>
				<button onclick="subSal();"> 提交</button>
				<br>
				<div id="salaryAdd" style="top:20px;position:relative;">
					
				</div>

				<div style="top:20px;left:20px;position:relative;">
					<h3>查询添加过的工资记录</h3>
						日期范围：
						<input type="text" value="" id="record1" name="record1"/>&nbsp到&nbsp
						<input type="text" value="" id="record2" name="record2"/>&nbsp &nbsp
						<?php 
						echo "<button onclick=\"searchSal('".$account."');\">  查询</button>";
						?>
				</div>
				<div id="searchRecord">
				</div>
			</div>
		<?}?>
		<?php if ($myAuthrity[3] == 't'){?>
			<!-- 导出工资 -->
			<div id="exportSalary" style="display:none;">
				<div style="width:960px;top:20px;left:20px;position:relative">
				                     <h3>增加工资</h3>
				                     日期：&nbsp
				                     <input type="text" value="" id="addDate" name="addDate"/>
				                     &nbsp
				                     学号：
									<input list="listSalary" id="peopleID">
									     <datalist id="listSalary">
									     <?php
									      $sql = "select name,stuId from member where name != 'admin' && wetherIn='1';";
									      echo $sql."<br>";
									      if ($result = $mysqli->query($sql)){
									         $tmp = 0;
									     while ($row = $result->fetch_row()){
									      echo "<option value=\"".$row[1]."\">".$row[0]."</option>"; 
									       }
									    }
									     ?>
									    </datalist>
									金额：<input type="text" value="" id="addMoney"/>
				                     &nbsp
				                     原因：
				                     <textarea id="addComment" maxlength=200 value="" style="top:13px;position:relative;">
				                     </textarea> &nbsp &nbsp &nbsp 
									<?php
										echo "<button onclick='addExternSal(".$account.");'> 增加</button>";
				                 	?>
								 </div>
				<div style="top:50px;left:20px;position:relative;">
					<h3>扣除工资</h3>
					日期：
						<input type="text" value="" id="delDate" name="delDate"/>
                                      &nbsp
                                      学号：
                                     <input list="listDelSalary" id="peopleDelID">
                                          <datalist id="listDelSalary">
                                          <?php
                                           $sql = "select name,stuId from member where name != 'admin' && wetherIn='1';";
                                           echo $sql."<br>";
                                          if ($result = $mysqli->query($sql)){
	                                              $tmp = 0;
	                                         while ($row = $result->fetch_row()){
	                                           echo "<option value=\"".$row[1]."\">".$row[0]."</option>"; 
	                                            }
	                                         }
	                                         ?>
	                                         </datalist>
	                                    金额：<input type="text" value="" id="delMoney"/>
	                                      &nbsp
	                                      原因：
	                                      <textarea value="" id="delComment" style="top:13px;position:relative;">
	                                      </textarea> &nbsp &nbsp &nbsp 
										<?php
										   echo "<button onclick='delExternSal(".$account.");'> 扣除</button>";
										?>
				</div>

				<div style="top:100px;left:20px;position:relative;">
					<h3>导出工资</h3>
					<form method="POST" action="php/exportSalary.php" id="exportForm">
						<div id="inputBlock">
							日期范围：&nbsp
							<input type="text" value="" id="date1" name="date1" />&nbsp
							到&nbsp
							<input type="text" value="" id="date2" name="date2" />
						</div>

						<div id="inputBlock">
							工资类型：&nbsp
							<select style="margin:-2;" id="exportType" name="exportType"> 
							<option value="导入表">导入表</option> 
							<option value="详表" style="background:#e8eaeb;">详表</option>
							<option value="项目活动">项目活动</option>
							<!--<option value="值班部员">值班部员</option> 
							<option value="小组活动" style="background:#e8eaeb;">小组活动</option> 
							-->
							</select> 
						</div>
						<div id="inputBlock">
							<input type="button" onclick="expSal();" value="导出" style="top:-2px;left:20px;position:relative;"/>
						</div>
					</form>
				</div>
			</div>
		<?php }?>
		<?php if ($myAuthrity[0] == 't'){?>
			<!-- 查看通讯录 -->
			<div id="mailList" style="display:none;">
				<div id="excel" style="width:960px;">
					<?php
									$sql = "select name,gender,team,duty,stuId,school,phone,mail from member where name != 'admin' && wetherIn ='1'";
					?>
									<table cellspacing="0">
					    <tr><th>姓名</th><th>性别</th><th>团队</th><th>职务</th><th>学号</th><th>学院</th><th>联系方式</th><th>邮箱</th></tr>

					<?php
						if ($result = $mysqli->query($sql)){
							while ($row = $result->fetch_row()){
					?>


					    <tr><td><?php echo $row[0]?></td><td><?php echo $row[1]?></td><td><?php echo $row[2]?></td><td><?php echo $row[3]?></td><td><?php echo $row[4]?></td><td><?php echo $row[5]?></td><td><?php echo $row[6]?></td><td><?php echo $row[7]?></td></tr>
					   


					<?php		}
						}
					?>
					 </table>
				</div>
			</div>
		<?php }?>
		<?php if ($myAuthrity[1] == 't'){?>
			<!-- 导入通讯录 -->
			<div id="importMail" style="display:none;">
				<form method="post" action="php/importExcel.php" enctype="multipart/form-data">
				<div style="width:500px;left:20px;top:20px;position:relative;">
					<h3>导入通讯录</h3>
					<label for="file">Filename:</label>
					<input type="file" name="file" id="file"/>
					<input type="submit" value="导入" />
				</div>
				</form>
			</div>
		<?php }?>
		<?php if ($myAuthrity[4] == 't'){?>
			<!-- 更改权限 -->
			<div id="authority" style="display:none;">
				<div style="top:20px;left:20px;position:relative;width:410px;">
					<table >			
						<h3>更改权限</h3>
						<tr><td style="width:30px;"><h4>学号:</h4></td>
						<td>
						
						<input list="studentId" id="studentName">
							<datalist id="studentId">
							<?php
								$sql = "select name,stuId from member where name != 'admin' && wetherIn='1';";
		echo $sql."<br>";
								if ($result1 = $mysqli->query($sql)){
									$tmp1 = 0;
									while ($row1 = $result1->fetch_row()){
										echo "<option value=\"".$row1[1]."\">".$row1[0]."</option>"; 
									}
								}
							?>
							</datalist></td>
							</tr>
							<tr>
								<td><h4>权限:</h4></td>
								<td>
									<label for="authority1">查看工资、通讯录以及更改密码</label>
									<input type="checkbox" name="authority1" id="authority1" value="1" style="top:3px;position:relative;" /> 
									<label for="authority2">导入通讯录</label>
									<input type="checkbox" name="authority2" id="authority2" value="2" style="top:3px;position:relative;" /> 
									<label for="authority3">添加工资</label>
									<input type="checkbox" name="authority3" id="authority3" value="3" style="top:3px;position:relative;" /> 
									<label for="authority4">导出工资</label>
									<input type="checkbox" name="authority4" id="authority4" value="4" style="top:3px;position:relative;" /> 
									<label for="authority5">更改权限</label>
									<input type="checkbox" name="authority5" id="authority5" value="5" style="top:3px;position:relative;"/> 
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<button onclick="changeAuthority();">确认提交</button>
								</td>
							</tr>	
											
					</table>

					<div id="authorityShow" name="authorityShow" style="position:relative;top:20px;">
					
					</div>
				</div>
			</div>
			<?php }?>
			<?php if ($myAuthrity[0] == 't'){?>
			<!-- 更改密码 -->
			<div id="pwd" style="display:none;">
					<div style="width:500px;left:20px;top:20px;position:relative;">	
						<h3>更改密码</h3>
						<table cellspacing="0">
					<form method="post" action="php/changePWD.php" id="pwdChange" name="pwdChange">
						<?php 
							echo "<input type='hidden' value='".$account."' id='changeID' name='changeID'>";
						?>
							<tr>
								<td>
									<label for="orgiPwd">原密码:</label>
								</td>
								<td>
									<input type="password" name="orgiPwd" id="orgiPwd"/>
								</td>
							</tr>

							<tr>
								<td>
									<label for="changePwd">更改后密码:</label>
								</td>
								<td>
									<input type="password" name="changePwd" id="changePwd"/>
								</td>
							</tr>

							<tr>
								<td>
									<label for="confirmPwd">确认密码:</label>
								</td>
								<td>
									<input type="password" name="confirmPwd" id="confirmPwd"/>
								</td>
							</tr>	

					</form>
							<tr>
								<td>
									
								</td>
								<td>
									<?php
										echo "<button onclick='chagePWD(".$passwd.");'> 确认修改 </button>";
									?>									
								</td>
							</tr>		
						</table>
					</div>
			</div>
			<?php }?>
			<?php if ($myAuthrity[4] == 't'){?>
			<!-- 高级选项 -->
			<div id="advance" style="display:none;">
				<div style="top:20px;left:20px;position:relative;font-size:20px">
					有待开发
				</div>
			</div>
			<?php }?>
		</span></p>  

	</div>
</body>





<script type="text/javascript">

$('#datetimepicker').datetimepicker({
		yearOffset:0,
		lang:'ch',
		timepicker:false,
		format:'Y/m/d',
		formatDate:'Y/m/d',
		maxDate:'+1970/01/01' // and today is maximum date calendar
	});

$('#date1').datetimepicker({
		yearOffset:0,
		lang:'ch',
		timepicker:false,
		format:'Y/m/d',
		formatDate:'Y/m/d',
		maxDate:'+1970/01/01' // and today is maximum date calendar
	});

$('#date2').datetimepicker({
		yearOffset:0,
		lang:'ch',
		timepicker:false,
		format:'Y/m/d',
		formatDate:'Y/m/d',
		maxDate:'+1970/01/01' // and today is maximum date calendar
	});

$('#datetimepickerSal1').datetimepicker({
	yearOffset:0,
	lang:'ch',
	timepicker:false,
	format:'Y/m/d',
	formatDate:'Y/m/d',
	maxDate:'+1970/01/01'
	});

$('#datetimepickerSal2').datetimepicker({
	yearOffset:0,
	lang:'ch',
	timepicker:false,
	format:'Y/m/d',
	formatDate:'Y/m/d',
	maxDate:'+1970/01/01'
});

$('#addDate').datetimepicker({
    yearOffset:0,
    lang:'ch',
    timepicker:false,
    format:'Y/m/d',
    formatDate:'Y/m/d',
    maxDate:'+1970/01/01'
});

$('#delDate').datetimepicker({
   yearOffset:0,
   lang:'ch',
   timepicker:false,
   format:'Y/m/d',
   formatDate:'Y/m/d',
   maxDate:'+1970/01/01'
});
$('#record1').datetimepicker({
	yearOffset:0,
	lang:'ch',
	timepicker:false,
	format:'Y/m/d',
	formatDate:'Y/m/d',
	maxDate:'+1970/01/01'
});

$('#record2').datetimepicker({
	yearOffset:0,
	lang:'ch',
	timepicker:false,
	format:'Y/m/d',
	formatDate:'Y/m/d',
	maxDate:'+1970/01/01'
});
</script>


</html>
