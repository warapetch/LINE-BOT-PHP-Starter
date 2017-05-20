<?php
// Line bot
$line_user_id = $_GET['userid'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta content="text/html; charset=UTF-8" http-equiv="content-type">
    <title>Register :: Success</title>
    <style type="text/css">
<!--
.style1 {
	color: #FF0000;
	font-weight: bold;
}
-->
    </style>
</head>
  <body>
    <h1 style="text-align: center;"><img title="Notify" alt="Notify" src="icon-linenotify.png">ลงทะเบียนสำเร็จแล้ว !!<br>
      </h1>
    <h1 style="text-align: center;">LINE@ USER ID<br>
    </h1>
    <h1 class="style1" style="text-align: center;"><?php echo $line_user_id; ?></h1>
    <p style="text-align: center;">&nbsp;</p>
    <p style="text-align: center;">(คัดลอก USER ID นำไปใช้งานได้เลย) </p>
    <p style="text-align: center;">&nbsp;</p>
    <p style="text-align: center;">&nbsp;</p>
  <div>
		
	<form action="" method="get">
	  <div align="center">
	    <script>
		function close_window() {
  			if (confirm("Close Window?")) {
    			close();
  				}
		}
			</script>
	      <a href="#" onclick="close_window();return false;"> >> ปิดหน้าต่าง << </a>
		<br>
             <a href="#" onclick="window.open('', '_self', ''); window.close();"> >> Close << </a>"		  
        </div>
	</form>
  </div>
  </body>
</html>
