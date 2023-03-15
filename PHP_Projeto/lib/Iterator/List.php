<?php

include_once './lib/Iterator/MyInterface.php';

class ArticleIterator implements IteratorInterface
{
    private $position = 0;
    private $articles;

    public function __construct(array $articles)
    {
        $this->articles = $articles;
    }

    public function first()
    {
        if (!is_array($this->articles)) {
            throw new \InvalidArgumentException('Articles should be an array');
        }
        $this->position = 0;
    }

    public function currentItem()
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

    public function isDone()
    {
        return isset($this->articles[$this->position]) === false;
    }
}
