<?php

namespace Bundle\QueryBundle\Hooks;

use Swoop\Bundle\HookBundle\Model\AbstractFilter;

class PostIdGreaterThanHook extends AbstractFilter
{
    const QUERY_ARGUMENT = 'post_id_greater_than';

    public function getFunction(...$args)
    {
        $where = $args[0];
        $query = $args[1];

        if (isset($query->query[self::QUERY_ARGUMENT])) {
            global $wpdb;
            $id = intval($query->query[self::QUERY_ARGUMENT]);
            $where = sprintf("%s AND %s.ID > %d", $where, $wpdb->posts, $id);
        }
        return $where;
    }
}
