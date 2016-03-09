<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    //wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'parent-style', get_stylesheet_uri() );

//    wp_enqueue_style('flaton-prodefault', 'http://demo.webulous.in/flaton/wp-content/themes/flatonpro/css/blue.css');
}

function wpdocs_theme_name_scripts() {
//    wp_enqueue_script( 'my-ipacs-script', 'http://ph4-my-vit2.c9users.io/u/user_widget.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );



// Recent Posts with featured Images to be displayed on home page
if( ! function_exists('ipacs_recent_posts') ) {
	function ipacs_recent_posts() {
		$output = '';
		// WP_Query arguments
		$args = array (
			'post_type'              => 'post',
			'post_status'            => 'publish',
			//'posts_per_page'         => get_option('posts_per_page'),
			'posts_per_page'         => 6,
		//	'posts_per_page'         => 3,
			'ignore_sticky_posts'    => true,
			'order'                  => 'DESC',
		);

		// The Query
		$query = new WP_Query( $args );

		// The Loop
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$output .= '<div class="recent-posts-item page-block flex-i">';
				$output .= '<!--div class="rk-thumb">';
/*
				if ( has_post_thumbnail() ) {
					$output .= get_the_post_thumbnail();
				}
				else {
					$output .= '<img src="' . get_stylesheet_directory_uri() . '/images/thumbnail-default.png" alt="" >';
				}
*/
				$output .= '</div--><!-- .rk-thumb -->';
				$output .= '<div class="recent-post-content">';
				$output .= '<h3><a href="'. get_permalink() . '">' . get_the_title() . '</a></h3>';
				$output .= '<p>' . get_the_excerpt() . '</p>';
				$output .= '</div><!-- .rk-content -->';
				$output .= '</div>';
			}
		} 

		// Restore original Post Data
		wp_reset_postdata();
		echo $output;
	}
}


// Replaces the excerpt "more" text by a link
function ipacs_excerpt_more($more) {
	global $post;
	return ' <a class="rread-more" href="'. get_permalink($post->ID) . '">[&hellip;]</a>';
	//return '<a class="rread-more" href="'. get_permalink($post->ID) . '">'.$more.'</a>';
}
add_filter('excerpt_more', 'ipacs_excerpt_more');


// Custom Scripting to Move JavaScript from the Head to the Footer
/*
function remove_head_scripts() { 
   remove_action('wp_head', 'wp_print_scripts'); 
   remove_action('wp_head', 'wp_print_head_scripts', 9); 
   remove_action('wp_head', 'wp_enqueue_scripts', 1);

   add_action('wp_footer', 'wp_print_scripts', 5);
   add_action('wp_footer', 'wp_enqueue_scripts', 5);
   add_action('wp_footer', 'wp_print_head_scripts', 5); 
} 
add_action( 'wp_enqueue_scripts', 'remove_head_scripts' );
*/
// END Custom Scripting to Move JavaScript


add_action( 'widgets_init', 'ipacs_widgets_init' );
function ipacs_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Front Page Blocks Sidebar', 'ipacs' ),
        'id' => 'frontpage-sidebar-1',
        'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'theme-slug' ),
        //'before_widget' => '<div id="%1$s" class="flex-c widget %2$s">',
        'before_widget' => "\n\n<!-- before_widget  -->\n".'<div id="%1$s" class="page-block flex-i widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h2 cclass="widgettitle">',
	'after_title'   => '</h2>',
    ) );
}


class FrontPageBlock_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'my_front_page_block_widget',
			'description' => 'Block of code for FrontPage',
		);
		parent::__construct( 'my_front_page_block_widget', 'My Front Page Block Widget', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		// outputs the content of the widget
		$before_widget = $args['before_widget'];
		if ( ! empty( $instance['class'] ) ) {
			$before_widget = str_replace('class="', 'class="'. $instance['class'] . ' ', $before_widget);
		}
		echo $before_widget;
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'];
			if ( ! empty( $instance['url'] ) ) {
				echo "<a href=".$instance['url'].">";
			}
				echo apply_filters( 'widget_title', $instance['title'] );
				if ( ! empty( $instance['url'] ) ) {
					echo "</a>";
				}
			echo $args['after_title'];
		}
		if ( ! empty( $instance['content'] ) ) {
			//echo $instance['content'];
			echo do_shortcode($instance['content']);
		}
	//	echo __( 'Hello, World!', 'text_domain' );
		echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'text_domain' );
		$url = ! empty( $instance['url'] ) ? $instance['url'] : __( '', 'text_domain' );
		$class = ! empty( $instance['class'] ) ? $instance['class'] : __( '', 'text_domain' );
		$content = ! empty( $instance['content'] ) ? $instance['content'] : __( 'New content', 'text_domain' );
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'Url:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" type="text" value="<?php echo esc_attr( $url ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'class' ); ?>"><?php _e( 'Class:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'class' ); ?>" name="<?php echo $this->get_field_name( 'class' ); ?>" type="text" value="<?php echo esc_attr( $class ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'content' ); ?>"><?php _e( 'Content:' ); ?></label> 
		<!--input class="widefat" id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>" type="text" value="<?php echo esc_attr( $content ); ?>"-->
		<textarea rows=10 class="widefat" id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>" type="text" value="<?php echo esc_attr( $content ); ?>"><?php echo esc_attr( $content ); ?></textarea>
		</p>
		<?php 
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		//$instance = array();
		//$instance['title'] = $new_instance['title'];
		//$instance['url'] = $new_instance['url'];
		//$instance['content'] = do_shortcode($new_instance['content']);
		//return $instance;
		return $new_instance;
	}
}


add_action( 'widgets_init', function(){
	register_widget( 'FrontPageBlock_Widget' );
});


?>
