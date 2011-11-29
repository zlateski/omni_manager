<?php

include_once './utility/mysql.php';

class volumes
{
    public static function get_all($status = 0)
    {
        $ret = array();
        $res = mysql::queryf('SELECT * FROM volumes WHERE status = %d', $status);

        while ( $r = mysql_fetch_object($res) )
        {
            $ret []= $r;
        }

        return $ret;
    }

    public static function get_volume($id)
    {
        $res = mysql::queryf('SELECT * FROM tasks WHERE id = %d', $id);
        if ( $r = mysql_fetch_object($res) )
        {
            return $r;
        }
        return null;
    }

    public static function add_volume($path, $status = 0)
    {
        return mysql::insertf('INSERT INTO volumes VALUES( NULL, "%s", %d)',
                              $path, $status);
    }

    public static function get_by_path($path)
    {
        $res = mysql::queryf('SELECT * FROM tasks WHERE path = "%s"', $path);
        if ( $r = mysql_fetch_object($res) )
        {
            return $r;
        }
        return null;
    }
}