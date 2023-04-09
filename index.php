<html>
<head>
    <head>
        <title>MonkeyWireframe - A User-Friendly Tool to Generate Wireframe Images and Animation from OBJ Files</title>
        <meta name="description" content="MonkeyWireframe is an intuitive and easy-to-use app that allows you to effortlessly generate wireframe images and animation from OBJ files. Whether you're a graphic designer, 3D artist, or hobbyist, MonkeyWireframe provides you with a powerful tool to visualize your ideas in a whole new way. With its sleek interface and robust features, MonkeyWireframe is the ultimate solution for anyone looking to create stunning wireframe images and animation from OBJ files.">
        <meta name="keywords" content="MonkeyWireframe, wireframe images, wireframe animation, OBJ files, 3D modeling, graphic design, visualization, user-friendly, intuitive, powerful, easy-to-use">
        <link rel="icon" type="image/png" href="logo.png" />

    </head>
    <style>
        body {
            font-family: 'Courier New';
        }

        #mainContainer{
            width:100%;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .previewImg{
            border:1px solid rgb(202,203,202);
            height: 600px;
        }

        .col-1 {width: 8.33%;}
        .col-2 {width: 16.66%;}
        .col-3 {width: 25%;}
        .col-4 {width: 33.33%;}
        .col-5 {width: 41.66%;}
        .col-6 {width: 50%;}
        .col-7 {width: 58.33%;}
        .col-8 {width: 66.66%;}
        .col-9 {width: 75%;}
        .col-10 {width: 83.33%;}
        .col-11 {width: 91.66%;}
        .col-12 {width: 100%;}

        @media only screen and (max-width: 768px) {
            /* For mobile phones: */
            [class*="col-"] {
                width: 100% !important;
            }

            #mainContainer{
                flex-direction: column;
            }
        }

        .textPreview{
            margin-left: 5px;
        }

        .logoTitle {
            display: flex;
            align-items: center;
            margin-bottom: 24px;
        }

        .logoImg {
            margin-right: 12px;
            width: 50px;
        }

        table {

            margin-bottom: 24px;
        }
td{
    padding:12px;
}
        .mainBtn {
            font-family: 'Courier New';
            background: #0F37FF;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px;
            cursor: pointer;
        }

        input[type=range] {
            height: 37px;
            -webkit-appearance: none;
            margin: 10px 0;
            width: 100%;
        }

        input[type=range]:focus {
            outline: none;
        }

        input[type=range]::-webkit-slider-runnable-track {
            width: 100%;
            height: 13px;
            cursor: pointer;
            animate: 0.2s;
            box-shadow: 0px 0px 2px #000000;
            background: #DDDDDD;
            border-radius: 49px;
            border: 0px solid #4A4A4A;
        }

        input[type=range]::-webkit-slider-thumb {
            box-shadow: 1px 1px 1px #9E9E9E;
            border: 2px solid #0F37FF;
            height: 28px;
            width: 12px;
            border-radius: 6px;
            background: #0A7CFF;
            cursor: pointer;
            -webkit-appearance: none;
            margin-top: -8.5px;
        }

        input[type=range]:focus::-webkit-slider-runnable-track {
            background: #DDDDDD;
        }

        input[type=range]::-moz-range-track {
            width: 100%;
            height: 13px;
            cursor: pointer;
            animate: 0.2s;
            box-shadow: 0px 0px 2px #000000;
            background: #DDDDDD;
            border-radius: 49px;
            border: 0px solid #4A4A4A;
        }

        input[type=range]::-moz-range-thumb {
            box-shadow: 1px 1px 1px #9E9E9E;
            border: 2px solid #0F37FF;
            height: 28px;
            width: 12px;
            border-radius: 6px;
            background: #0A7CFF;
            cursor: pointer;
        }

        input[type=range]::-ms-track {
            width: 100%;
            height: 13px;
            cursor: pointer;
            animate: 0.2s;
            background: transparent;
            border-color: transparent;
            color: transparent;
        }

        input[type=range]::-ms-fill-lower {
            background: #DDDDDD;
            border: 0px solid #4A4A4A;
            border-radius: 98px;
            box-shadow: 0px 0px 2px #000000;
        }

        input[type=range]::-ms-fill-upper {
            background: #DDDDDD;
            border: 0px solid #4A4A4A;
            border-radius: 98px;
            box-shadow: 0px 0px 2px #000000;
        }

        input[type=range]::-ms-thumb {
            margin-top: 1px;
            box-shadow: 1px 1px 1px #9E9E9E;
            border: 2px solid #0F37FF;
            height: 28px;
            width: 12px;
            border-radius: 6px;
            background: #0A7CFF;
            cursor: pointer;
        }

        input[type=range]:focus::-ms-fill-lower {
            background: #DDDDDD;
        }

        input[type=range]:focus::-ms-fill-upper {
            background: #DDDDDD;
        }

    </style>
