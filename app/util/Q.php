<?php


namespace app\util;

use think\facade\Db;

/**
 * Class Q 数据库联合查询工具
 * @package app\util
 */
class Q
{
    public static function select(string $tables, string $wheres = '', string $fields = '', int $page = 1, int $num = 0, string $order = '', int $limit = 0)
    {
        $query = Db::table($tables);
        if ($wheres) {
            $query = $query->whereRaw($wheres);
        }
        if ($fields) {
            $query = $query->field($fields);
        }
        if ($num and $page) {
            $query = $query->page($page, $num);
        }
        if ($order) {
            $query = $query->orderRaw($order);
        }
        if ($limit) {
            $query = $query->limit($limit);
        }
        return $query->select();
    }

    public static function count(string $tables, string $wheres = '')
    {
        $query = Db::table($tables);
        if ($wheres) {
            $query = $query->whereRaw($wheres);
        }
        return $query->count();
    }

    public static function find(string $tables, string $wheres = '', string $fields = '')
    {
        return self::select($tables, $wheres, $fields, 0, 0, '', 1);
    }

}