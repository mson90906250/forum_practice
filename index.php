<?php require_once('Connections/forum.php'); ?>

<?php
//繫結資料集
mysql_select_db($database_forum, $forum);
$query_Recordset1 = "SELECT * FROM topic ORDER BY TopicID DESC";
$Recordset1 = mysql_query($query_Recordset1, $forum) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>首頁</title>
</head>

<body>
<h1 align="center" style="font-size:72px ; color:#99FF99">討論區首頁</h1>
<hr>
<table width="500" border="1" align="center" style="margin-bottom:20px">
  <tr>
    <td><div align="right"><a href="#" style="margin-right:10px">發表主題</a><a href="#">搜尋</a></div></td>
  </tr>
</table>

<table width="500" border="1" align="center" style="margin-bottom:20px">
  <tr style="background-color:#0066FF ; color:#FFFFFF">
    <td>主題</td>
    <td>發表人</td>
    <td>時間</td>
  </tr>
  <tr>
    <td><?php echo $row_Recordset1['Title']; ?></td>
    <td><?php echo $row_Recordset1['Nickname']; ?></td>
    <td><?php echo $row_Recordset1['Time']; ?></td>
  </tr>
</table>

<table width="500" border="1" align="center">
  <tr>
    <td><div align="right">跳頁選單</div></td>
  </tr>
</table>


</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
