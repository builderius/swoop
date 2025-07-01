<?php

namespace Swoop\Bundle\QueryBundle\Hooks;

use Swoop\Bundle\HookBundle\Model\AbstractFilter;

class PostWordCountRangeHook extends AbstractFilter
{
    const QUERY_ARGUMENT_MIN = 'word_count_min';
    const QUERY_ARGUMENT_MAX = 'word_count_max';

    public function getFunction(...$args)
    {
        $where = $args[0];
        $query = $args[1];

        global $wpdb;
        $conditions = [];

        if (isset($query->query[self::QUERY_ARGUMENT_MIN])) {
            $minWords = intval($query->query[self::QUERY_ARGUMENT_MIN]);
            $conditions[] = sprintf("(CHAR_LENGTH(%s.post_content) - CHAR_LENGTH(REPLACE(REPLACE(REPLACE(%s.post_content, ' ', ''), '\t', ''), '\n', '')) + 1) >= %d",
                $wpdb->posts, $wpdb->posts, $minWords);
        }

        if (isset($query->query[self::QUERY_ARGUMENT_MAX])) {
            $maxWords = intval($query->query[self::QUERY_ARGUMENT_MAX]);
            $conditions[] = sprintf("(CHAR_LENGTH(%s.post_content) - CHAR_LENGTH(REPLACE(REPLACE(REPLACE(%s.post_content, ' ', ''), '\t', ''), '\n', '')) + 1) <= %d",
                $wpdb->posts, $wpdb->posts, $maxWords);
        }

        if (!empty($conditions)) {
            $where = sprintf("%s AND (%s)", $where, implode(' AND ', $conditions));
        }

        return $where;
    }
}
