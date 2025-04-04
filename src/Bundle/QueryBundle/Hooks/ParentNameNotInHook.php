<?php

namespace Swoop\Bundle\QueryBundle\Hooks;

use Swoop\Bundle\HookBundle\Model\AbstractFilter;

class ParentNameNotInHook extends AbstractFilter
{
    const QUERY_ARGUMENT = 'parent_name__not_in';

    /**
     * @inheritDoc
     */
    public function getFunction(...$args)
    {
        $where = $args[0];
        $query = $args[1];
        if (isset($query->query[self::QUERY_ARGUMENT]) && is_array($query->query[self::QUERY_ARGUMENT])) {
            global $wpdb;
            $names = array_filter(array_map(function ($name) use ($wpdb) {
                $sane = sanitize_title($name);
                return !empty($sane) ? $wpdb->prepare('%s', $sane) : null;
            }, $query->query[self::QUERY_ARGUMENT]));
            if (!empty($names)) {
                $where = sprintf(
                    "%s AND %s.post_name NOT IN ('%s')",
                    $where,
                    PostParentJoinHook::PARENT_TABLE,
                    implode("','", $names)
                );
            }
        }
        return $where;
    }
}
