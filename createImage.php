<?php


global $con;


//include TextToImage class
require_once 'TextToImage.php';



$directory = "images";
$images = glob("*.jpg");

print_r($images);

foreach($images as $image)
{
  echo $image;
  $img = new TextToImage;
  $text = 'This is sitename www.bbc.com';
  $img->creeteImage($text,$image);
  $img->saveAsJpg($image,'font/');
  
}



$i=0;
/*
while ($rowServices = mysqli_fetch_array($sqlBooks)){
    echo 'Hello';    
	$i++;
	echo '<br>';	
    if($i==7) { exit; }
	
	$text = $rowServices['title'];
	$img = new TextToImage;
	$img->createImage($text);
	$img->saveAsJpg($rowServices['title'],'uploads/ebook/coverImage');
	mysqli_query($con,"update books set image='".$rowServices['id'].'.jpg'."' where id='".$rowServices['id']."'");
}
*/

$i=0;



?>