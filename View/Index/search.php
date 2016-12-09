<div id="pageContent">
<?php
foreach ($data['articles'] as $item)
{
    echo "<div class=\"panel panel-info\"><div class=panel-heading><h3 class=panel-title><a href='index/article/"
        . $item['id'] . "'>" . $item['title'] . "</a></h3> </div> <div class=panel-body>";
    echo mb_substr($item['content'], 0, 500) . "...";
    echo "</div> </div>";
}
if (!$data['articles'])
    echo "За вашим запитом не знайдено жодної статті. Спробуйте змінити свій запит!";
$param = "@" . $data['parameters'][1]. "@" . $data['parameters'][2] . "@" . $data['parameters'][3]
    . "@" . $data['parameters'][4] . "@" . $data['parameters'][5];
?>
    <div class="pagClass">
        <ul class="pagination">
            <li>
                <a href="<?php echo "index/search/";
                    if($data['parameters'][0] > 4)
                        echo $data['parameters'][0] - 5;
                    echo $param;?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li><a href="<?php echo "index/search/" . $param;?>">1</a></li>
            <li id="anotherPages"><a>...</a>
            <div id="additionalPages">
                <?php
                for ($i = 0; $i < $data['number']; $i += 5){
                    echo "<a href=\"index/search/". $i . $param . "\"> " . (int)($i / 5 + 1) . " </a>";
                }
                ?>
            </div>
            </li>
            <li><a href="<?php echo "index/search/";
                echo $data['number'] - $data['number'] % 5 . $param . "\">" . (int)($data['number'] / 5 + 1); ?></a></li>
            <li>
                <a href="<?php echo "index/search/";
                if($data['parameters'][0] < $data['number'] - 5)
                    echo $data['parameters'][0] + 5;
                echo $param;?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<script src="js\ad.js"></script>
<script src="js\date.js"></script>
