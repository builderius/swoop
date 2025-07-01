<?php

namespace Bundle\QueryBundle\Hooks;

use Swoop\Bundle\HookBundle\Model\AbstractFilter;

class PostContentLikeHook extends AbstractFilter
{
    const QUERY_ARGUMENT = 'post_content_like';

    public function getFunction(...$args)
    {
        $where = $args[0];
        $query = $args[1];

        if (isset($query->query[self::QUERY_ARGUMENT])) {
            global $wpdb;
            $contentLike = $query->query[self::QUERY_ARGUMENT];
            if (!is_array($contentLike)) {
                $contentLike = [$contentLike];
            }

            $like = '';
            foreach ($contentLike as $k => $value) {
                $escapedValue = esc_sql($value);
                if ($k === 0) {
                    $like = sprintf("%s.post_content LIKE '%%%s%%'", $wpdb->posts, $escapedValue);
                } else {
                    $like = sprintf("%s OR %s.post_content LIKE '%%%s%%'", $like, $wpdb->posts, $escapedValue);
                }
            }
            if ($like) {
                $where = sprintf("%s AND (%s)", $where, $like);
            }
        }
        return $where;
    }
}
