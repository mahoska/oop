<div id="lcolumn">
       <div id="serch">   
        <a  href='index.php?page=books'>Показать все</a><br><br>
        <form   action="index.php" >
            <input type="hidden" name="page" value="books"/>
            <b>Поиск по названию:</b><br>
            <input type="text"  name ="search_book_name" size='35'>
        </form><br>
        <form   action="index.php" >
            <input type="hidden" name="page" value="books"/>
            <b>Поиск по автору:</b><br>
            <?php select_key($all_authors, 'author_id', $author_id?true:false, $author_id?$author_id:"выберите автора книги");?>
            <input type="submit"  value="Искать">
        </form><br>
        <form   action="index.php" >
            <input type="hidden" name="page" value="books"/>
            <b>Поиск по жанру:</b><br>
            <?php select_key($all_styles, 'style_id', $style_id?true:false, $style_id?$style_id:"выберите жанр книги");?>
            <input type="submit"  value="Искать">
        </form>
        </div>
</div>
