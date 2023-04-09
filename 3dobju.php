<?php
/*
 * GENERATE ANIMATED WIREFRAMES
 */
include "GIFEncoder.class.php";

$frames= [ ];
$framed= [ ];
function hexToRgb($hex, $alpha = false) {
    $hex      = str_replace('#', '', $hex);
    $length   = strlen($hex);
    $rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
    $rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
    $rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));
    if ( $alpha ) {
        $rgb['a'] = $alpha;
    }
    return $rgb;
}
$framesToshow=360;
$passedFrames=360;

for($ii=0; $ii<$framesToshow; $ii+=10){
    // Load the .obj file
    $objFile = 'monkey.obj';
    $vertices = array();
    $faces = array();
    if (file_exists($objFile)) {
        $file = fopen($objFile, 'r');
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            if(isset($_FILES['obj-file']))
            {
                $file=fopen($_FILES['obj-file']['tmp_name'], 'r');
            }
        }
        while (!feof($file)) {
            $line = fgets($file);
            if (strpos($line, 'v ') === 0) {
                $vertex = explode(' ', trim($line));
                $vertices[] = array((float)$vertex[1], (float)$vertex[2], (float)$vertex[3]);
            } else if (strpos($line, 'f ') === 0) {
                $face = explode(' ', trim($line));
                $faces[] = array((float)$face[1]-1, (float)$face[2]-1, (float)$face[3]-1);
            }
        }
        fclose($file);
    }

//print_r($vertices); exit();

// Find the object's bounding box
    $minX = $maxX = $vertices[0][0];
    $minY = $maxY = $vertices[0][1];
    foreach ($vertices as $vertex) {
        $minX = min($minX, $vertex[0]);
        $maxX = max($maxX, $vertex[0]);
        $minY = min($minY, $vertex[1]);
        $maxY = max($maxY, $vertex[1]);
    }

// Define rotation angles for each axis in degrees
    $rotationX = 0;
    $rotationZ = 0;
    // $passedFrames=$passedFrames-$ii;

    if(isset($_POST['xrotate'])) $rotationX=$_POST['xrotate'];
    if(isset($_POST['zrotate'])) $rotationZ=$_POST['zrotate'];
    if(isset($_POST['yrotate'])) $rotationY=$_POST['zrotate'];

    if(isset($_POST['clockwise']) && !empty($_POST['clockwise'])) {

        if((isset($_POST['Axrotate']) && !empty($_POST['Axrotate']))){
            $rotationX=$passedFrames - $ii;
        }
        if((isset($_POST['Azrotate']) && !empty($_POST['Azrotate']))){
            $rotationZ=$passedFrames - $ii;
        }
        if((isset($_POST['Ayrotate']) && !empty($_POST['Ayrotate'])) || ((!isset($_POST['Azrotate']) || empty($_POST['Azrotate'])) && (!isset($_POST['Axrotate']) || empty($_POST['Axrotate'])))){
            $rotationY=$passedFrames - $ii;
        }
    }else{
        if((isset($_POST['Axrotate']) && !empty($_POST['Axrotate']))){
            $rotationX=$ii;
        }
        if((isset($_POST['Azrotate']) && !empty($_POST['Azrotate']))){
            $rotationZ=$ii;
        }
        if((isset($_POST['Ayrotate']) && !empty($_POST['Ayrotate'])) || ((!isset($_POST['Azrotate']) || empty($_POST['Azrotate'])) && (!isset($_POST['Axrotate']) || empty($_POST['Axrotate'])))){
            $rotationY=$ii;
        }


    }



// Convert rotation angles to radians
    $angleX = deg2rad($rotationX);
    $angleY = deg2rad($rotationY);
    $angleZ = deg2rad($rotationZ);

// Apply rotation matrix to vertices
    foreach ($vertices as &$vertex) {
        $x = $vertex[0];
        $y = $vertex[1];
        $z = $vertex[2];

        // X-axis rotation
        $newY = $y * cos($angleX) - $z * sin($angleX);
        $newZ = $y * sin($angleX) + $z * cos($angleX);
        $y = $newY;
        $z = $newZ;

        // Y-axis rotation
        $newX = $x * cos($angleY) + $z * sin($angleY);
        $newZ = -$x * sin($angleY) + $z * cos($angleY);
        $x = $newX;
        $z = $newZ;

        // Z-axis rotation
        $newX = $x * cos($angleZ) - $y * sin($angleZ);
        $newY = $x * sin($angleZ) + $y * cos($angleZ);
        $x = $newX;
        $y = $newY;

        $vertex = array($x, $y, $z);
    }

    if(isset($_POST['ZoomEffect']) && !empty($_POST['ZoomEffect'])){
        foreach ($vertices as $vertex) {
            $minX = min($minX, $vertex[0]);
            $maxX = max($maxX, $vertex[0]);
            $minY = min($minY, $vertex[1]);
            $maxY = max($maxY, $vertex[1]);
        }
    }




