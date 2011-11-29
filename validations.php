<?php

include_once './utility/mysql.php';
include_once './tasks.php';

class validations
{
    public static function get_all($status = 0)
    {
        $ret = array();
        $res = mysql::queryf('SELECT * FROM validations WHERE status = %d', $status);

        while ( $r = mysql_fetch_object($res) )
        {
            $r->segments = unserialize($r->segments);
            $ret []= $r;
        }

        return $ret;
    }

    public static function get_validation($id)
    {
        $res = mysql::queryf('SELECT * FROM validations WHERE id = %d', $id);
        if ( $r = mysql_fetch_object($res) )
        {
            $r->segments = unserialize($r->segments);
            return $r;
        }
        return null;
    }

    public static function get_all_for_user($user_id, $status = 0)
    {
        $ret = array();
        $res = mysql::queryf('SELECT * FROM validations WHERE used_id = %d AND status = %d',
                             $user_id, $status);

        while ( $r = mysql_fetch_object($res) )
        {
            $r->segments = unserialize($r->segments);
            $ret []= $r;
        }

        return $ret;
    }

    public static function add_validation( $task_id, $user_id, $status = 0, $segments = array() )
    {
        return mysql::insertf('INSERT INTO validations VALUES( NULL, %d, %d, %d, "%s")',
                              $task_id, $user_id, $status, serialize($segments));

    }

    public static function update_validation( $task_id, $user_id, $status = 0, $segments = array() )
    {
        return mysql::execf('UPDATE validations SET status = %d, segments = "%s" '.
                            'WHERE user_id = %d AND task_id = %d',
                            $status, serialize($segments), $user_id, $task_id);
    }
}
