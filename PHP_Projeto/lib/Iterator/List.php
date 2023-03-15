<?php

include_once './lib/Iterator/MyInterface.php';

class ArticleIterator implements MyIterator
{
    private $position = 0;
    private $articles;
    private $count;

    public function __construct(array $articles)
    {
        $this->articles = $articles;
        $this->count = count($articles);
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function current()
    {
        if (!isset($this->articles[$this->position])) {
            throw new \OutOfBoundsException('Articles out of bounds');
        }
        return $this->articles[$this->position];
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        ++$this->position;
    }

    public function valid()
    {
        return $this->position < $this->count;
    }
}
