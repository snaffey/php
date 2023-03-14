<?php

class ArticleIterator implements Iterator
{
    private $position = 0;
    private $articles;

    public function __construct(array $articles)
    {
        $this->articles = $articles;
    }

    public function rewind()
    {
        if (!is_array($this->articles)) {
            throw new \InvalidArgumentException('Articles should be an array');
        }

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
        return isset($this->articles[$this->position]);
    }
}