// Calculate the zoom factor, adapted image width and height, and padding
    $zoom = 20;
    if(isset($_POST['zoom'])) $zoom=$_POST['zoom'];

    $imageWidth =600;
    $imageHeight = 450;


    $padding = 100;
    if(isset($_POST['padding'])) $padding=$_POST['padding'];
    $stroke = 1;
    if(isset($_POST['stroke'])) $stroke=$_POST['stroke'];
    if((isset($_POST['autoZoom']) && !empty($_POST['autoZoom'])) || (isset($_POST['ZoomEffect']) && !empty($_POST['ZoomEffect']))) {
        if (($maxX - $minX) / $imageWidth < 1) $zoom = (int)(($imageWidth) / ($maxX - $minX)) / 1.5;
    }
    $width = ($maxX - $minX) * $zoom;
    $height = ($maxY - $minY) * $zoom;
// Calculate the centered offset with padding
    $offsetX = ($imageWidth - $width) / 2;
    $offsetY = ($imageHeight - $height) / 2;
    $offsetX += $padding;
    $offsetY += $padding;

// Create a new image
    $image = imagecreatetruecolor($imageWidth + $padding * 2, $imageHeight + $padding * 2);
    $transparent = imagecolorallocatealpha($image, 255, 255, 255, 127);
    imagefill($image, 0, 0, $transparent);
    imagesavealpha($image, true);
    imagesetthickness($image, $stroke);

    $grey = imagecolorallocate($image, 202, 203, 202);
    // Define the size and spacing of the dots
    $dot_size = 2;
    $dot_spacing = 20;

// Fill the image with dots
    for ($x = $dot_spacing; $x < ($imageWidth + $padding * 2); $x += $dot_spacing) {
        for ($y = $dot_spacing; $y < ($imageHeight + $padding * 2); $y += $dot_spacing) {
            imagefilledellipse($image, $x, $y, $dot_size, $dot_size, $grey);
        }
    }
    if(isset($_POST['color'])){
        $nColor=hexToRgb($_POST['color']);
        $black = imagecolorallocate($image, $nColor['r'], $nColor['g'], $nColor['b']);
    }
// Draw the polygons
    foreach ($faces as $face) {
        $verticesCount = count($face);
        $polygonPoints = array();
        for ($i = 0; $i < $verticesCount; $i++) {
            $vertexIndex = $face[$i];
            $vertex = $vertices[$vertexIndex];
            $x = ($vertex[0] - $minX) * $zoom + $offsetX;
            $y = ($maxY - $vertex[1]) * $zoom + $offsetY;
            $polygonPoints[] = $x;
            $polygonPoints[] = $y;
        }
       // $fillcolor = imagecolorallocate($image, 202, 203, 202);
       // imagefilledpolygon($image, $polygonPoints, $verticesCount, $fillcolor);
        imagepolygon($image, $polygonPoints, $verticesCount, $black);

    }
    $black = imagecolorallocate($image, 0, 0, 0);
    $icon = imagecreatefrompng('logo.png');
    imagecopyresized($image, $icon, 20, imagesy($image)-48, 0, 0, 48, 48,200,200);
    imagestring($image, 5, 75, imagesy($image)-32, "MonkeyWireframe", $black);
// Apply Gaussian interpolation
   // imagefilter($image, IMG_FILTER_GAUSSIAN_BLUR);
    // Convert the image to a PNG string
    $delay=1;
    if(isset($_POST['delay']) && !empty($_POST['delay'])) $delay=$_POST['delay'];
    ob_start();
    imagegif($image);
    $png_data = ob_get_clean();
    $frames[]=$png_data;
    $framed[]=$delay;
    $loops = 0;
    imagedestroy($image);

}

try{
    $gif = new GIFEncoder	(
        $frames,
        $framed,
        0,
        2,
        1, 1, 1,
        "bin"
    );




// Encode the PNG data as base64
    $base64_png = base64_encode($gif->GetAnimation ( ));

// Return the base64 encoded PNG image
    header('Content-Type: text/plain');
    echo $base64_png;
    imagedestroy($image);
}catch(Exception $e){

}

