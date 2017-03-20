<?php
	if (isset($_COOKIE['aixinwuSalaryUser'])){
		setcookie('aixinwuSalaryUser','',time()-3600,'/');
		setcookie('aixinwuSalaryPwd','',time()-3600,'/');
	}?>

<script>
	window.location.href="index.php";
</script>
