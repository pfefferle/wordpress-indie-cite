<?php
/*
 Plugin Name: Cite
 Plugin URI: http://github.com/pfefferle/wordpress-cite
 Description:
 Author: Matthias Pfefferle
 Author URI: http://notizblog.org
 Version: 1.0.0-dev
 License: GPL v3 (http://www.gnu.org/licenses/gpl.html)
 Text Domain: cite
*/

function cite_init() {
  load_plugin_textdomain( 'cite', null, basename( dirname( __FILE__ ) ) );
}
add_action('init', 'cite_init');

function cite_shortlink() {
  ?>
  <p>
    <label for="shortlink"><?php _e("Shortlink", "cite"); ?></label>
    <input id="shortlink" value="<?php echo wp_get_shortlink(); ?>" />
  </p>
  <?php
}
add_action('comment_form_after', 'cite_shortlink');