<?php
/**
 * TextToImage class
 * This class converts text to image
 * 
 * @author    CodexWorld Dev Team
 * @link    http://www.codexworld.com
 * @license    http://www.codexworld.com/license/
 
 
 */
 
 
 ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


class TextToImage {
    private $img;
    
    /**
     * Create image from text
     * @param string text to convert into image
     * @param int font size of text
     * @param int width of the image
     * @param int height of the image
     */
    function createImage($text, $fontSize = 20, $imgWidth = 400, $imgHeight = 500){

        //text font path
        //$font = 'C:\xampp\htdocs\Ebooks\font\slabo.ttf';
		$font = '/var/www/html/bookworm/font/slabo.ttf';
		$angle = '0';
        
        //create the image
        $this->img = imagecreatetruecolor($imgWidth, $imgHeight);
        
        //create some colors
        $white = imagecolorallocate($this->img, 005, 195, 255);
        $grey = imagecolorallocate($this->img, 128, 128, 128);
        $black = imagecolorallocate($this->img, 0, 0, 0);
        imagefilledrectangle($this->img, 0, 0, $imgWidth - 1, $imgHeight - 1, $white);
        
        //break lines
        $splitText = explode ( " " , $text );
        $lines = count($splitText)*2;
        
        foreach($splitText as $txt){
            $textBox = imagettfbbox($fontSize,$angle,$font,$txt);
            $textWidth = abs(max($textBox[2], $textBox[4]));
            $textHeight = abs(max($textBox[5], $textBox[7]));
            $x = (imagesx($this->img) - $textWidth)/2;
            $y = ((imagesy($this->img) + $textHeight)/2)-($lines-2)*$textHeight;
            $lines = $lines-2;
        
            //add some shadow to the text
            imagettftext($this->img, $fontSize, $angle, $x, $y, $grey, $font, $txt);
            
            //add the text
            imagettftext($this->img, $fontSize, $angle, $x, $y, $black, $font, $txt);
        }
	return true;
    }
	
	
	function creeteImage($text,$img){
						 // Create Image From Existing File
					$file = $img ; 
					$jpg_image = imagecreatefromjpeg($file);
					$orig_width = imagesx($jpg_image);
					$orig_height = imagesy($jpg_image);


					// Create your canvas containing both image and text
					$this->img = imagecreatetruecolor($orig_width,  ($orig_height + 40));
					// Allocate A Color For The background
					$bcolor = imagecolorallocate($this->img, 255, 255, 255);
					// Add background colour into the canvas
					imagefilledrectangle( $this->img, 0, 0, $orig_width, ($orig_height + 40), $bcolor);

					// Save image to the new canvas
					imagecopyresampled ( $this->img , $jpg_image , 0 , 0 , 0 , 0, $orig_width , $orig_height , $orig_width , $orig_height );

					// Tidy up:
					imagedestroy($jpg_image);

					// Set Path to Font File
					$font_path = realpath(dirname(__FILE__)).'/font/slabo.ttf';
					//exit;

					// Set Text to Be Printed On Image
					$text = "copyright by xyz.net";

					// Allocate A Color For The Text
					$color = imagecolorallocate($this->img, 0, 0, 0);      

					// Print Text On Image
					imagettftext($this->img,  20, 0, 10, $orig_height+25, $color, $font_path, $text);

					//Set the Content Type
					//header('Content-type: image/jpg');
					//imagejpeg($canvas);
					//imagedestroy($canvas);			
				    //exit;
					//echo 'Hello'; exit;
				   return true;
			}
    
    /**
     * Display image
     */
    function showImage(){
        header('Content-Type: image/png');
        return imagepng($this->img);
    }
    
    /**
     * Save image as png format
     * @param string file name to save
     * @param string location to save image file
     */
    function saveAsPng($fileName = 'text-image', $location = ''){
        $fileName = $fileName.".png";
        $fileName = !empty($location)?$location.$fileName:$fileName;
        return imagepng($this->img, $fileName);
    }
    
    /**
     * Save image as jpg format
     * @param string file name to save
     * @param string location to save image file
     */
    function saveAsJpg($fileName = 'text-image', $location = ''){
        $fileName = $fileName."";
        $fileName = !empty($location)?$location.$fileName:$fileName;
        return imagejpeg($this->img, $fileName);
    }
}