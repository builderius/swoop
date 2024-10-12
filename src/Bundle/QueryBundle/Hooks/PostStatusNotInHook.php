<?php

namespace Swoop\Bundle\QueryBundle\Hooks;

use Swoop\Bundle\HookBundle\Model\AbstractFilter;

class PostStatusNotInHook extends AbstractFilter
{
    const QUERY_ARGUMENT = 'post_status__not_in';

    /**
     * @inheritDoc
     */
    public function getFunction(...$args)
    {
        $where = $args[0];
        $query = $args[1];
        if (isset($query->query[self::QUERY_ARGUMENT]) && is_array($query->query[self::QUERY_ARGUMENT])) {
            global $wpdb;
            $statuses = $query->query[self::QUERY_ARGUMENT];
            if (!empty($statuses)) {
                $where = sprintf(
                    "%s AND %s.post_status NOT IN ('%s')",
                    $where,
                    $wpdb->posts,
                    implode("','", $statuses)
                );
            }
        }
        return $where;
    }
}
