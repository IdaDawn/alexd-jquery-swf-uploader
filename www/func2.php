<?
	function AddWithWatMark()
	{
		error_reporting(0);
		$rt=mysql_query("SELECT * FROM `templ` WHERE `id` = '".$_POST['templ']."'");
		$rsz=mysql_query("SELECT * FROM `sz`");
		$rpice=30;

			if((mysql_result($rt,0,"price") != 0) && (mysql_result($rt,0,"price") != ''))
			{
				$price=mysql_result($rt,0,"price");
			}
			else
			{
				if(mysql_result($rt,0,"podcat_id") != 0)
				{
					$rprice=mysql_query("SELECT * FROM `podcat` WHERE `id`='".mysql_result($rt,0,"podcat_id")."'");
					if((mysql_result($rprice,0,"price") !=0) && (mysql_result($rprice,0,"price") !=''))
					{
					$price=mysql_result($rprice,0,"price");
					}
					else
					{
						$rprice=mysql_query("SELECT * FROM `category` WHERE `id`='".mysql_result($rt,0,"category_id")."'");
						if((mysql_result($rprice,0,"price") !=0) && (mysql_result($rprice,0,"price") !=''))
						{
							$price=mysql_result($rprice,0,"price");
						}
					}
					
				}
				else
				{
					$rprice=mysql_query("SELECT * FROM `category` WHERE `id`='".mysql_result($rt,0,"category_id")."'");
					$price=mysql_result($rprice,0,"price");
				}
			}
		
		$url=mysql_result($rt,0,"url");
		$left=mysql_result($rt,0,"left");
		$top=mysql_result($rt,0,"top");
		$right=mysql_result($rt,0,"right");
		$bottom=mysql_result($rt,0,"bottom");
		$names=mysql_result($rt,0,"bottom");

		//copy($_FILES['ph']['tmp_name'],"test/".$_FILES['ph']['name']);
		$name=$_POST['photo'];

		//-------------------------------big photo--------
		img_resize("test/".$name, "650", "test/".$name);
		add_imsize("test/".$name, "test/n_".$name, $left, $top, $right, $bottom);
/*		
		if(mysql_result($rsz,0,"big") == 1)
		{
*/		add_template("test/n_".$name, "template/".$url,  "test/n_".$name, $left, $top, $right, $bottom);
/*		}
		else
		{
		templ_size("template/".$url, "test/big.png", mysql_result($rsz,0,"big"));
		add_template("test/n_".$name, "test/big.png",  "test/n_".$name, $left, $top, $right, $bottom);
		}
*/		//img_ss("test/n_".$name);
		add_template("test/n_".$name, "rispekt-logo.png", "test/n_".$name, 0, 90, $right, $bottom);
		//-------------------------------big photo--------
		img_resize("test/".$name, "350", "test/lrn_".$name);
		add_imsize("test/lrn_".$name, "test/lrn_".$name, $left, $top, $right, $bottom);

/*		if(mysql_result($rsz,0,"large") == 1)
		{
*/		add_template("test/lrn_".$name, "template/".$url,  "test/lrn_".$name, $left, $top, $right, $bottom);
/*		}
		else
		{
		templ_size("template/".$url, "test/tl.png", mysql_result($rsz,0,"large"));
		add_template("test/lrn_".$name, "test/tl.png",  "test/lrn_".$name, $left, $top, $right, $bottom);
		}
*/		
		//img_ss("test/lrn_".$name);

			if($_POST['in']>0)
			{
			$rs=mysql_query("SELECT * FROM `size` WHERE `id` = '".$_POST['in']."'");
			//$mob=file("size.txt");
			//list($mw,$mh)=explode('|',$mob[$_POST['in']]);
			$mw=mysql_result($rs,0,"width");
			$mh=mysql_result($rs,0,"height");
			}
			else
			{
				if($_POST['in']== -1)
				{
					$mw=128;
					$mh=97;
				}
				if($_POST['in']== -2)
				{
					$mw=128;
					$mh=128;
				}
				if($_POST['in']== -3)
				{
					$mw=208;
					$mh=320;
				}
			}

		img_mob("test/lrn_".$name, $mw, $mh, 100,"test/mobn_".$name);
		add_template("test/lrn_".$name, "rispekt-logo.png", "test/lrn_".$name, 0, 90, $right, $bottom);
		add_template("test/mobn_".$name, "rispekt-logo.png", "test/mobn_".$name, 20, $mh-20, $right, $bottom);



				?>
             <div style="border:1px solid #cc3366; font-size:12px; padding:15px;">
             <div style="border:0px solid #000000; height:300px">
               <div style="float:left; padding-right:20px">
               	Риспектная фотка среднего размера<br />
			   <?
			   	$ims= getimagesize("test/lrn_".$name);
				$fs=filesize("test/lrn_".$name);
			    $fss=explode(".",$fs/1000);
			   ?>
               
               <img src="test/lrn_<?=$name?>" /><br />
               <a href="t.php?img=lrn_<?=$name?>" >Скачать</a> ( <?=$fss[0]?>kb, <?=$ims[0]?>x<?=$ims[1]?>)
               <br />
               <br />
               </div>
                <div style=" display:inline; padding-left:20px">
                Риспектная фотка для мобилы
			   <?
			   	$ims= getimagesize("test/mobn_".$name);
				$fs=filesize("test/mobn_".$name);
				 $fss=explode(".",$fs/1000);
			   ?>
                <img src="test/mobn_<?=$name?>" border="1" /><br />
                <a href="t.php?img=mobn_<?=$name?>">Скачать</a> ( <?=$fss[0]?>kb, <?=$ims[0]?>x<?=$ims[1]?>)
                </div>
            </div>
			<div style="border:0px solid #000000">
			Большая риспектная фотка
 			   <?
			   	$ims= getimagesize("test/n_".$name);
				$fs=filesize("test/n_".$name);
				 $fss=explode(".",$fs/1000);
			   ?>
               <img src="test/n_<?=$name?>" border="0" /><br />
                <a href="t.php?img=n_<?=$name?>">Скачать</a> ( <?=$fss[0]?>kb, <?=$ims[0]?>x<?=$ims[1]?>)
			</div>
				<?
				$namesex=$name;
				$mr=mysql_query("SELECT * FROM `temp` WHERE `id`='".$_POST['num']."'");
				?>
				<br>
				<p>&nbsp;</p>


<div  style="font-size:12px; text-align:left; line-height:18px; color: #993366; padding:0px 10px 10px 20px; text-align:left">
<p style="font-size:24px"> Как убрать ссылки с фоток?
</p>
<p>
Если ты хочешь получить риспектные фотки без ссылки на наш сайт www.rispekt.ru, отправь платную смс — и ссылка пропадет. <p align=right>
 </p>
<br>
</p>

  <span style="font-size:18px">Запомни этот код:&nbsp;&nbsp;<?=$price?></span>,&nbsp;его обязательно нужно будет дописать в конец СМС-ки. <br>
  Твоя смс перед отправкой должна выглядеть так: <span style="background:#eee;">EXP+####(пробел)<b><?=mysql_result($mr,0,"inp")?></b></span> (вместо решеточек будут циферки, они зависят от страны и кода мобильного оператора),<br> "ваш текст" это ваш код, тоесть - <b><?=mysql_result($mr,0,"inp")?></b>.







      нажми на кнопку
<a href="http://www.smsexpress.ru/sendsms.html?acc=6570&value=<?=mysql_result($rprice,0,"price")?>" target="_blank"><img src="http://www.smsexpress.ru/buttons/1.gif" width=119 height=23 border=0></a>

             <p>&nbsp;</p>
	<span style="font-size:18px">Сюда введи полученый ответ:&nbsp;</span>	<form name="FsK" method="post" action="?page_id=110">
                	<input type="text" name="outp" id="name" />

                    <input type="hidden" name="inp" value="<?=mysql_result($mr,0,"inp")?>" />
                    <input type="hidden" name="act" value="ok" />
                    <input type="hidden" name="result" value="hike" />
                    <input type="hidden" name="num" value="<?=$_POST['num']?>" />
                    <input type="hidden" name="namesex" value="<?=$namesex?>" />
                    <input type="hidden" name="in" value="<?=$_POST['in']?>" />
                    <input type="hidden" name="templ" value="<?=$_POST['templ']?>" />
                    <input type="button" value="Ok" onclick="Subm('FsK')" />

                </form>

				</div>
				<b>Стоимость sms-сообщения  примерно 0,15$</b>. <br />
Тарифы различаются в зависимости от страны и вашего сотового оператора. Точная стоимость СМС будет указана в слудющем окне.


</div>

				<?
	}

	function AddPh()
	{
		$rt=mysql_query("SELECT * FROM `templ` WHERE `id` = '".$_POST['templ']."'");
		$url=mysql_result($rt,0,"url");
		$left=mysql_result($rt,0,"left");
		$top=mysql_result($rt,0,"top");
		$right=mysql_result($rt,0,"right");
		$bottom=mysql_result($rt,0,"bottom");
		$names=mysql_result($rt,0,"bottom");


					$namesex=$_POST['namesex'];



					add_imsize("test/".$namesex, "test/n_".$namesex, $left, $top, $right, $bottom);
					add_template("test/n_".$namesex, "template/".$url,  "test/n_".$namesex, $left, $top, $right, $bottom);
					//img_ss("test/n_".$namesex);

					img_resize("test/".$namesex, "350", "test/lrn_".$namesex);
					add_imsize("test/lrn_".$namesex, "test/lrn_".$namesex, $left, $top, $right, $bottom);
					add_template("test/lrn_".$namesex, "template/".$url,  "test/lrn_".$namesex, $left, $top, $right, $bottom);
					if($_POST['in']>0)
					{
					$rs=mysql_query("SELECT * FROM `size` WHERE `id` = '".$_POST['in']."'");
					//$mob=file("size.txt");
					//list($mw,$mh)=explode('|',$mob[$_POST['in']]);
					$mw=mysql_result($rs,0,"width");
					$mh=mysql_result($rs,0,"height");
					}
					else
					{
						if($_POST['in']== -1)
						{
							$mw=128;
							$mh=97;
						}
						if($_POST['in']== -2)
						{
							$mw=128;
							$mh=128;
						}
						if($_POST['in']== -3)
						{
							$mw=208;
							$mh=320;
						}
					}

					img_mob("test/lrn_".$namesex, $mw, $mh, 100,"test/mobn_".$namesex);
				?>
            <div style="border:1px solid #cc3366; ">
             <div style="border:0px solid #000000; height:400px">
              <div style="float:left; padding-right:20px">
               	Small rispekt photo<br />
			   <?
			   	$ims= getimagesize("test/lrn_".$namesex);
				$fs=filesize("test/lrn_".$namesex);
			   ?>
               <img src="test/lrn_<?=$namesex?>" /><br />
               <a href="t.php?img=lrn_<?=$namesex?>&size=<?=$fs?>">download</a> ( <?=$fs/1000?>kb ,<?=$ims[0]?>x<?=$ims[1]?>)
               <br />
               <br />
               </div>
                <div style=" display:inline; padding-left:20px">
                Respekt for mobil
			   <?
			   	$ims= getimagesize("test/mobn_".$namesex);
				$fs=filesize("test/mobn_".$namesex);
			   ?>
                <img src="test/mobn_<?=$namesex?>" border="1" /><br />
                <a href="t.php?img=mobn_<?=$namesex?>">download</a> ( <?=$fs/1000?>kb ,<?=$ims[0]?>x<?=$ims[1]?>)
                </div>
            </div>
            <div>

 			   <?
			   	$ims= getimagesize("test/n_".$namesex);
				$fs=filesize("test/n_".$namesex);
			   ?>
               <img src="test/n_<?=$namesex?>" border="0" /><br />
                <a href="t.php?img=n_<?=$namesex?>">download</a> ( <?=$fs/1000?>kb ,<?=$ims[0]?>x<?=$ims[1]?>)
			<br /><br />
			</div>
            </div>

			<?
	}


	function add_imsize($img, $url, $left, $top, $right, $bottom)
	{
		$addw=0;
		$addh=0;
		$vx=0;
		$vy=0;

		if($left < 0)
		{
			$vx=$left*(-1);
			$addw=$addw+$left;
		}
		if($top < 0)
		{
			$addh=$addh+$top;
			$vy=$top*(-1);
		}
		if($right < 0)
		{
			$addw=$addw+$right;
		}
		if($bottom < 0)
		{
			$addh=$addh+$bottom;
		}
		$addw= $addw*(-1);
		$addh= $addh*(-1);


		$getimg_w_h = getimagesize($img);
		if($getimg_w_h['mime'] == 'image/gif')
		{
			$image=imagecreatefromgif($img);
		}
		if($getimg_w_h['mime'] == 'image/jpeg')
		{
			$image=imagecreatefromjpeg($img);
		}
		if($getimg_w_h['mime'] == 'image/png')
		{
			$image=imagecreatefrompng($img);
		}
		$target = imagecreatetruecolor($getimg_w_h[0]+$addw, $getimg_w_h[1]+$addh);
		$bl = imagecolorallocate($target, 255, 255, 255);
		imagefill($target, 0, 0, $bl);
		imagecopyresampled($target, $image ,$vx, $vy , 0, 0, $getimg_w_h[0], $getimg_w_h[1], $getimg_w_h[0], $getimg_w_h[1]);

		if($getimg_w_h['mime'] == 'image/gif')
		{
			 imagegif($target, $url, 100);
		}
		if($getimg_w_h['mime'] == 'image/jpeg')
		{
			 imagejpeg($target, $url, 100);
		}
		if($getimg_w_h['mime'] == 'image/png')
		{
		 imagepng($target, $url, 100);
		}
		imagedestroy($target);
		imagedestroy($image);
	}

	function templ_size($filename, $url, $num)
	{
		$info_img = getimagesize($filename);
		list($width, $height) = $info_img;
			$s_w=explode(".",$width/$num);
			$s_h=explode(".",$height/$num);
			
			$s_width=$s_w[0];
			$s_height=$s_h[0];
			
			echo $s_width."-".$s_height;
		$small_image = imagecreatetruecolor($s_width, $s_height);
		$image = imagecreatefrompng($filename);

		imagecopyresampled($small_image, $image, 0, 0, 0, 0, $s_width, $s_height, $width, $height);
		imagejpeg($small_image, $url, 100);

		imagedestroy($image);
		imagedestroy($small_image);
	}

	function add_template($img, $logo, $url, $left, $top, $right, $bottom)
	{
		$vx=0;
		$vy=0;


		$logo_w_h = getimagesize($logo);
		$getimg_w_h = getimagesize($img);

		if($left>0)
		{
			$vx=$vx+$left;
		}
		if($top>0)
		{
			$vy=$vy+$top;
		}

		if($right>0)
		{
		$vx=$getimg_w_h[0]-$logo_w_h[0]-$right;
		}
		if($right<0)
		{
		$vx=$getimg_w_h[0]-$logo_w_h[0];
		}
		if($bottom>0)
		{
		$vy=$getimg_w_h[1]-$logo_w_h[1]-$bottom;
		}
		if($bottom<0)
		{
		$vy=$getimg_w_h[1]-$logo_w_h[1];
		}


		$logo=imagecreatefrompng($logo);
		$image=imagecreatefromjpeg($img);
		imagecopy($image, $logo, $vx, $vy,	0, 0, $logo_w_h[0],	$logo_w_h[1]);
		imagejpeg($image, $url,"100");
		imagedestroy($image);
		imagedestroy($logo);

	}


	function img_resize($filename,  $small_size, $url)
	{
        ini_set('memory_limit', '64M');	
		$info_img = getimagesize($filename);
		list($width, $height) = $info_img;
		$s=explode("/",$filename);
		//echo $s[1];
		if($width > $height)
		{
			$s_width = $small_size;
			$s_height = $small_size*($height/$width);
		}
		if($width < $height)
		{
			$s_width = $small_size*($width/$height);
			$s_height = $small_size;
		}
		if($width == $height)
		{
			$s_width = $small_size;
			$s_height = $small_size;
		}

		$small_image = imagecreatetruecolor($s_width, $s_height);


		if($info_img['mime'] == 'image/gif') 
		{
		$image = imagecreatefromgif($filename);
		}
		if($info_img['mime'] == 'image/jpeg') 
		{
		//$image = imagecreatefromgif($filename);

		$image = imagecreatefromjpeg($filename);
		}
		if($info_img['mime'] == 'image/png') 
		{
		$image = imagecreatefrompng($filename);
		}
		
		imagecopyresampled($small_image, $image, 0, 0, 0, 0, $s_width, $s_height, $width, $height);
		imagejpeg($small_image, $url, 100);

		imagedestroy($image);
		imagedestroy($small_image);

	}

	function img_resize_all($filename, $filename_logo, $small_size)
	{
		//$filename = "test/".$_FILES['ph']['name']; // путь до картинки
		//$filename_logo = "logo.png"; // путь до логотипа PNG
		//$small_size = 128; // максимальный размер превьюшки

		$info_img = getimagesize($filename); // собераем информацию изображения
		list($width, $height) = $info_img;

		// определяем пропорции
		if($width > $height)
		{
			$s_width = $small_size;
			$s_height = $small_size*($height/$width);
		}

		if($width < $height)
		{
			$s_width = $small_size*($width/$height);
			$s_height = $small_size;
		}
		if($width == $height)
		{
			$s_width = $small_size;
			$s_height = $small_size;
		}

		$small_image = imagecreatetruecolor($s_width, $s_height);
		//$big_image = imagecreatetruecolor($width, $height);


		// определяем тип изображения
		if($info_img['mime'] == 'image/gif') {
		$image = imagecreatefromgif($filename);
		}
		if($info_img['mime'] == 'image/jpeg') {
		$image = imagecreatefromjpeg($filename);
		}
		if($info_img['mime'] == 'image/png') {
		$image = imagecreatefrompng($filename);
		}

		imagecopyresampled($small_image, $image, 0, 0, 0, 0, $s_width, $s_height, $width, $height);
		//imagecopyresampled($big_image, $image, 0, 0, 0, 0, $width, $height, $width, $height);

		// накладываем лого на большое изображение
		imagealphablending($image, true);
		$logo_image = imagecreatefrompng($filename_logo);
		$logo_width = ImageSX($logo_image);
		$logo_height = ImageSY($logo_image);
		//imagecopy($big_image, $logo_image, $width-($logo_width+10), $height-($logo_height+10), 0, 0, $logo_width, $logo_height);

		// сохраняем 2 изображения
		imagejpeg($small_image, "test/".$_FILES['ph']['name'], 100);
		//imagejpeg($big_image, "test/big_".$_FILES['ph']['name'], 80);

	}



	function img_ss($img)
	{
		//$img="1.jpg";
		$pic = imagecreatefromjpeg($img);
		$size=getimagesize($img);
		$color=imagecolorallocate($pic, 255, 255, 255);
//		$color2=imagecolorallocate($pic, 0, 0, 0);
//		imagettftext($pic, 24, 0, 30, 40, $color2, "tahoma.ttf", "www.rispekt.ru");
		imagettftext($pic, 24, 0, 31, 41, $color, "tahoma.ttf", "www.rispekt.ru");

		imagejpeg($pic,$img);
		imagedestroy($pic);

	}


	function read_templ()
	{
			$fl=file("template.txt");
			?>
			<table>
           <tr>

			<?
            	for($i=1;$i<count($fl);$i++)
				{
					list($url,$left,$top,$right,$bottom,$name)=explode('|',$fl[$i]);

				?>
                <td>
                <a>
                	<img src="template/<?=$url?>" />
                </a>
                    <br />
                    <?=$name?>
                </td>
                <?
				}

			?>
            </tr>
            </table>
            <?
	}


