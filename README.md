# remove-duplicate-posts
This is a simple plugin for WordPress that removes duplicate posts hourly utilizing wp-cron.

#
# If you need to remove duplicate posts from WordPress this simple plugin will do just that.  
# Under ideal circumstances you should not have duplicate post entries but sometimes it is necessary.
# The FeedWordPress Plugin (https://wordpress.org/plugins/feedwordpress/) is notorious for duplicating posts
# and none of the current "duplicate post remover" plugins actually worked so I decided to write this small plugin
# to accomplish just that.
#


# usage

Install plugin and it will automatically configure wp_cron to run the remove_duplicate_posts_event().

# notes

wp_cron is not a true cron job, it requires a page visit to run.
Visit the WP codex for details on how it works (https://codex.wordpress.org/Function_Reference/wp_cron)

A useful plugin for verifying the wp_cron schedule has been correctly set use the Cron View/Cron GUI plugin (https://wordpress.org/plugins/cron-view/)
