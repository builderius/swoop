<?php

namespace Swoop\Bundle\QueryBundle\Hooks;

use Swoop\Bundle\HookBundle\Model\AbstractFilter;

class PostTitleLikeHook extends AbstractFilter
{
    const QUERY_ARGUMENT = 'post_title_like';

    public function getFunction(...$args)
    {
        $where = $args[0];
        $query = $args[1];

        if (isset($query->query[self::QUERY_ARGUMENT])) {
            global $wpdb;
            $titlesLike = $query->query[self::QUERY_ARGUMENT];
            if (!is_array($titlesLike)) {
                $titlesLike = [$titlesLike];
            }

            $like = '';
            foreach ($titlesLike as $k => $value) {
                $escapedValue = esc_sql($value);
                if ($k === 0) {
                    $like = sprintf("%s.post_title LIKE '%s'", $wpdb->posts, $escapedValue);
                } else {
                    $like = sprintf("%s OR %s.post_title LIKE '%s'", $like, $wpdb->posts, $escapedValue);
                }
            }
            if ($like) {
                $where = sprintf("%s AND (%s)", $where, $like);
            }
        }
        return $where;
    }
}
