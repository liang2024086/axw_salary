function show_salary(){
	if (document.getElementById("salaryRecord"))
		document.getElementById("salaryRecord").setAttribute('style','top:200px; position:relative;display:blocks;');
	if (document.getElementById("addSalary"))
		document.getElementById("addSalary").setAttribute('style','display:none');
	if (document.getElementById("exportSalary"))
		document.getElementById("exportSalary").setAttribute('style','display:none');
	if (document.getElementById("mailList"))
		document.getElementById("mailList").setAttribute('style','display:none');
	if (document.getElementById("importMail"))
		document.getElementById("importMail").setAttribute('style','display:none');
	if (document.getElementById("authority"))
		document.getElementById("authority").setAttribute('style','display:none');
	if (document.getElementById("pwd"))
		document.getElementById("pwd").setAttribute('style','display:none');
	if (document.getElementById("advance"))
		document.getElementById("advance").setAttribute('style','display:none');
}

function show_add(){
	if (document.getElementById("salaryRecord"))
		document.getElementById("salaryRecord").setAttribute('style','display:none;');
	if (document.getElementById("addSalary"))
		document.getElementById("addSalary").setAttribute('style','top:200px; position:relative;display:blocks;');
	if (document.getElementById("exportSalary"))
		document.getElementById("exportSalary").setAttribute('style','display:none');
	if (document.getElementById("mailList"))
		document.getElementById("mailList").setAttribute('style','display:none');
	if (document.getElementById("importMail"))
		document.getElementById("importMail").setAttribute('style','display:none');
	if (document.getElementById("authority"))
		document.getElementById("authority").setAttribute('style','display:none');
	if (document.getElementById("pwd"))
		document.getElementById("pwd").setAttribute('style','display:none');	
	if (document.getElementById("advance"))
		document.getElementById("advance").setAttribute('style','display:none');
}

function show_export(){
	if (document.getElementById("salaryRecord"))
		document.getElementById("salaryRecord").setAttribute('style','display:none;');
	if (document.getElementById("addSalary"))
		document.getElementById("addSalary").setAttribute('style','display:none;');
	if (document.getElementById("exportSalary"))
		document.getElementById("exportSalary").setAttribute('style','top:200px; position:relative;display:blocks');
	if (document.getElementById("mailList"))
		document.getElementById("mailList").setAttribute('style','display:none');
	if (document.getElementById("importMail"))
		document.getElementById("importMail").setAttribute('style','display:none');
	if (document.getElementById("authority"))
		document.getElementById("authority").setAttribute('style','display:none');
	if (document.getElementById("pwd"))
		document.getElementById("pwd").setAttribute('style','display:none');
	if (document.getElementById("advance"))
		document.getElementById("advance").setAttribute('style','display:none');
}

function show_mail(){
	if (document.getElementById("salaryRecord"))
		document.getElementById("salaryRecord").setAttribute('style','display:none;');
	if (document.getElementById("addSalary"))
		document.getElementById("addSalary").setAttribute('style','display:none;');
	if (document.getElementById("exportSalary"))
		document.getElementById("exportSalary").setAttribute('style','display:none');
	if (document.getElementById("mailList"))
		document.getElementById("mailList").setAttribute('style','top:200px; position:relative;display:blocks');
	if (document.getElementById("importMail"))
		document.getElementById("importMail").setAttribute('style','display:none');
	if (document.getElementById("authority"))
		document.getElementById("authority").setAttribute('style','display:none');
	if (document.getElementById("pwd"))
		document.getElementById("pwd").setAttribute('style','display:none');
	if (document.getElementById("advance"))
		document.getElementById("advance").setAttribute('style','display:none');
}

function show_import(){
	if (document.getElementById("salaryRecord"))
		document.getElementById("salaryRecord").setAttribute('style','display:none;');
	if (document.getElementById("addSalary"))
		document.getElementById("addSalary").setAttribute('style','display:none;');
	if (document.getElementById("exportSalary"))
		document.getElementById("exportSalary").setAttribute('style','display:none');
	if (document.getElementById("mailList"))
		document.getElementById("mailList").setAttribute('style','display:none');
	if (document.getElementById("importMail"))
		document.getElementById("importMail").setAttribute('style','top:200px; position:relative;display:blocks');
	if (document.getElementById("authority"))
		document.getElementById("authority").setAttribute('style','display:none');
	if (document.getElementById("pwd"))
		document.getElementById("pwd").setAttribute('style','display:none');
	if (document.getElementById("advance"))
		document.getElementById("advance").setAttribute('style','display:none');
}