function img_mob($file, $width, $heigth, $quality, $url)
{
			$size = getimagesize($file);
				//$l=$size[0]/$width;
			if($size[1]>$size[0])
			{
				$l=$size[1]/$width;
			}
			elseif($size[0]>$size[1])
			{
				$l=$size[0]/$width;
			}
			elseif($size[0] == $size[1])
			{
			$l=$size[0]/$width;
			}

			if(($size[0] >= $width)&&($size[1] >= $heigth))
			{
					if ($size === false) die ('Bad image file!');
					$m=explode(".", $file);
					if(($m[1] == 'jpeg')||($m[1] == 'jpg')||($m[1] == 'JPG')||($m[1] == 'JPEG'))
					{
					   $source = imagecreatefromjpeg($file)
						or die('Cannot load original JPEG');
						 $target = imagecreatetruecolor($width, $heigth);
						  $white = imagecolorallocate($target, 255, 255, 255);
						  imagefill($target, 0, 0, $white);
						  imagecopyresampled($target, $source,($width-$size[0]/$l)/2,($heigth-$size[1]/$l)/2,0,0, $size[0]/$l, $size[1]/$l, $size[0], $size[1]);
						  imagejpeg($target, $url, $quality);
						  imagedestroy($target);
						  imagedestroy($source);
					}
					if(($m[1] == 'gif')||($m[1] == 'GIF'))
					{
					   $source = imagecreatefromgif($file)
						or die('Cannot load original JPEG');
						 $target = imagecreatetruecolor($width, $heigth);
						  $white = imagecolorallocate($target, 255, 255, 255);
						  imagefill($target, 0, 0, $white);
						  imagecopyresampled($target, $source,($width-$size[0]/$l)/2,($heigth-$size[1]/$l)/2,0,0, $size[0]/$l, $size[1]/$l, $size[0], $size[1]);
						  imagegif($target, $url, $quality);
						  imagedestroy($target);
						  imagedestroy($source);
					}



				}

				else
				{
					if ($size === false) die ('Bad image file!');
					$m=explode(".", $file);
					if(($m[1] == 'jpeg')||($m[1] == 'jpg')||($m[1] == 'JPG')||($m[1] == 'JPEG'))
					{
					   $source = imagecreatefromjpeg($file)
						or die('Cannot load original JPEG');
						 $target = imagecreatetruecolor($width, $heigth);
						  $white = imagecolorallocate($target, 255, 255, 255);
						  imagefill($target, 0, 0, $white);
						  imagecopyresampled($target, $source,($width-$size[0]/$l)/2,($heigth-$size[1]/$l)/2,0,0, $size[0]/$l, $size[1]/$l, $size[0], $size[1]);
						  imagejpeg($target, $url, $quality);
						  imagedestroy($target);
						  imagedestroy($source);
					}
					if(($m[1] == 'gif')||($m[1] == 'GIF'))
					{
					   $source = imagecreatefromgif($file)
						or die('Cannot load original JPEG');
						 $target = imagecreatetruecolor($width, $heigth);
						  $white = imagecolorallocate($target, 255, 255, 255);
						  imagefill($target, 0, 0, $white);
						  imagecopyresampled($target, $source,($width-$size[0]/$l)/2,($heigth-$size[1]/$l)/2,0,0, $size[0]/$l, $size[1]/$l, $size[0], $size[1]);
						  imagegif($target, $url, $quality);
						  imagedestroy($target);
						  imagedestroy($source);
					}


				}
//-----------------------------------------------------------------------------------------

}



	function del_old_file()
	{


	$dt=date("d");
	$files=0;
	$mdir = opendir ( "test" );
	 while ( $file = readdir( $mdir ) )
	 {
	   if ( ($file != ".") && ($file != ".."))
	   {
			$stat=stat("test/".$file);
			$data_mod=date("d", $stat[9]);
			if($dt>$data_mod)
			{
				unlink("test/".$file);
			}
	   }
	 }
	 closedir ( $mdir );

	}
