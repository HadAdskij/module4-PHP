<div id="pageContent">
    <?php
        foreach ($data['categories'] as $item)
        {
            echo "<div class=\"panel panel-info\"><div class=panel-heading><h3 class=panel-title><a href='index/search/@"
                . $item['category'] . "@@@@'</a>" . $item['category'] . "</h3> </div> <div class=panel-body>";
            foreach ($data[$item['category']] as $ii)
                echo "<a href='index/article/" . $ii['id'] . "'>" . $ii['title'] . "</a><br>";
            echo "</div> </div>";
        }
        echo "<div class=\"panel panel-info\"><div class=panel-heading><h3 class=panel-title><a href='index/search/@@@@@1'</a>Аналітика</h3> </div> <div class=panel-body>";
        foreach ($data['analitic'] as $ii)
            echo "<a href='index/article/" . $ii['id'] . "'>" . $ii['title'] . "</a><br>";
    echo "</div> </div>";
    ?>
</div>
<script src="js\ad.js"></script>
<script src="js\date.js"></script>