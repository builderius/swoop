<?php

namespace Swoop\Bundle\QueryBundle\Hooks;

use Swoop\Bundle\HookBundle\Model\AbstractFilter;

class PostTitleHook extends AbstractFilter
{
    const QUERY_ARG_EXACT   = 'post_title';
    const QUERY_ARG_NOT_IN  = 'post_title__not_in';

    public function getFunction(...$args)
    {
        $where = $args[0];
        $query = $args[1];

        global $wpdb;

        // Exact title match
        if (isset($query->query[self::QUERY_ARG_EXACT])) {
            $title = sanitize_text_field($query->query[self::QUERY_ARG_EXACT]);
            if (!empty($title)) {
                $safeTitle = $wpdb->prepare('%s', $title);
                $where .= " AND {$wpdb->posts}.post_title = {$safeTitle}";
            }
        }

        // NOT IN titles
        if (isset($query->query[self::QUERY_ARG_NOT_IN]) && is_array($query->query[self::QUERY_ARG_NOT_IN])) {
            $titles = array_filter(array_map(function ($title) use ($wpdb) {
                $sane = sanitize_text_field($title);
                return !empty($sane) ? $wpdb->prepare('%s', $sane) : null;
            }, $query->query[self::QUERY_ARG_NOT_IN]));

            if (!empty($titles)) {
                // implode prepared values
                $where .= " AND {$wpdb->posts}.post_title NOT IN (" . implode(',', $titles) . ")";
            }
        }

        return $where;
    }
}
