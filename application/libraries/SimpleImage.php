<?php 
 
/*
* File: SimpleImage.php
* Author: Simon Jarvis
* Modified: Hendro Wibowo, Immanuel Bayu
* Copyright: 2006 Simon Jarvis
* Date: 08/11/06
* Link: http://www.white-hat-web-design.co.uk/articles/php-image-resizing.php
*
* This program is free software; you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation; either version 2
* of the License, or (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details:
* http://www.gnu.org/licenses/gpl.html
*
*/
 
class SimpleImage { 
   var $image;
   var $image_type;
   var $overwrite = TRUE;
   var $border = TRUE;
   var $ratio;
   var $min_width = 500;
  
   function load($filename) {
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {
         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {
         $this->image = imagecreatefrompng($filename);
      }
   }
   
   function save($filename, $image_type, $compression=100, $permissions=null) {
      if($this->overwrite == TRUE) $this->overwriteFile($filename);
      if($this->border == TRUE) $this->drawBorder('210,210,210');
      if($image_type == IMAGETYPE_JPEG ) {
        imagejpeg($this->image,$filename,$compression);
      } else if( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image,$filename);
      } else if( $image_type == IMAGETYPE_PNG ) {
         imagepng($this->image,$filename);
      }
      if( $permissions != null) { 
         chmod($filename,$permissions);
      }
	  
   }
   
   function output($image_type) {
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) { 
         imagegif($this->image);
      } elseif( $image_type == IMAGETYPE_PNG ) { 
         imagepng($this->image);
      }
   }
   
   function getWidth() { 
      return imagesx($this->image);
   }
   
   function getHeight() { 
      return imagesy($this->image);
   }
   
   function resizeToHeight($height, $is_minimum_set = FALSE) { 
      $this->ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $this->ratio;
	  
	  $this->resize($width,$height);
   }

   function resizeToWidth($width) {
      $this->ratio = $width / $this->getWidth();
      $height = $this->getheight() * $this->ratio;
      
	  $this->resize($width,$height);
   }
   
   function resizeWithMinToHeight($height) { 
      $this->ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $this->ratio;
	  
	  if($this->getWidth() > $this->min_width) $this->resize($width,$height);
   }

   function resizeWithMinToWidth($width) {
      $this->ratio = $width / $this->getWidth();
      $height = $this->getheight() * $this->ratio;
      
	  if($this->getWidth() > $this->min_width) $this->resize($width,$height);
   }

   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100;
      $this->resize($width,$height);
   }
 
   function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
	  /* setel png dan gif jika transparan */
	  if($this->image_type == 1 || $this->image_type == 3){
		imagealphablending($new_image, false);
		imagesavealpha($new_image,true);
		$transparent = imagecolorallocatealpha($new_image, 255, 255, 255, 127);
		imagefilledrectangle($new_image, 0, 0, $width, $height, $transparent);
		imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(),  $this->getHeight());
	  } else { /* untuk jpeg */
		imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
	  }
      $this->image = $new_image;
   }   
   
   function crop($x, $y, $target_w, $target_h) {
      $new_image = imagecreatetruecolor($target_w, $target_h);
      imagecopyresampled($new_image, $this->image, 0, 0, $x, $y, $target_w, $target_h, $target_w, $target_h);
      $this->image = $new_image;
   }   
   
   function drawBorder($color, $thickness = 1) {
      $x1 = 0; 
      $y1 = 0; 
      $x2 = imagesx($this->image) - 1; 
      $y2 = imagesy($this->image) - 1;
      
      list($r, $g, $b) = explode(',', $color);
      
      $bordercolor = imagecolorallocate($this->image, $r, $g, $b);
      
      for($i = 0; $i < $thickness; $i++) { 
        imagerectangle($this->image, $x1++, $y1++, $x2--, $y2--, $bordercolor); 
      } 
   }
     
   function overwriteFile($filename) {
      if(file_exists($filename)) {
          return @unlink($filename);
      }
      
      return FALSE;
   }
   
   function getImgRatio() {
       return $this->ratio;
   }
   
   function get_dpi($filename){	
   		$a = fopen($filename,'r');  
		$string = fread($a,20);  
		fclose($a);  
		
		$data = bin2hex(substr($string,14,4));
		$x = substr($data,0,4);
		$y = substr($data,0,4);
	
		return array(hexdec($x),hexdec($y));
	}
}

/**
 * End of file image_processing.php
 * 
 */