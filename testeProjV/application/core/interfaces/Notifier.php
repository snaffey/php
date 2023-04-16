<?php


interface Notifier{
    public function atach(Observer $observer);
    public function detach(Observer $observer);
    public function notify();
}