<div id="pageContent" style="text-align: center">
    <h2>Виберіть колір і натисніть кнопку "Змінити"</h2>
        <div id="color-picker" class="cp-default">
            <div class="picker-wrapper">
                <div id="picker1" class="picker"></div>
                <div id="picker-indicator" class="picker-indicator"></div>
            </div>
            <div class="slide-wrapper">
                <div id="slide1" class="slide"></div>
                <div id="slide-indicator" class="slide-indicator"></div>
            </div>
            <form method="post">
                <button id="colorButton" class="btn btn-info" type="submit" name="colorSubmit" value="#faffbd">Змінити</button>
            </form>
        </div>
    </div>



<script src="js\ad.js"></script>
<script src="js\date.js"></script>
<script type="text/javascript" src="js/colorpicker.min.js"></script>
<script type="text/javascript">
    cp = ColorPicker(document.getElementById('slide1'), document.getElementById('picker1'),
        function(hex, hsv, rgb, mousePicker, mouseSlide) {
            currentColor = hex;
            ColorPicker.positionIndicators(
                document.getElementById('slide-indicator'),
                document.getElementById('picker-indicator'),
                mouseSlide, mousePicker
            );
            <?php
                if ($data['header'])
                    echo "document.getElementById('navcol').style.background = \"linear-gradient(to bottom, black, \" + hex + \")\";";
                else
                    echo "document.body.style.background = \"linear-gradient(to top, white, \" + hex + \")\";";
            ?>

            document.getElementById('colorButton').value = hex;
        });
</script>


