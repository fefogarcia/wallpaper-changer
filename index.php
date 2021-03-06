<?php

// Requires Dropbox upload function and filters
require 'dropbox.php';


require_once('classes/Image.php');
require_once('classes/Filter.php');
require_once('classes/Filter/Earlybird.php');
require_once('classes/Filter/Inkwell.php');



// Sets up ImageMagick objects and pulls in webcam image
$im = new Imagick('http://cam.westinnewyorktimessquareview.com/the-westin-new-york-at-times-square.jpg');


// Saves a timestamped version of the original image
$im->writeImage('images/'. time() .'.jpg');


// Resizes webcam image to wallpaper size
$im->adaptiveResizeImage(1440, 900, true);


// Saves temporary image for filtering
$im->writeImage('temp.jpg');


// Adds filter and saves wallpaper
\Instafilter\Image::load('temp.jpg')
//    ->apply_filter(new Instafilter\Filter\Inkwell())
    ->save('wallpaper.jpg');



// Uploads final image to Dropbox
uploadToDropbox('wallpaper.jpg');


// Deletes tempoerary image and sends success message to console
echo 'Success'.PHP_EOL;