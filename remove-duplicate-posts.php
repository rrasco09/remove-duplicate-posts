<?php  
/*
Plugin Name: Remove Duplicate Posts Cron
Plugin URI: https://github.com/rrasco09/remove-duplicate-posts
Description: Schedules an hourly cron job which runs a MySQL query to remove duplicate posts
Author: Robert Rasco
Version: 1.0
Author URI: http://www.rrasco.com
*/

register_activation_hook( __FILE__, 'run_on_activate' );

function run_on_activate()
{
    // schedule the cron job to remove duplicate posts
    if( !wp_next_scheduled( 'remove_duplicate_posts' ) )
    {
        wp_schedule_event( time(), 'hourly', 'remove_duplicate_posts' );
    }

} // end run_on_activate()


// add an action hook for remove duplicate posts
add_action ('remove_duplicate_posts', 'remove_duplicate_posts_event' );

register_deactivation_hook( __FILE__, 'run_on_deactivate' );

function run_on_deactivate()
{
    wp_clear_scheduled_hook('remove_duplicate_posts');
} // end run_on_deactivate()


function remove_duplicate_posts_event() {
    
    global $wpdb;    
    
    $result = $wpdb->get_results( "
        DELETE a
            FROM ".$wpdb->prefix."_posts AS a
               INNER JOIN (
                  SELECT post_title, MIN( id ) AS min_id
                  FROM ".$wpdb->prefix."_posts
                  WHERE post_type = 'post'
                  AND post_status = 'publish'
                  GROUP BY post_title
                  HAVING COUNT( * ) > 1
               ) AS b ON b.post_title = a.post_title
            AND b.min_id <> a.id
            AND a.post_type = 'post'
            AND a.post_status = 'publish'
    ");
    
    return;
    
}


?>
