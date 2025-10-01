<?php

namespace Swoop\Bundle\QueryBundle\Hooks;

use Swoop\Bundle\HookBundle\Model\AbstractFilter;

class PostNameLikeHook extends AbstractFilter
{
    const QUERY_ARGUMENT = 'post_name_like';

    /**
     * @inheritDoc
     */
    public function getFunction(...$args)
    {
        $where = $args[0];
        $query = $args[1];
        if (isset($query->query[self::QUERY_ARGUMENT])) {
            global $wpdb;
            $namesLike = $query->query[self::QUERY_ARGUMENT];
            if (!is_array($namesLike)) {
                $namesLike = [$namesLike];
            }
            $like = '';
            foreach ($namesLike as $k => $value) {
                $escapedValue = esc_sql($value);
                if ($k === 0) {
                    $like = sprintf("%s.post_name LIKE '%%%s%%'", $wpdb->posts, $escapedValue);
                } else {
                    $like = sprintf("%s OR %s.post_name LIKE '%%%s%%'", $like, $wpdb->posts, $escapedValue);
                }
            }
            if ($like) {
                $where = sprintf("%s AND (%s)", $where, $like);
            }
        }
        return $where;
    }
}
