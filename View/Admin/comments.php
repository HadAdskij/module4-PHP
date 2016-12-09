<div id="pageContent">
    <form method="post">
    <?php
    foreach ($data['comments'] as $i) {
        echo "
        <div class=\"panel panel-default\">
            <div class=\"panel-heading\">
                <h3 class=\"panel-title\">" . $i['author'] . "</h3>
                <span class='commentForArticle'> Коментар до статті №"
                    . $i['articleID'] .
                "</span>
                <label class='checkButtons'>Додати: <input name='checkboxesAllow[]' value='" . $i['id'] . "' type='checkbox'></label>
                <label class='checkButtons'>Видалити: <input name='checkboxesDelete[]' value='" . $i['id'] . "' type='checkbox'></label>
            </div>
            <div class=\"panel-body\">"
            .$i['content']
            . "</div>
        </div>";
    }

    echo "<div class='forButton'><button type='submit' name='moderateSubmit' class='btn btn-success' >Підтвердити</button></div>";
    ?>
    </form>
</div>
<script src="js\comments.js"></script>
<script src="js\ad.js"></script>
<script src="js\date.js"></script>