function Get2Pass()
{


	$tuk=8;
	$luk=1;

       $gl[0]='0';
       $gl[1]='1';
       $gl[2]='2';
       $gl[3]='3';
       $gl[4]='4';
       $gl[5]='5';
       $gl[6]='6';
       $gl[7]='7';
       $gl[8]='8';
       $gl[9]='9';

       $so[0]='0' ;
       $so[1]='1' ;
       $so[2]='2' ;
       $so[3]='3' ;
       $so[4]='4' ;
       $so[5]='5' ;
       $so[6]='6' ;
       $so[7]='7' ;
       $so[8]='8' ;
       $so[9]='9' ;

 /**********************************************/

        srand((double)microtime() * 1000000);

        for($ij=0; $ij<$luk; $ij++)
                    {

        $mi=floor(rand(1, 20));


 /**********************************************/
             if ($mi>9  ) {
             for($iii=0; $iii<$tuk; $iii++) {



                  $ii= floor(rand(1, 19));

                  $ma[$iii]=$gl[$ii+1];
                  $iii=$iii+1;

                  $ii=  floor(rand(1, 19));
                  $ma[$iii]=$so[$ii+1];  } }

 /**********************************************/

             if ($mi<10  ) {
             for($ii1=0; $ii1<$tuk; $ii1++) {

             $ii=floor(rand(1, 19));

             $ma[$ii1]=$so[$ii+1];
             $ii1=$ii1+1;

             $ii=floor(rand(1, 19));
             $ma[$ii1]=$gl[$ii+1];   }   }
 /**********************************************/
			$m[]='';
               for($ik=0; $ik< $tuk; $ik++)
		{
        	 $m[$ij]=$m[$ij].$ma[$ik];

	}
		   	//echo "--".$m[$ij]."--";
		   ?>
		   <BR>
           <?

}

  $f1=$m[0];
  //$f2=$m[1];

	//$ms=mysql_query("INSERT INTO `temp`(`inp`,`outp`) VALUES ('$m[0]', '$m[1]')");

//echo "fi1-".$f1."---------<br>";
//echo "fi2-".$f2."---------<br>";
	return $f1;
}

