<?php

namespace Swoop\Bundle\QueryBundle\Hooks;

use Swoop\Bundle\HookBundle\Model\AbstractFilter;

class PostHasExcerptHook extends AbstractFilter
{
    const QUERY_ARGUMENT = 'has_excerpt';

    public function getFunction(...$args)
    {
        $where = $args[0];
        $query = $args[1];

        if (isset($query->query[self::QUERY_ARGUMENT])) {
            global $wpdb;
            $hasExcerpt = $query->query[self::QUERY_ARGUMENT];

            if ($hasExcerpt === true || $hasExcerpt === 'true' || $hasExcerpt === '1') {
                // Posts that have excerpt
                $where = sprintf("%s AND %s.post_excerpt != ''", $where, $wpdb->posts);
            } else {
                // Posts that don't have excerpt
                $where = sprintf("%s AND (%s.post_excerpt = '' OR %s.post_excerpt IS NULL)",
                    $where, $wpdb->posts, $wpdb->posts);
            }
        }
        return $where;
    }
}
