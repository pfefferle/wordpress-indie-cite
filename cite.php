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
    <label for="cite-shortlink"><?php _e("Shortlink", "cite"); ?></label>
    <input id="cite-shortlink" class="u-url url shortlink" type="text" value="<?php echo wp_get_shortlink(); ?>" />
  </p>
  <p>
    <label for="cite-permalink"><?php _e("Permalink", "cite"); ?></label>
    <input id="cite-permalink" class="u-url url u-uid uid bookmark" type="text" value="<?php echo get_permalink(); ?>" />
  </p>
<?php
  // some comment ;)
  switch (get_post_format()) {
    case "aside":
    case "status":
?>
    <p>
      <label for="cite-blockquote"><?php _e("HTML", "cite"); ?></label>
      <input id="cite-blockquote" class="code" type="text" size="70" value="&lt;blockquote&gt;&lt;p&gt;<?php echo get_the_excerpt(); ?>&lt;/p&gt;&lt;/blockquote&gt;">
    </p>
<?php
      break;
    default:
?>
  <p>
    <label for="cite-cite"><?php _e("HTML", "cite"); ?></label>
    <input id="cite-cite" class="code" type="text" size="70" value="&lt;cite class=&quot;h-cite&quot;&gt;&lt;a class=&quot;u-url p-name&quot; href=&quot;<?php echo get_permalink(); ?>&quot;&gt;<?php echo get_the_title(); ?>&lt;/a&gt; (&lt;span class=&quot;p-author h-card&quot; title=&quot;<?php echo get_the_author(); ?>&quot;&gt;<?php echo get_the_author(); ?>&lt;/span&gt; &lt;time class=&quot;dt-published&quot; datetime=&quot;<?php echo get_the_date("c"); ?>&quot;&gt;<?php echo get_the_date(); ?>&lt;/time&gt;)&lt;/cite&gt;">
  </p>
<?php
      break;
  }
}
add_action('comment_form_after', 'cite_shortlink');