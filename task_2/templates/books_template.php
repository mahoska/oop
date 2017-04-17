<?php include "book_search_template.php"; ?>
<div id="rcolumn">
    <h1>Books</h1>
    <form action="index.php">
        <input type="hidden" name="page" value="books"/>
        Sort all books by: 
        <select name='sort'>
            <?php foreach($sortAllField as $fild):?>
                <option value="<?=$fild?>" <?=($fild == $sortField)?"selected":""?>><?=$fild?></option>
            <?php endforeach; ?>
        </select>

        Order: 
        <select name='order'>
            <?php foreach($sortAllOrder as $order):?>
                <option value="<?=$order?>" <?=($order == $sortOrder)?"selected":""?>><?=$order?></option>
            <?php endforeach; ?>
        </select>

        <button>Go</button>
    </form>

    <?php 
    if(!empty($books)):?>
        <table>
        <?php 
            $i = 0;
            foreach($books as $book_item):
                if ($i % 4 == 0 || $i == 0)echo"<tr>";
        ?>            
                <td>
                    <div class="book style_border">
                        <h3 class="title"><?=$book_item['title']?></h3> 
                        <hr>
                        <p class="authors">
                            <?php foreach ($book_item['authors'] as $id=>$name):?>
                            <a href="index.php?page=books&amp;author_id=<?=$id?>"> <?=$name?></a><br>
                            <?php endforeach;?>
                        </p>
                        <div class="price">Цена: <?=$book_item['price']?> грн</div>
                        <br>
                        <a href="index.php?page=book_item&amp;id=<?=$book_item['id']?>">Подробнее...</a>

                    </div>
                </td>
        <?php        
                $i++;
                if ($i % 4 == 0) echo"</tr>"; 
            endforeach;
        ?>
        </table>
        <?php else:?> 
            <br>
            <strong>по указанному критерию книг не найдено</strong>
        <?php endif;?>
            
        <?php foreach ($p->buttons as $button) :
        if ($button->isActive) : ?>
            <a href = '?page=books&amp;&amp;sort=<?=$sortField?>&amp;order=<?=$sortOrder?>&amp;search_book_name=<?=$serch_book_name?>&amp;&amp;author_id=<?=$author_id?>&amp;style_id=<?=$style_id?>&amp;page_number=<?=$button->page?>'><?=$button->text?></a>
        <?php else : ?>
            <span style="color:#555555"><?=$button->text?></span>
        <?php endif;
    endforeach; ?>    
    </div> 


