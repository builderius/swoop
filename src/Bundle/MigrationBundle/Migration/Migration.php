<?php

namespace Swoop\Bundle\MigrationBundle\Migration;

interface Migration
{
    /**
     * @param \wpdb $wpdb
     * @return void
     */
    public function up(\wpdb $wpdb);
}
