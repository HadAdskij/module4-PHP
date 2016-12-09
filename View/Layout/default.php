<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo SITE_NAME ?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>
    <script src="YourJquery source path"></script>
    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <link rel="stylesheet" href="http://getbootstrap.com/examples/starter-template/starter-template.css"/>
    <link rel="stylesheet" href="https://bootswatch.com/united/bootstrap.css"/>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="View\styles.css">
    <link rel="stylesheet" href="..\..\View\styles.css">
    <link rel="stylesheet" href="..\View\styles.css">
    <base href="/module4/">
</head>
<body>
<nav id="navcol" class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><b>My News</b></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse ">
            <form class="navbar-form navbar-left">
                <input id="searchTag" type="text" class="form-control" placeholder="Search...">
            </form>
        <?php
            if(!(isset($_SESSION['user']) && $_SESSION['user']))
                echo "
                    
                        <form class=\"navbar-form navbar-right\" method='post'>
                            <div class=\"form-group\">
                                <input name='login' type=\"text\" placeholder=\"Login\" class=\"form-control\">
                            </div>
                            <div class=\"form-group\">
                                <input name='pass' type=\"password\" placeholder=\"Password\" class=\"form-control\">
                            </div>
                            <button type=\"submit\" class=\"btn btn-success\">Ввійти</button>
                            <a href='User/registerForm'><button type='button' class=\"btn btn-success\">Зареєструватися</button></a> 
                        </form>
                    </div><!--/.navbar-collapse -->
                    ";
            else {
                echo "
                        <form class=\"navbar-form navbar-right\" method='post'>
                            <div class=\"form-group\">
                            <div class='hello'>Hello, "
                    . $_SESSION['user']
                    . "</div>";
                if (isset($_SESSION['admin'])) {
                    echo "
                                <div id='adminButton' class=\"btn-group\">
                                  <button type=\"button\" class=\"btn btn-success\"'><a style='color: white' href='admin/addArticle'>Додати новину</a> </button>
                                  <button type=\"button\" class=\"btn btn-success dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                                    <span class=\"caret\"></span>
                                    <span class=\"sr-only\">Toggle Dropdown</span>
                                  </button>
                                  <ul class=\"dropdown-menu\">";
                    if (isset($data['article']['id']))
                        echo "<li><a href=\"admin/addArticle/" . $data['article']['id'] . "\">Змінити дану статтю</a></li>";
                    echo "          <li><a href=\"admin/addCategory\">Додати категорію</a></li>
                                    <li><a href=\"admin/moderate\">Коментарі для підтвердження</a></li>
                                    <li><a href=\"admin/addAdvert\">Додати рекламу</a></li>
                                    <li role=\"separator\" class=\"divider\"></li>
                                    <li id='showH'><a  class='showHidden' href=\"admin/changeColor\">Змінити дизайн >></a>
                                    <ul id='hidden'>
                                        <li><a href='admin/changeColor'>Змінити колір тла</a></li>
                                        <li><a href='admin/changeColor/1'>Змінити колір хеадера</a></li>
                                    </ul></li>
                                    
                                  </ul>
                                </div>";
                }
                echo "<button name='logout' class=\"btn btn-success\">Вийти</button>
                        </form>
                    </div>";
            }
        ?>
    </div>
    <div class="searchPanel row">
        <div class="col-sm-2">
        </div>
        <form>
            <label>Дата публікації:</label><label><input id="fromDate" class="form-control" placeholder="з" name="from" type="datetime" onfocus="this.select();_Calendar.lcs(this)"
                          onclick="event.cancelBubble=true;this.select();_Calendar.lcs(this)"></label>
            <label><input id="toDate" class="form-control" placeholder="по" name="to" type="datetime" onfocus="this.select();_Calendar.lcs(this)"
                          onclick="event.cancelBubble=true;this.select();_Calendar.lcs(this)"></label>
            <label><select id="categorySelect" class="form-control" name="category"><option value=""></option>
                <?php
                    foreach ($data['categories'] as $i) {
                        echo "<option value=\"" . $i['category'] . "\">" . $i['category'] . "</option>";
                    }
                ?>
            </select></label>
            <button id="startSearch" type="button" class="btn btn-info">Шукати...</button>
        </form>
    </div>
</nav>
<!-- template data -->
<div class="container">

    <div class="starter-template">
        <?php if($message) { ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $message ?>
        </div>
        <?php } ?>

    </div>
    <div class="row">
        <div class="col-sm-2">
            <h4>Останні новини:</h4>
            <?php
            foreach ($data['sidebar'] as $i){
                echo "
            <div class=\"thumbnail\">
             <a href='index/article/" . $i['id'] . "'>
                <img src=\"".$i['image']."\">
                <div class=\"caption\">
                    <p>".$i['title']."</p>
                </div>
                </a>
            </div>";}

            for($j = 0; $j < 4; $j++){
                $i = $data['advert'][$j];
                echo "
            <div class=\"thumbnail\">
             <a href='" . $i['seller'] . "'>
                <img src=\"".$i['image']."\" class='th-il'>
                <div class=\"caption\">
                    <p>".$i['goods']."</p>
                    <span class = \"price\">". $i['price']." </span>грн
                    <div class='cupon'>
                        Купон на скидку -" . $data['random'] . "– примените и получите скидку 10%
                    </div>
                </div>
                </a>
            </div>";}
            ?>
        </div>
        <div class="col-sm-8">
            <?php echo $content; ?>
        </div>
        <div class="col-sm-2">
            <h4>Резонансні статті:</h4>
            <?php
            foreach ($data['sidebarLeft'] as $i){
                echo "
            <div class=\"thumbnail\">
             <a href='index/article/" . $i['id'] . "'>
                <img src=\"".$i['image']."\">
                <div class=\"caption\">
                    <p>".$i['title']."</p>
                </div>
                </a>
            </div>";}

            for($j = 4; $j < 8; $j++){
                $i = $data['advert'][$j];
                echo "
            <div class=\"thumbnail\">
             <a href='" . $i['seller'] . "' >
                <img src=\"".$i['image']."\" class='th-il'>
                <div class=\"caption\">
                    <p>".$i['goods']."</p>
                    <span class = \"price\">". $i['price']." </span>грн
                    <div class='cupon'>
                        Купон на скидку -" . $data['random'] . "– примените и получите скидку 10%
                    </div>
                </div>
                </a>
            </div>";}
            ?>

        </div>
    </div>

</div>
<?php
    if (!isset($_SESSION['user']))
        echo "<div class=\"subscribe\">
            <button id='closeSubscribe' type='button'>x</button>
            <a href=\"User/registerForm\">Для отримання всіх переваг користування сайтом, будь ласка, зареєструйтеся чи авторизуйтеся<br>Ok<br></a>
</div>";
?>

<div class="mastfoot">
    <div class="inner">
        <p>Test project for <a href="http://php-academy.kiev.ua/">PHP-Academy</a>, by <a href="https://vk.com/tytarenko">atytaren</a>.</p>
    </div>
</div>

</body>
</html>