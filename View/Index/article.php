<div id="pageContent">
    <?php
    echo "<div id = 'articleHead'><img src='" . $data['article']['image'] . "'>";
    echo "<h2>" . $data['article']['title'] . "</h2></div>";
    echo "<div id = 'article'>" . str_replace("\n", "<br>", $data['article']['content']) . "</div><br>";
    if ($data['article']['images'])
    {
        $images = explode("\n", $data['article']['images']);
        echo "<div id = 'images'>";
        foreach ($images as $i)
            echo "<img src='" . $i . "'><br>";
        echo "</div>";
    }
    if ($data['article']['tags'])
    {
        $tags = explode("#", $data['article']['tags']);
        echo "<br><div id = 'tags'>";
        foreach ($tags as $i)
            if ($i)
                echo "<a href='index/search/@@" . $i . "@@@'>#" . $i . "</a>";
        echo "</div>";
    }
    echo "<br><input id='article' type='hidden' value='" . $data['article']['id'] ."'></input><div id='readers'>Зараз на сторінці 0 відвідувачів<br>Всього сторінку відвідували 0 разів</div>";
    echo "<br><div id = 'source'><p>Джерело: " . $data['article']['source'] . "</p></div>";
    if (isset($_SESSION['user']) && $_SESSION['user'])
        echo "<form method='post'><div class=\"input-group\">
                
                    <input name='commentText' type=\"text\" class=\"form-control\" placeholder=\"Введіть ваш коментар...\">
                    <input name='answerto' type='hidden' value='0'>
                    <span class=\"input-group-btn\">
                    <button name=\"addComment\" class=\"btn btn-default\" type=\"submit\">Написати</button>
                </span>
                </div></form>
                <br>";
    foreach ($data['comments'] as $i)
    {
        if($i['moderated']) {
            echo "
                <div class=\"panel panel-success\">
                    <div class=\"panel-heading\">
                        <h3 class=\"panel-title\">" . $i['author'] . "</h3><span>" . $i['time']
                . " Рейтинг: " . $i['rate'] . "</span>";
            if (isset($_SESSION['user']))
                echo "<button class='answerCom' value='".$i['id']."'>Відповісти</button><button class='addRate'>+</button> 
                            <button value='" . $i['id'] . "' class='subRate'>-</button>";
            if ((time() - strtotime($i['time']) + 3600 < 120) || isset($_SESSION['admin']))
                echo "<button value='" . $i['id'] . "' class='modify'>M</button>";
            echo "
                    </div>
                    <div class=\"panel-body\">
                        " . $i['content'] . "
                        <form class='modifyForm mod".$i['id']."' method='post'>
                            <input name='modifiedText' type='text' class='form-control'>
                            <input name='id' type='hidden' value='".$i['id']."'>
                            <button name='modifySubmit' type='submit' class='btn btn-info'>Змінити</button>
                        </form>
                    </div>
                </div> 
                <form method='post' class='answerFor ans".$i['id']."'><div class=\"input-group\">
                
                    <input name='commentText' type=\"text\" class=\"form-control\" placeholder=\"Введіть вашу відповідь...\">
                    <input name='answerto' type='hidden' value='";
                echo $i['id'] . "'>
                    <span class=\"input-group-btn\">
                    <button name=\"addComment\" class=\"btn btn-default\" type=\"submit\">Відповісти</button>
                </span>
                </div></form>
             ";

            foreach ($i['subcomments'] as $ii) {
                if ($ii['moderated']) {
                    echo "
                <div class=\"panel panel-warning\">
                    <div class=\"panel-heading\">
                        <h3 class=\"panel-title\">" . $ii['author'] . "</h3><span>" . $ii['time']
                        . " Рейтинг: " . $ii['rate'] . "</span>";
            if (isset($_SESSION['user']))
                echo "<button value='" . $ii['id']
                        . "' class='addRate'>+</button> <button value='" . $ii['id']
                        . "' class='subRate'>-</button>";
                if ((time() - strtotime($ii['time']) + 3600 < 120) || isset($_SESSION['admin']))
                    echo "<button value='" . $ii['id'] . "' class='modify'>M</button>";
                echo "
                    </div>
                    <div class=\"panel-body\">
                        " . $ii['content'] . "
                        <form class='modifyForm mod".$ii['id']."' method='post'>
                            <input name='modifiedText' type='text' class='form-control'>
                            <input name='id' type='hidden' value='".$ii['id']."'>
                            <button name='modifySubmit' type='submit' class='btn btn-info'>Змінити</button>
                        </form>
                    </div>
                </div> 
             ";
            }
            }
        }
    }
    ?>
</div>
<script src="js\comments.js"></script>
<script src="js\ad.js"></script>
<script src="js\date.js"></script>