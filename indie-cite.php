<?php
/**
 * Plugin Name: Indie Cite
 * Plugin URI: http://github.com/pfefferle/wordpress-indie-cite
 * Description: Nice citation forms for the comments section
 * Author: Matthias Pfefferle
 * Author URI: http://notizblog.org
 * Version: 1.0.1
 * License: MIT
 * License URI: http://www.gnu.org/licenses/gpl.html
 * Text Domain: indie-cite
 */

function indie_cite_init() {
	load_plugin_textdomain( 'indie-cite', null, basename( dirname( __FILE__ ) ) );
}
add_action( 'init', 'indie_cite_init' );

function indie_cite_content() {
	?>
	<p>
		<label for="indie-cite-shortlink"><?php _e( 'Shortlink', 'indie-cite' ); ?></label>
		<input id="indie-cite-shortlink" class="u-url url shortlink" type="text" value="<?php echo wp_get_shortlink(); ?>" />
	</p>
	<p>
		<label for="indie-cite-permalink"><?php _e( 'Permalink', 'indie-cite' ); ?></label>
		<input id="indie-cite-permalink" class="u-url url u-uid uid bookmark" type="text" value="<?php echo get_permalink(); ?>" />
	</p>
	<?php
	// some comment ;)
	switch ( get_post_format() ) {
		case 'aside':
		case 'status':
?>
	<p>
		<label for="indie-cite-blockquote"><?php _e( 'HTML', 'indie-cite' ); ?></label>
		<input id="indie-cite-blockquote" class="code" type="text" size="70" value="&lt;blockquote&gt;&lt;p&gt;<?php echo get_the_excerpt(); ?>&lt;/p&gt;&lt;small&gt;—&nbsp;by &lt;a href=&quot;<?php echo get_permalink(); ?>&quot; class=&quot;h-card&quot; title=&quot;<?php echo get_the_author(); ?>&quot;&gt;<?php echo get_the_author(); ?>&lt;/a&gt;&lt;/small&gt;&lt;/blockquote&gt;">
	</p>
<?php
			break;
		default:
?>
	<p>
		<label for="indie-cite-cite"><?php _e( 'HTML', 'indie-cite' ); ?></label>
		<input id="indie-cite-cite" class="code" type="text" size="70" value="&lt;cite class=&quot;h-cite&quot;&gt;&lt;a class=&quot;u-url p-name&quot; href=&quot;<?php echo get_permalink(); ?>&quot;&gt;<?php echo get_the_title(); ?>&lt;/a&gt; (&lt;span class=&quot;p-author h-card&quot; title=&quot;<?php echo get_the_author(); ?>&quot;&gt;<?php echo get_the_author(); ?>&lt;/span&gt; &lt;time class=&quot;dt-published&quot; datetime=&quot;<?php echo get_the_date( 'c' ); ?>&quot;&gt;<?php echo get_the_date(); ?>&lt;/time&gt;)&lt;/cite&gt;">
	</p>
<?php
			break;
	}
}
add_action( 'comment_form_after', 'indie_cite_content', 99 );
