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

        // Create a subquery to calculate accurate word count
        $wordCountSql = "
            CASE 
                WHEN TRIM(REGEXP_REPLACE(%s.post_content, '<[^>]*>', '')) = '' THEN 0
                WHEN TRIM(REGEXP_REPLACE(%s.post_content, '<[^>]*>', '')) IS NULL THEN 0
                ELSE (
                    CHAR_LENGTH(TRIM(REGEXP_REPLACE(%s.post_content, '<[^>]*>', ''))) 
                    - CHAR_LENGTH(REPLACE(TRIM(REGEXP_REPLACE(%s.post_content, '<[^>]*>', '')), ' ', '')) 
                    + 1
                )
            END
        ";

        if (isset($query->query[self::QUERY_ARGUMENT_MIN])) {
            $minWords = \intval($query->query[self::QUERY_ARGUMENT_MIN]);
            if ($minWords > 0) {
                $conditions[] = \sprintf("($wordCountSql) >= %d", $wpdb->posts, $wpdb->posts, $wpdb->posts, $wpdb->posts, $minWords);
            }
        }
        if (isset($query->query[self::QUERY_ARGUMENT_MAX])) {
            $maxWords = \intval($query->query[self::QUERY_ARGUMENT_MAX]);
            if ($maxWords >= 0) {
                $conditions[] = \sprintf("($wordCountSql) <= %d", $wpdb->posts, $wpdb->posts, $wpdb->posts, $wpdb->posts, $maxWords);
            }
        }
        if (!empty($conditions)) {
            $where = \sprintf("%s AND (%s)", $where, \implode(' AND ', $conditions));
        }
        return $where;
    }
}
