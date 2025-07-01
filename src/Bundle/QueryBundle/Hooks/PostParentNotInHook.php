<?php

namespace Bundle\QueryBundle\Hooks;

use Swoop\Bundle\HookBundle\Model\AbstractFilter;

class PostParentNotInHook extends AbstractFilter
{
    const QUERY_ARGUMENT = 'post_parent__not_in';

    public function getFunction(...$args)
    {
        $where = $args[0];
        $query = $args[1];

        if (isset($query->query[self::QUERY_ARGUMENT]) && is_array($query->query[self::QUERY_ARGUMENT])) {
            global $wpdb;
            $parentIds = array_map('intval', $query->query[self::QUERY_ARGUMENT]);
            if (!empty($parentIds)) {
                $where = sprintf("%s AND %s.post_parent NOT IN (%s)",
                    $where,
                    $wpdb->posts,
                    implode(',', $parentIds)
                );
            }
        }
        return $where;
    }
}