function upload_img($file, $width, $heigth, $dir,  $pref, $quality)
{
$SOURCE = $_FILES["$file"]["tmp_name"];
			 $m=explode(".", $_FILES["$file"]["name"]);
			 if(($m[1] == 'jpeg')||($m[1] == 'jpg')||($m[1] == 'JPG')||($m[1] == 'JPEG')||($m[1] == 'gif')||($m[1] == 'GIF'))
			 {
			 $size = getimagesize($SOURCE);
			
			if ($size === false) die ('Bad image file!');	
				$l=$size[0]/$width;
					$f1 = 0;
					$f2 = 0;			
			}
			
					if(($m[1] == 'jpeg')||($m[1] == 'jpg')||($m[1] == 'JPG')||($m[1] == 'JPEG'))
					{
				if($size[0]<=$width || $size[1]<=$heigth) $l=1;
				
				if($size[0] >$width && $size[0]>=$size[1])
					{
						$l=$size[0]/$width; 
						if(($size[1]/$l)>$heigth)
							{
								$f1 = (($size[1]/$l)-$heigth);
								
							}
					}
				
				if($size[1] >$heigth && $size[1]>=$size[0])
					{
						$l=$size[1]/$heigth;
						if(($size[0]/$l)>$width)
							{
								$f2 = (($size[0]/$l)-$width);
								
							}
					}	
					$NEWXI = $size[0]/$l;
					$NEWYI = $size[1]/$l;
					$NEWX = ($size[0]/$l)-$f2;
					$NEWY = ($size[1]/$l)-$f1;
					$NEWXN = $width;
					$NEWYN = $heigth;
					   
					   $source = imagecreatefromjpeg($SOURCE)
						or die('Cannot load original JPEG');
						 $target = imagecreatetruecolor($NEWX, $NEWY); 
						 						 						  
						 imagecopyresampled($target, $source,0,0,$f2,$f1, $NEWXI+6, $NEWYI+6, $size[0], $size[1]);
						 $name = $pref.$m[0].".".$m[1];
						 
						  imagejpeg($target, $dir.$name, $quality);
						  imagedestroy($target);
						  imagedestroy($source);
					}
					
					if(($m[1] == 'gif')||($m[1] == 'GIF'))
					{
					   	if($size[0]<=$width || $size[1]<=$heigth) $l=1;
						if($size[0] >$width && $size[0]>=$size[1])
							{
								$l=$size[0]/$width; 
						
							}
						if($size[1] >$heigth && $size[1]>=$size[0])
							{
								$l=$size[1]/$heigth;
							}	
					
					$NEWX = $size[0]/$l;
					$NEWY = $size[1]/$l;
					$NEWXN = $width;
					$NEWYN = $heigth;
					   
					   $source = imagecreatefromgif($SOURCE)
						or die('Cannot load original GIF');
						 $target = imagecreatetruecolor($NEWXN, $NEWYN); 
						  
						  
						  imagecopyresampled($target, $source,0,0,$f1,$f2, $NEWX, $NEWY, $size[0], $size[1]);
						  $name = $pref.$m[0].".".$m[1];
						
						  imagegif($target, $dir.$name, $quality);
						  imagedestroy($target);
						  imagedestroy($source);
					}
							if(isset($name))
								{
									return($name);
								}		
							else
								{
									return('0');
								}
					
				
}	

function LoadJpeg ($imgname) {
    $im = @imagecreatefromjpeg ($imgname); /* попытка открыть */
    if (!$im) { /* проверить, удачно ли */
        $im  = imagecreate (150, 30); /* создать пустое изображение */
        $bgc = imagecolorallocate ($im, 255, 255, 255);
        $tc  = imagecolorallocate ($im, 0, 0, 0);
        imagefilledrectangle ($im, 0, 0, 150, 30, $bgc);
        /* вывести errmsg */
        imagestring ($im, 1, 5, 5, "Error loading $imgname", $tc);
    }
    return $im;
}
?>