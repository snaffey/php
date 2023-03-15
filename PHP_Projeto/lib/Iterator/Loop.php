<?php

include_once './lib/Iterator/List.php';

class Loop
{
    protected $it;
    public function loopList()
    {
        $this->it = new ArticleIterator($this->it);
        $this->it->first();
        while (!$this->it->isDone()) {
            $this->operation($this->it->currentItem());
            $this->it->next();
        }
    }
    protected function operation($loop)
    {
        echo '<article>';
        echo '<img src="'.$loop['Img'].'" alt="'.$loop['AltImg'].'">'; // show image from database
        echo '<h2>'.$loop['Nome'].'</h2>';
        echo '<h2 class="desc" >'.$loop['Descrição'].'</h2>'; // show description from database
        echo '<a href="ver.php?id='.$loop['ID'].'" class="btn">More Info</a>'; // show more info from database
        echo '</article>';
    }
}
