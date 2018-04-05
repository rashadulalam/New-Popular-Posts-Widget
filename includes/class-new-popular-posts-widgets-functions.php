<?php
/*
 * @link              http://about.me/rashadulalam
 * @since             1.0.0
 * @package           New_Popular_Posts_Widget

*/

class NPP_POPULAR_POSTS extends WP_Widget {

	//setup the widget name, description, etc...
	public function __construct() {
		$widgetOps = array(
				'classname'		=> 'npp-popular-posts',
				'description'	=> 'New Popular Posts Widget'
			);
		parent::__construct( 'npp-popular_posts', 'New Popular Post', $widgetOps );	
	}

	// back-end display of widget
	public function form( $instance ) {

		$title = ( !empty( $instance['title']) ? $instance['title'] : 'Popular Posts' );
		$total = ( !empty($instance['total']) ? absint( $instance['total'] ) : 5 );

		?>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">Title: </label>
				<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) );?>" type="text" value="<?php echo esc_attr( $title ); ?>" >
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'total' ) ); ?>">Number of Posts: </label>
				<input id="<?php echo esc_attr( $this->get_field_id( 'total' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'total' ) );?>" type="number" value="<?php echo esc_attr( $total ); ?>" >
			</p>

		<?php
	}

	// update widget
	public function update( $new_instance, $old_instance ) {
		
		$instance = array();
		$instance[ 'title' ] = ( !empty( $new_instance[ 'title' ]) ? strip_tags( $new_instance[ 'title' ] ) : '' );
		$instance[ 'total' ] = ( !empty( $new_instance[ 'total' ]) ? strip_tags( $new_instance[ 'total' ] ) : '' );

		return $instance;

	}

	// Comment number 
	public function nppw_comment_count() {
		
		$comments_num = get_comments_number();
		if( comments_open() ){
			if( $comments_num == 0 ){
				$comments = __('0');
			} elseif ( $comments_num > 1 ){
				$comments= $comments_num;
			} else {
				$comments = __('1');
			}
			
		}

		return $comments;

	}










	// front-end display of widget
	public function widget( $args, $instance ) {
		// $title = ( !empty( $instance['title']) ? $instance['title'] : 'Popular Posts' );
		$total = $instance['total'];

		$postArgs = array(
				'post_type'		=> 'post',
				'posts_per_page'	=> $total,
				'meta_key'		=> 'nppw_post_views',
				'orderby'		=> 'meta_value_num',
				'order'			=> 'DESC'
			);

		$query = new WP_Query( $postArgs );

		echo $args[ 'before_widget' ];
		if( !empty( $instance[ 'title' ] ) ):
			echo $args[ 'before_title' ] . apply_filters( 'widget_title', $instance[ 'title' ] ) . $args[ 'after_title' ];
		endif;

		if( $query->have_posts() ): ?>
			<div class="npp-post-outer">
			<?php while( $query->have_posts() ): $query->the_post(); ?>
				
        		<?php if( has_post_thumbnail() ): 
					$featured_image = wp_get_attachment_thumb_url( get_post_thumbnail_id( get_the_ID() ) );
				else: 
					$featured_image = plugin_dir_url( __FILE__ ) .'img/default.jpg';
				endif; ?>

				<div class="npp-post-inner" id="npp-item">
	                <a href="<?php the_permalink(); ?>">
	                    <img src="<?php echo $featured_image; ?>" class="npp-featured" alt="" />
	                  	<h2><?php the_title(); ?></h2>
	                </a>
	                <div class="meta"><span class="icon-clock"></span> <?php the_time( 'j F, Y' );?> <span class="icon-comment"></span><?php echo $this->nppw_comment_count(); ?></div>
	            </div><!-- .npp-post-inner -->

		<?php endwhile; ?>
		</div><!--npp-post-outer-->
		<?php endif;  

		echo $args[ 'after_widget' ];

	}


}

add_action( 'widgets_init', function() {
	register_widget( 'NPP_POPULAR_POSTS' );
});