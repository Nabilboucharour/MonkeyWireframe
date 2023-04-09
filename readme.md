Generate Animated Wireframes
============================

This PHP script generates an animated wireframe of a 3D object in `.obj` format. It takes a `.obj` file, extracts its vertices and faces, and then rotates the object around the X, Y, and Z axes to create a 360-degree animation.

DEMO
------------

[DEMO](https://piktar.tech/MonkeyWireframe/)

Requirements
------------

* PHP 5 or higher
* `GIFEncoder.class.php`

Installation
------------

1.  Clone the repository to your local machine
2.  Move the `GIFEncoder.class.php` file to the same directory as the script
3.  Run the script on your web server

Usage
-----

1.  Open the script in your browser
2.  Choose a `.obj` file to load
3.  Set the rotation angles for each axis
4.  Click on the "Generate" button to generate the animated wireframe

Functionality
-------------

The script extracts the vertices and faces from the `.obj` file and then rotates the object around the X, Y, and Z axes to create an animated wireframe. The animation can be rotated clockwise or counterclockwise by setting the appropriate checkbox. The number of frames in the animation can be controlled by changing the `$framesToshow` variable in the script.

The following functions are available in the script:

* `hexToRgb`: converts a hex color value to an RGB color value
* `deg2rad`: converts an angle in degrees to radians

Credits
-------

This script is based on the code from the [Rotate 3D Object Using Three.js](https://www.cloudways.com/blog/rotate-3d-object-using-three-js/) tutorial by Roshan Chaudhari.

The `GIFEncoder.class.php` file is from the [PHP GIF Animation](https://github.com/Sybio/GifCreator) library by Sybio.

License
-------

This script is licensed under the [MIT License](https://github.com/%3Cusername%3E/%3Crepository%3E/blob/master/LICENSE).