</head>
<body>
<div >
    <h1 class="logoTitle"><img src="logo.png" class="logoImg"> MonkeyWireframe </h1>

    <div id="mainContainer">
    <table class="col-6">
        <tbody>
        <tr>
            <td colspan="3">
                <label>.obj file</label> <br>
                <input type="file" id="obj-file" accept=".obj">
            </td>
        </tr>
        <tr valign= "top">
            <td>
                <label>Zoom <span class="textPreview" id="text-zoom">1x</span></label> <br>
                <input type="range" value="1" min="1" max="2000" name="zoom" id="zoom" oninput="showInputValue(this.id);" disabled><br>
                <input type="checkbox" id="autoZoom" value="1" onclick="setZoomStatus()" checked> Auto Zoom
            </td>
            <td>
                <label width="100">Padding <span class="textPreview" id="text-padding">100px</span></label><br>
                <input type="range" value="100" min="0" max="200" name="padding" id="padding" oninput="showInputValue(this.id);">
            </td>
            <td>
                <label width="100">Stroke width <span class="textPreview" id="text-stroke">1px</span></label><br>
                <input type="range" value="1" min="1" max="5" name="stroke" id="stroke" oninput="showInputValue(this.id);"><br>
                <input type="color" value="#000000" id="color">
            </td>
        </tr>
        <tr valign= "top">
            <td>
                <label>X-rotation <span class="textPreview" id="text-xrotate">0°</span></label> <br>
                <input type="range" value="0" min="0" max="360" name="xrotate" id="xrotate" oninput="showInputValue(this.id);"><br>
                <input type="checkbox" id="Axrotate" disabled> Animate
            </td>
            <td>
                <label>Y-rotation <span class="textPreview" id="text-yrotate">0°</span></label> <br>
                <input type="range" value="0" min="0" max="360" name="yrotate" id="yrotate" oninput="showInputValue(this.id);"><br>
                <input type="checkbox" id="Ayrotate" disabled checked> Animate

            </td>
            <td>
                <label>Z-rotation <span class="textPreview" id="text-zrotate">0°</span></label> <br>
                <input type="range" value="0" min="0" max="360" name="zrotate" id="zrotate" oninput="showInputValue(this.id);"><br>
                <input type="checkbox" id="Azrotate" disabled> Animate
            </td>
        </tr>

        <tr valign= "top">
            <td>
                <input type="checkbox" id="animatedGif" value="1" onclick="setAnimationStatus()">
                <label>Generate Animated GIF</label><br>
                <input type="checkbox" id="clockwise" disabled>Clockwise

            </td>
            <td>
                <input type="checkbox" id="ZoomEffect" value="1" disabled>
                <label>Zoom In Out effect</label>

            </td>
            <td>
                <label>Delay <span class="textPreview" id="text-delay">1ms</span></label> <br>
                <input type="range" value="0" min="1" max="100" name="delay" id="delay" oninput="showInputValue(this.id);" disabled>
            </td>
        </tr>
        <tr>

            <td>

            </td>
            <td>
                <button onclick="generate3d(false);" class="mainBtn"> Generate 3D view</button>
            </td>
            <td>
                <button onclick="generate3d(true);" class="mainBtn"> Download 3D view</button>
            </td>
        </tr>
        </tbody>
    </table>

    <img class="col-6 previewImg" id="3dview" src="" onerror="this.onerror=null;this.src='placeholder.png';" >
    </div>

</div>
</body>
</html>

