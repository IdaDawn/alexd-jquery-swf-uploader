<?PHP
$storeFolder = "Test/";
$resizedPrefix = "lrns_";
$uploadServerMax = ini_get("upload_max_filesize");
if (isset($_FILES["photo"]) && is_uploaded_file($_FILES["photo"]["tmp_name"]) && $_FILES["photo"]["error"] == 0) {
	$getimg_w_h = getimagesize($_FILES['photo']['tmp_name']);
	switch($getimg_w_h['mime']){
		case 'image/gif':
			$name=md5($_FILES['photo']['name']).".gif"; 
			$tmp_name=$_FILES['photo']['name'];
		break;
		case 'image/jpeg':
			$name=md5($_FILES['photo']['name']).".jpg"; 
			$tmp_name=$_FILES['photo']['name']; 
		break;
		case 'image/png':
			$name=md5($_FILES['photo']['name']).".png"; 
			$tmp_name=$_FILES['photo']['name']; 
		break;
		default:
			$errorMsg = "<p> Это вапще какая-то не фотка :)</p>";
		break;
	}
	
	if (!isset($errorMsg))
	{
		copy($_FILES['photo']['tmp_name'],$storeFolder.$name);
		img_resize($_FILES['photo']['tmp_name'],"350", $storeFolder.$resizedPrefix.$name);
		$sz=getimagesize("test/lrns_".$name);	
	}
	

}
elseif (isset($_POST['hidFileName'])&&$_POST['hidFileName']!==""&&isset($_POST['hidTmpFileName'])&&$_POST['hidTmpFileName']!=="")
{
	$name = $_POST['hidFileName'];
	$tmp_name = $_POST['hidTmpFileName'];
	$sz=getimagesize($storeFolder.$resizedPrefix.$name);	
}
elseif (isset($_POST['hidErrorMsg'])&&$_POST['hidErrorMsg']!=="")
{
	$errorMsg = $_POST['hidErrorMsg'];
}
else
{
	if ($_FILES['photo']['error']>0)
	{
		switch($_FILES['photo']['error'])
		{
			  case 1: $errorMsg = "<p> Блин, фотка, которую ты загрузил, размером больше ".$uploadServerMax."байт </p>";break;
			  case 2: $errorMsg = "<p> Блин, фотка, которую ты загрузил, размером больше ".$uploadServerMax."байт </p>";break;
			  case 3: $errorMsg = "<p> Блин, произошла какая-то  ошибка во время загрузки</p>";break;
			  case 4: $errorMsg = "<p> Блин, произошла какая-то  ошибка во время загрузки</p>";break;
		}
	}
	else
	{
		$errorMsg = '<p> Блин, произошла какая-то  ошибка</p>';
	}
}
     
	
?>