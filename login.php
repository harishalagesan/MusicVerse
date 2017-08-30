<?php
        $title="Musicverse";
        require_once  "main/starter/page_start.php";

        require_once "main/starter/header.php";


?>

<!--Script to initiate Slider on screen-->

    <script type="text/javascript">
        jQuery(document).ready(function ($) {

            var jssor_1_options = {
                $AutoPlay: true,
                $SlideDuration: 1200,
                $SlideEasing: $Jease$.$OutQuint,
                $ArrowNavigatorOptions: {
                    $Class: $JssorArrowNavigator$
                },
                $BulletNavigatorOptions: {
                    $Class: $JssorBulletNavigator$
                }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

//            responsive code for slider scaling during widow resize operations

            function ScaleSlider() {
                    var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                    if (refSize) {
                        refSize = Math.min(refSize, 1920);
                        jssor_1_slider.$ScaleWidth(refSize);
                    }
                    else {
                        window.setTimeout(ScaleSlider, 30);
                    }
            }
            ScaleSlider();
            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
            //End of responsive code
        });

        $(document).ready(function(){
            $('.carousel').carousel();
        });



    </script>


<!-- Start of Slider-->

    <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:1500px;height:450px;overflow:hidden;visibility:hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" class="jssorl-oval" style="position:absolute;top:0px;left:0px;text-align:center;background-color:rgba(0,0,0,0.7);">
            <img style="margin-top:-19.0px;position:relative;top:50%;width:38px;height:38px;" src="main/images/oval.svg" />
        </div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1500px;height:600px;overflow:hidden;">
            <div>
                <img data-u="image" src="main/images/maiden.jpg" />
            </div>
            <div>
                <img data-u="image" src="main/images/metallica.jpg" />

            </div>
            <div>
                <img data-u="image" src="main/images/beatels.jpeg" />

            </div>
            <div>
                <img data-u="image" src="main/images/dream.jpg" />

            </div>
            <a data-u="any" href="http://www.jssor.com" style="display:none">Full Width Slider</a>
            <div>
                <img data-u="image" src="main/images/led.jpg" />

            </div>
        </div>

        <div data-u="navigator" class="jssorb05" style="bottom:16px;right:16px;" data-autocenter="1">
            <div data-u="prototype" style="width:16px;height:16px;"></div>
        </div>

        <span data-u="arrowleft" class="jssora22l" style="top:0px;left:8px;width:40px;height:58px;" data-autocenter="2"></span>
        <span data-u="arrowright" class="jssora22r" style="top:0px;right:8px;width:40px;height:58px;" data-autocenter="2"></span>
    </div>
    <br />

<!--    Images used for Slider-->
    <div class="carousel">
        <a class="carousel-item" href="<?php echo $_SERVER["PHP_SELF"];?>"><img src="main/images/blues.jpeg"></a>
        <a class="carousel-item" href="<?php echo $_SERVER["PHP_SELF"];?>"><img src="main/images/deathmetal.jpeg"></a>
        <a class="carousel-item" href="<?php echo $_SERVER["PHP_SELF"];?>"><img src="main/images/hiphop.jpeg"></a>
        <a class="carousel-item" href="<?php echo $_SERVER["PHP_SELF"];?>"><img src="main/images/jazz.png"></a>
        <a class="carousel-item" href="<?php echo $_SERVER["PHP_SELF"];?>"><img src="main/images/pop.jpeg"></a>
        <a class="carousel-item" href="<?php echo $_SERVER["PHP_SELF"];?>"><img src="main/images/rap.jpeg"></a>
        <a class="carousel-item" href="<?php echo $_SERVER["PHP_SELF"];?>"><img src="main/images/rock.jpeg"></a>
        <a class="carousel-item" href="<?php echo $_SERVER["PHP_SELF"];?>"><img src="main/images/trance.jpeg"></a>
    </div>


<!-- End of Slider -->

<?
  require_once "main/starter/footer.php";
  ?>