<script>

    function setZoomStatus(){
        const autoZoom = document.getElementById("autoZoom").checked?1:0;
        if(autoZoom==1){
            document.getElementById("zoom").disabled=true;
        }else{
            document.getElementById("zoom").disabled=false;
        }
    }



    function setAnimationStatus(){
        const animation = document.getElementById("animatedGif").checked?1:0;
        if(animation==0){
            document.getElementById("ZoomEffect").disabled=true;
            document.getElementById("delay").disabled=true;
            document.getElementById("Axrotate").disabled=true;
            document.getElementById("Ayrotate").disabled=true;
            document.getElementById("Azrotate").disabled=true;
            document.getElementById("clockwise").disabled=true;
        }else{
            document.getElementById("ZoomEffect").disabled=false;
            document.getElementById("delay").disabled=false;
            document.getElementById("Axrotate").disabled=false;
            document.getElementById("Ayrotate").disabled=false;
            document.getElementById("Azrotate").disabled=false;
            document.getElementById("clockwise").disabled=false;
        }
    }
    function generate3d(download = false) {
        // Get input values and file data
        const zoom = document.getElementById("zoom").value;
        const padding = document.getElementById("padding").value;
        const stroke = document.getElementById("stroke").value;
        const xrotate = document.getElementById("xrotate").value;
        const yrotate = document.getElementById("yrotate").value;
        const zrotate = document.getElementById("zrotate").value;
        const color = document.getElementById("color").value;
        const file = document.getElementById("obj-file").files[0];
        const autoZoom = document.getElementById("autoZoom").checked?1:0;
        const animatedGif = document.getElementById("animatedGif").checked?1:0;
        const ZoomEffect = document.getElementById("ZoomEffect").checked?1:0;
        const delay = document.getElementById("delay").value;
        const Axrotate = document.getElementById("Axrotate").checked?1:0;
        const Ayrotate = document.getElementById("Ayrotate").checked?1:0;
        const Azrotate = document.getElementById("Azrotate").checked?1:0;
        const clockwise = document.getElementById("clockwise").checked?1:0;

        // Set loading image source
        const img = document.getElementById("3dview");
        img.src = "loading.gif";

        // Create FormData object to send input data and file
        const formData = new FormData();
        formData.append("zoom", zoom);
        formData.append("padding", padding);
        formData.append("stroke", stroke);
        formData.append("xrotate", xrotate);
        formData.append("yrotate", yrotate);
        formData.append("zrotate", zrotate);
        formData.append("color", color);
        formData.append("delay", delay);
        formData.append("ZoomEffect", ZoomEffect);
        formData.append("autoZoom", autoZoom);
        formData.append("Axrotate", Axrotate);
        formData.append("Ayrotate", Ayrotate);
        formData.append("Azrotate", Azrotate);
        formData.append("clockwise", clockwise);
        formData.append("obj-file", file);

        // Create AJAX request
        const xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                // Get response data as image source
                const resultImgSrc = (animatedGif==1)?"data:image/gif;base64,"+ this.responseText:"data:image/png;base64," + this.responseText;

                // Set image source
                img.src = resultImgSrc;
                if (download) {
                    downloadImage(resultImgSrc);
                }
            }
        };



        // Send input data and file as POST request to PHP file
        var url="3dobje.php";
        if(animatedGif==1) url="3dobju.php";
        xhttp.open("POST", url, true);
        xhttp.onload = function () {
            if (xhttp.readyState === xhttp.DONE) {
                if (xhttp.status === 200) {
                    console.log(xhttp.responseText);
                }
            }
        };
        xhttp.send(formData);
    }


    function downloadImage(resultImgSrc) {
        const animatedGif = document.getElementById("animatedGif").checked?1:0;

        // Create a temporary link element
        const link = document.createElement('a');
        link.download = (animatedGif==1)?'MonkeyWireframe_image.gif':'MonkeyWireframe_image.png';
        link.href = resultImgSrc;
        link.click();
    }

    function showInputValue(id)
    {
        let suffix = '';
        switch (id) {
            case 'zoom':
                suffix = 'x';
                break;

            case 'padding':
                suffix = 'px';
                break;

            case 'xrotate':
                suffix = '°';
                break;
            case 'yrotate':
                suffix = '°';
                break;
            case 'zrotate':
                suffix = '°';
                break;

            case 'stroke':
                suffix = 'px';
                break;
        }
        document.getElementById('text-' + id).innerHTML = document.getElementById(id).value+suffix;
    }

    var uploadField = document.getElementById("obj-file");

    uploadField.onchange = function() {
        if(this.files[0].size > 2097152){
            alert("File is too big!");
            this.value = "";
        };
    };
</script>