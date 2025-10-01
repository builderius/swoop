<?php

namespace Swoop\Bundle\QueryBundle\Hooks;

use Swoop\Bundle\HookBundle\Model\AbstractFilter;

class PostHasFeaturedImageHook extends AbstractFilter
{
    const QUERY_ARGUMENT = 'has_featured_image';

    public function getFunction(...$args)
    {
        $where = $args[0];
        $query = $args[1];

        if (isset($query->query[self::QUERY_ARGUMENT])) {
            global $wpdb;
            $hasFeatured = $query->query[self::QUERY_ARGUMENT];

            if ($hasFeatured === true || $hasFeatured === 'true' || $hasFeatured === '1') {
                // Posts that have featured image (thumbnail meta exists and is not empty)
                $where = sprintf("%s AND EXISTS (
                    SELECT 1 FROM %s pm 
                    WHERE pm.post_id = %s.ID 
                    AND pm.meta_key = '_thumbnail_id' 
                    AND pm.meta_value != '' 
                    AND pm.meta_value != '0'
                )", $where, $wpdb->postmeta, $wpdb->posts);
            } else {
                // Posts that don't have featured image
                $where = sprintf("%s AND NOT EXISTS (
                    SELECT 1 FROM %s pm 
                    WHERE pm.post_id = %s.ID 
                    AND pm.meta_key = '_thumbnail_id' 
                    AND pm.meta_value != '' 
                    AND pm.meta_value != '0'
                )", $where, $wpdb->postmeta, $wpdb->posts);
            }
        }
        return $where;
    }
}
