<?php require_once('Connections/forum.php'); 
      mysql_query("SET NAMES UTF8");?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO topic (Title, Content, Nickname, Email, `Time`) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Title'], "text"),
                       GetSQLValueString($_POST['Content'], "text"),
                       GetSQLValueString($_POST['Nickname'], "text"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['Time'], "date"));

  mysql_select_db($database_forum, $forum);
  $Result1 = mysql_query($insertSQL, $forum) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>發表文章</title>
<script src="js/tinymce/tinymce.min.js"></script>
  <script>
tinymce.init({
  selector: 'textarea',
  height: 500,
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor textcolor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table paste code help wordcount'
  ],
  toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tiny.cloud/css/codepen.min.css'
  ]
});
</script>
  <style type="text/css">
<!--
.style3 {font-size: 72px}
-->
  </style>
</head>

<body>
<h1 align="center" class="style3" >討論區</h1>
<hr />
<form name="form1" action="<?php echo $editFormAction; ?>" method="POST"><table width="1000" border="1" align="center">
  <tr>
    <td><label>暱稱:
        <input name="Nickname" type="text" id="Nickname" />
    </label></td>
    <td><label>Email:
        <input name="Email" type="text" id="Email" />
    </label></td>
  </tr>
  <tr>
    <td colspan="2"><label>主題:
        <input name="Title" type="text" id="Title" />
    </label></td>
    </tr>
  <tr>
    <td colspan="2">
	<label>
  		<textarea name="Content" cols="100" rows="30" id="Content"></textarea>
  	</label></td>
    </tr>
  <tr>
    <td colspan="2">
      <div align="center"><input name="Time" type="hidden" value="<?php echo date("Y-m-d H:i:s")?>" />
        <label>
        <input type="submit" name="Submit" value="送出" />
        </label>
      </div>
    </td>
    </tr>
</table>

  
  <input type="hidden" name="MM_insert" value="form1">
</form>
</body>

</html>
