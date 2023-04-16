<?php


/**
 * Class Messages
 * @author Rafael Velosa
 */
class Messages{

    /**
     * Guarda as msgs
     * @var array|string[][] $msgs
     */
    public static $lang;
    private static array | null $msgs = null;

    /**
     * Devolve uma msg se ouver
     * @param $get
     * @return mixed|string|null
     */
    public static function run($get){
        self::$lang = strtoupper($_COOKIE['lang'] ?? 'pt');
        include_once APPLICATIONPATH . '/libraries/messages_'.self::$lang.'.php';
        if (self::$msgs === null) return null;
        if(isset($get['error']))
            return [self::getMsg('error', $get['error']), 'error'];
        else if(isset($get['success']))
            return [self::getMsg('success', $get['success']), 'success'];
        return null;
    }

    /**
     * Devolve uma msg para uma respetiva ação
     * @param $name
     * @param $msg
     * @return mixed|string|null
     */
    private static function getMsg($name, $msg){
        if (isset(self::$msgs[$name][$msg]))
            return self::$msgs[$name][$msg];
        return null;
    }

    public static function setMessages($msgs){
        self::$msgs = $msgs;
    }
}