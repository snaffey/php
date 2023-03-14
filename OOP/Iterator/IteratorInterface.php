<?php

interface IteratorInterface {

    public function first();

    public function next();

    public function isDone();

    public function currentItem();
}