function show_change(){
	if (document.getElementById("salaryRecord"))
		document.getElementById("salaryRecord").setAttribute('style','display:none;');
	if (document.getElementById("addSalary"))
		document.getElementById("addSalary").setAttribute('style','display:none;');
	if (document.getElementById("exportSalary"))
		document.getElementById("exportSalary").setAttribute('style','display:none');
	if (document.getElementById("mailList"))
		document.getElementById("mailList").setAttribute('style','display:none');
	if (document.getElementById("importMail"))
		document.getElementById("importMail").setAttribute('style','display:none');
	if (document.getElementById("authority"))
		document.getElementById("authority").setAttribute('style','top:200px; position:relative;display:blocks');
	if (document.getElementById("pwd"))
		document.getElementById("pwd").setAttribute('style','display:none');
	if (document.getElementById("advance"))
		document.getElementById("advance").setAttribute('style','display:none');
}

function show_pwd(){
	if (document.getElementById("salaryRecord"))
		document.getElementById("salaryRecord").setAttribute('style','display:none;');
	if (document.getElementById("addSalary"))
		document.getElementById("addSalary").setAttribute('style','display:none;');
	if (document.getElementById("exportSalary"))
		document.getElementById("exportSalary").setAttribute('style','display:none');
	if (document.getElementById("mailList"))
		document.getElementById("mailList").setAttribute('style','display:none');
	if (document.getElementById("importMail"))
		document.getElementById("importMail").setAttribute('style','display:none');
	if (document.getElementById("authority"))
		document.getElementById("authority").setAttribute('style','display:none');
	if (document.getElementById("pwd"))
		document.getElementById("pwd").setAttribute('style','top:200px; position:relative;display:blocks');
	if (document.getElementById("advance"))
		document.getElementById("advance").setAttribute('style','display:none');
}

function show_advance(){
	if (document.getElementById("salaryRecord"))
		document.getElementById("salaryRecord").setAttribute('style','display:none;');
	if (document.getElementById("salaryRecord"))
		document.getElementById("addSalary").setAttribute('style','display:none;');
	if (document.getElementById("exportSalary"))
		document.getElementById("exportSalary").setAttribute('style','display:none');
	if (document.getElementById("mailList"))
		document.getElementById("mailList").setAttribute('style','display:none');
	if (document.getElementById("importMail"))
		document.getElementById("importMail").setAttribute('style','display:none');
	if (document.getElementById("authority"))
		document.getElementById("authority").setAttribute('style','display:none');
	if (document.getElementById("pwd"))
		document.getElementById("pwd").setAttribute('style','display:none');
	if (document.getElementById("advance"))
		document.getElementById("advance").setAttribute('style','top:200px; position:relative;display:blocks');
}

function chooseFunction(id,authority){
	if(authority[0] == 't'){
		if (id == 'a1'){
			//location.reload(true);
			document.getElementById(id).setAttribute("style","color:#fff;background-color:#000;");
		}
		else{
			document.getElementById('a1').setAttribute("style","color:#000;background-color:#f5f5f5;");
		}

		if (id == 'a2'){
			document.getElementById(id).setAttribute("style","color:#fff;background-color:#000;");
		}
		else{
			document.getElementById('a2').setAttribute("style","color:#000;background-color:#f5f5f5;");
		}

		if (id == 'a3'){
			document.getElementById(id).setAttribute("style","color:#fff;background-color:#000;");
		}
		else{
			document.getElementById('a3').setAttribute("style","color:#000;background-color:#f5f5f5;");
		}
	}
	if(authority[1] == 't'){
		if (id == 'a4'){
			document.getElementById(id).setAttribute("style","color:#fff;background-color:#000;");
		}
		else{
			document.getElementById('a4').setAttribute("style","color:#000;background-color:#f5f5f5;");
		}
	}
	if(authority[2] == 't'){
		if (id == 'a5'){
			document.getElementById(id).setAttribute("style","color:#fff;background-color:#000;");
		}
		else{
			document.getElementById('a5').setAttribute("style","color:#000;background-color:#f5f5f5;");
		}
	}
	if(authority[3] == 't'){
		if (id == 'a6'){
			document.getElementById(id).setAttribute("style","color:#fff;background-color:#000;");
		}
		else{
			document.getElementById('a6').setAttribute("style","color:#000;background-color:#f5f5f5;");
		}
	}
	if(authority[4] == 't'){
		if (id == 'a7'){
			document.getElementById(id).setAttribute("style","color:#fff;background-color:#000;");
		}
		else{
			document.getElementById('a7').setAttribute("style","color:#000;background-color:#f5f5f5;");
		}

		if (id == 'a8'){
			document.getElementById(id).setAttribute("style","color:#fff;background-color:#000;");
		}
		else{
			document.getElementById('a8').setAttribute("style","color:#000;background-color:#f5f5f5;");
		}
	}
}

function deleteRow1(trid){
	//alert(trid);
	var tab = document.getElementById("searchRecordSalary");
	var row = document.getElementById(trid);
	var index = row.rowIndex;
	tab.deleteRow(index);
	//alert(tab);
	var strs = trid.split("|");
//	alert(strs[0]);
//	alert(strs[1]);
//	alert(strs[2]);
	deleteSalary(strs[2],strs[0],strs[1]);
}
