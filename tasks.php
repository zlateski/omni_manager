<?php

include_once './utility/mysql.php';

class tasks
{
    public static function get_all($status = 0)
    {
        $ret = array();
        $res = mysql::queryf('SELECT * FROM tasks WHERE status = %d', $status);

        while ( $r = mysql_fetch_object($res) )
        {
            $r->seeds = unserialize($r->seeds);
            $r->entry = unserialize($r->entry);
            $ret []= $r;
        }

        return $ret;
    }

    public static function get_task($id)
    {
        $res = mysql::queryf('SELECT * FROM tasks WHERE id = %d', $id);
        if ( $r = mysql_fetch_object($res) )
        {
            $r->seeds = unserialize($r->seeds);
            $r->entry = unserialize($r->entry);
            return $r;
        }
        return null;
    }

    public static function add_task( $volume_id, $seeds, $entry, $parent = 0, $status = 0 )
    {
        return mysql::insertf('INSERT INTO tasks VALUES( NULL, %d, %d, "%s", "%s", %d)',
                              $parent, $volume_id, serialize($seeds),
                              serialize($entry), $status);

    }
}
