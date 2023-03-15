<?php

class Loop
{
    protected $it;

    public function loopList($articles)
    {
        $this->it = new ArticleIterator($articles);
        $this->it->rewind();
        while ($this->it->valid()) {
            try {
                $this->operation($this->it->current());
            } catch (Exception $e) {
                error_log('Error in loopList: ' . $e->getMessage());
                throw $e;
            }
            $this->it->next();
        }
    }

    public function loopDestaque($destaque)
    {
        $this->it = new ArticleIterator($destaque);
        $this->it->rewind();

        while ($this->it->valid()) {
            try {
                $this->operationDestaque($this->it->current());
            } catch (Exception $e) {
                error_log('Error in loopDestaque: ' . $e->getMessage());
                throw $e;
            }

            $this->it->next();
        }
    }


    protected function operation($article)
    {
        echo '<article>';
        echo '<img src="'.htmlentities($article['Img']).'" alt="'.htmlentities($article['AltImg']).'">'; // show image from database
        echo '<h2>'.htmlentities($article['Nome']).'</h2>';
        echo '<h2 class="desc" >'.htmlentities($article['Descrição']).'</h2>'; // show description from database
        echo '<a href="ver.php?id='.htmlentities($article['ID']).'" class="btn">More Info</a>'; // show more info from database
        echo '</article>';
    }

    protected function operationDestaque($destaque)
    {
        echo '<div>';
        echo '<a href="ver.php?id='.htmlentities($destaque['ID']).'">';
        echo '<img src="'.htmlentities($destaque['Img']).'" alt="'.htmlentities($destaque['AltImg']).'">';
        echo '</a>';
        echo '</div>';
    }
}
