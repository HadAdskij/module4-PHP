<div id="pageContent">
    <form method="post">
        <pre>
            <h2>Будь ласка, заповніть всі поля для додавання статті</h2>
            <label class="addArticleLabel">Заголовок*:                      <input value="<?php if(isset($data['modifyArticle'])) echo htmlspecialchars($data['modifyArticle']['title'], ENT_COMPAT);?>" required class='adminFormArticle' name="Atitle" type="text"></label>
            <label class="addArticleLabel">Головне зображення:              <input value="<?php if(isset($data['modifyArticle'])) echo htmlspecialchars($data['modifyArticle']['image'], ENT_COMPAT);?>" class='adminFormArticle' name="Aimage" type="text"></label>
            <label class="addArticleLabel">Додаткові зображення:            <input value="<?php if(isset($data['modifyArticle'])) echo htmlspecialchars($data['modifyArticle']['images'], ENT_COMPAT);?>" class='adminFormArticle' name="Aimages" type="text"></label>
            <label class="addArticleLabel">Джерело*:                        <input value="<?php if(isset($data['modifyArticle'])) echo htmlspecialchars($data['modifyArticle']['source'], ENT_COMPAT);?>" required class='adminFormArticle' name="Asource" type="text"></label>
            <label class="addArticleLabel">Теги(tag1#tag2#tag3)*:           <input value="<?php if(isset($data['modifyArticle'])) echo $data['modifyArticle']['tags'];?>" required class='adminFormArticle' name="Atags" type="text"></label>
            <label class="addArticleLabel">Текст статті*:                   <textarea required rows="10" name="Acontent"><?php if(isset($data['modifyArticle'])) echo $data['modifyArticle']['content'];?></textarea></label>
            <label class="addArticleLabel">Оберіть категорію*:              <select required class="form-control" name="Acategory">
                     <?php
                     foreach ($data['categories'] as $i) {
                         echo "<option value=\"" . $i['category'] . "\"";
                         if (isset($data['modifyArticle']) && $data['modifyArticle']['category'] == $i['category'])
                            echo " selected";
                         echo ">" . $i['category'] . "</option>";
                     }
                     ?>
                 </select>
            </label>
            <label class="addArticleLabel">Помітити стаття як "аналітика":  <input name="Aanalitics" type="checkbox"></label>
            <label class="addArticleLabel">Приховати статтю:                <input name="Ahide" type="checkbox"></label>
            <input name="Aid" type="hidden" value="<?php if(isset($data['modifyArticle'])) echo $data['modifyArticle']['id'];?>">
            <button id="addArticleButton" class="btn btn-info" type="submit" name="Asubmit">Додати</button>
        </pre>
    </form>
</div>
<script src="js\ad.js"></script>
<script src="js\date.js"></script>