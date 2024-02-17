<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="css/mapacz.css"> -->
    <title>Document</title>
    <style>
        :root {
            --bs-brown-pilot: #2F1107;
            --bs-brown-dark: #4F3732;
            --bs-brown-light: #EFE6E0;
            --bs-brown-mid: #BDA394;
            --bs-red: #FF0E1C;
            --bs-primary: #2F1107;
            --bs-secondary: #4F3732;
            --bs-success: #2F1107;
            --bs-info: #EFE6E0;
            --bs-warning: #BDA394;
            --bs-danger: #FF0E1C;
            --bs-light: #EFE6E0;
            --bs-dark: #4F3732;
            --bs-white: #FFFFFF;
            --bs-font-sans-serif: 'Raleway', sans-serif;
            --bs-gradient: linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0));
        }

        @font-face {
            font-family: 'mapy';
            src: url('css/mapy.woff') format('woff');
        }

        * {
            font-family: "Raleway", sans-serif;
        }

        .mapa {
            width: 100%;
            height: 100%;
            box-sizing: border-box;
            position: relative;
        }

        html {
            box-sizing: border-box;
            width: 100%;
            height: 100%;
        }

        body {
            box-sizing: border-box;
            width: 100%;
            height: 100%;
        }

        #control {
            position: absolute;
            top: 15px;
            right: 15px;
        }

        .zoom {
            background-color: var(--bs-brown-pilot);
            color: var(--bs-brown-light);
            width: 64px;
        }

        .buttons {
            display: flex;
            flex-direction: row;
            width: fit-content;
        }

        .button {
            display: inline-block;
            vertical-align: top;
            cursor: pointer;
            padding: 0;
            margin: 0;
            width: 31px;
            text-align: center;
            font-size: 17px;
            line-height: 27px;
            font-family: mapy;
            font-style: normal;
            font-weight: 400;
            outline: 0;
        }

        #white_line {
            width: 1px;
            background-color: var(--bs-brown-light);
            border-top: 3px solid var(--bs-brown-pilot);
            border-bottom: 3px solid var(--bs-brown-pilot);
        }

        .priblizeni {
            display: none;
            position: absolute;
        }

        .zoom_level {
            display: block;
            background-color: var(--bs-brown-pilot);
            width: 64px;
            padding: 5px;
            box-sizing: border-box;
            font-size: 12px;
            padding-bottom: 7px;
            cursor: pointer;

        }

        .zoom_level:hover {
            color: var(--bs-brown-light);
            background-color: var(--bs-red);
        }

        .zoom:hover .priblizeni {
            display: block;
        }

        .compass {
            margin-top: 15px;
            width: 63px;
            height: 63px;
            background: url(images/compass-n.png) center center no-repeat #fff;
            border-radius: 100%;
            -webkit-box-shadow: 0 0 2px 0 rgba(0, 0, 0, .3);
            -moz-box-shadow: 0 0 2px 0 rgba(0, 0, 0, .3);
            box-shadow: 0 0 2px 0 rgba(0, 0, 0, .3);
            background-color: var(--bs-brown-pilot);
            color: var(--bs-brown-light);
        }

        .pozice {
            background-color: var(--bs-brown-pilot);
            color: var(--bs-brown-light);
            font-weight: bold;
            align-self: end;
            border: none;
            padding: 0.375rem 0.75rem;
            cursor: pointer;
        }

        .pozice:hover {
            color: var(--bs-brown-light);
            background-color: var(--bs-red);
            /* border: 2px solid var(--bs-red); */
        }

        .button:hover {
            color: var(--bs-brown-light);
            background-color: var(--bs-red);
            /* border: 2px solid var(--bs-red); */
        }

        #tlacitka_pozice {
            display: flex;
            position: absolute;
            top: 15px;
            left: 15px;
        }
    </style>
</head>

