<?php
/** 
 * при каждом показе позиции запоминается её идентификатор.
 * по завершении работы скрипта обновляются счетчики показа каждой позиции
 * - одним обращением из PHP к базе, независимо от числа позицийна странице
*/
class Counter {
    public static $listId = array();

    protected static $_instance;
    private function __construct()
    {
        Yii::app()->onEndRequest = array('Counter', 'updateCounter');
    }
    public static function getInstance($id = 0)
    {
        if(empty(self::$_instance)) {
            self::$_instance = new self();
        }
        if(0 < $id) {
            self::$listId[] = $id;
        }
        return self::$_instance;
    }
    static public function updateCounter($event)
    {
        $connection = Yii::app()->db;
        $sql = '';
        foreach(self::$listId as $id) {
            $sql .= 'UPDATE `banner_show` SET `show`=`show`+1 WHERE `id`=' . $id . '; ';
        }
        $connection->createCommand($sql)->execute();
    }
}