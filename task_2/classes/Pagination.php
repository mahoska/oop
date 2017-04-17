<?php

class Pagination
{
    public $buttons = array();

    public function __construct(Array $options )
    {
        extract($options);
        
        if (!$currentPage) {
            return;
        }

        $pagesCount = ceil($itemsCount / $itemsPerPage);

        if ($pagesCount == 1) {
            return;
        }

        if ($currentPage > $pagesCount) {
            $currentPage = $pagesCount;
        }

        $this->buttons[] = new Button($currentPage - 1, $currentPage > 1, 'Previous');

        for ($i = 1; $i <= $pagesCount; $i++) {
            $active = $currentPage != $i;
            $this->buttons[] = new Button($i, $active);
        }

        $this->buttons[] = new Button($currentPage + 1, $currentPage < $pagesCount, 'Next');
    }
}