<body>
    <div style="height: 20px;"></div>
    <div class="mapa">
        <div id="tlacitka_pozice">
            <?php
            require "log_tokens.php";
            foreach ($pozice as $mesto) {
                $nazev = $mesto["nazev"];
                $gps_x = $mesto["gps_x"];
                $gps_y = $mesto["gps_y"];
                $zoom = $mesto["zoom"];

                echo ("
            <div class='pozice' id='$nazev'>$nazev</div>
            <script>var pozice = document.getElementById('$nazev')
    pozice.addEventListener('click', function(){
        mapa.setView([$gps_x, $gps_y], $zoom, { animate: true })
    })</script>
            ");
            }
            ?>


        </div>
        <div id="control">
            <div class="zoom">
                <div class="buttons">
                    <div class="button" id="minus_button">-</div>
                    <div class="button" id="white_line"></div>
                    <div class="button" id="plus_button">+</div>
                </div>
                <div class="priblizeni">
                    <div class="zoom_level" value=2>Svět</div>
                    <div class="zoom_level" value=5>Stát</div>
                    <div class="zoom_level" value=8>Kraj</div>
                    <div class="zoom_level" value=11>Město</div>
                    <div class="zoom_level" value=14>Obec</div>
                    <div class="zoom_level" value=18>Ulice</div>
                </div>
            </div>
            <div class="compass" id="compass">
            </div>
            <script>
                var minus_button = document.getElementById("minus_button");
                var plus_button = document.getElementById("plus_button");
                var zoom_level = document.getElementsByClassName("zoom_level");
                minus_button.addEventListener("click", function () {
                    mapa.zoomOut();
                })
                plus_button.addEventListener("click", function () {
                    mapa.zoomIn();
                })
                for (var i = 0; i < zoom_level.length; i++) {
                    var element = zoom_level[i];
                    var zoom = element.getAttribute("value");
                    element.addEventListener("click", function () {
                        mapa.setView(mapa.getCenter(), zoom);
                        console.log("zoom is:", zoom)
                    })
                };

                var compass = document.getElementById("compass");
                let centerX = compass.offsetWidth / 2;
                let centerY = compass.offsetHeight / 2;
                compass.addEventListener('mousedown', handleTouchStart);
                document.addEventListener('mousemove', handleMouseMove);
                document.addEventListener('mouseup', handleMouseUp);
                let isMousePressed = false;
                var timeoutId;

                function handleTouchStart(event) {
                    event.preventDefault();
                    centerX = compass.offsetWidth / 2;
                    centerY = compass.offsetHeight / 2;
                    isMousePressed = true;
                    const touchX = event.clientX - compass.getBoundingClientRect().left - centerX;
                    const touchY = event.clientY - compass.getBoundingClientRect().top - centerY;

                    const distance = Math.sqrt(touchX * touchX + touchY * touchY);
                    const maxDistance = compass.offsetWidth / 2;
                    const ratio = Math.min(maxDistance / distance, 1);

                    executeFunction(touchX * ratio, touchY * ratio);
                }

                function handleMouseMove(event) {
                    if (event.buttons !== 1) return;
                    event.preventDefault();
                    const touchX = event.clientX - compass.getBoundingClientRect().left - centerX;
                    const touchY = event.clientY - compass.getBoundingClientRect().top - centerY;

                    const distance = Math.sqrt(touchX * touchX + touchY * touchY);
                    const maxDistance = compass.offsetWidth / 2;
                    const ratio = Math.min(maxDistance / distance, 1);

                    executeFunction(touchX * ratio, touchY * ratio);
                }

                function handleMouseUp(event) {
                    event.preventDefault();
                    isMousePressed = false;
                    clearTimeout(timeoutId);
                }

                function executeFunction(x, y) {
                    if (!isMousePressed) return;
                    console.log('Function executed with coordinates:', x, y);
                    mapa.panBy([x, y], { animate: true });
                    var timeoutId = setTimeout(executeFunction, 100, x, y);
                }
            </script>
        </div>
        <?php
        // require_once "_function_database.php";
        // $conn = conenect_to_database_kameny();
        // $domy = get_all_house_editor($conn);
        // echo $domy;
        // $domy = json_decode($domy, true);
        // foreach ($domy as $dum) {
        //     print_r($dum);
        //     $id = $dum["id"];
        //     $ulice = $dum["ulice"];
        //     $stare = $dum["stare_cislo"];
        //     $cislo_domu = $dum["cislo_domu"];
        //     $mesto = $dum["mesto"];
        //     $text = "<div>$id - $stare - Nová adresa: $ulice $cislo_domu</div>";
        //     echo $text;
        // }
        // print_r($domy);
        // disconenect_to_database($conn);
        ?>
        <div>$id - $stare - Nová adresa: $ulice $cislo_domu</div>
    </div>


</body>

</html>