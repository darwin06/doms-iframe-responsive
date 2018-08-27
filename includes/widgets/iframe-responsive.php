<?php
/**
 * Adds Foo_Widget widget.
 */
class Foo_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'iframe_responsive_widget', // Base ID
			esc_html__( 'DOMS Iframe Responsive', 'text_domain' ), // Name
			array( 'description' => esc_html__( 'A Iframe Responsive Widget', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
    }

    if ( !empty( $instance['iframe'] ) ) {
      $wrapIframe = '';
      $wrapIframe .= '<div class="wrap-iframe">';
      $wrapIframe .= '<iframe src="' . $instance['iframe'] . '" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>';
      $wrapIframe .= '</div>';

      echo $wrapIframe; 
    };

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'text_domain' );
		$iframe = ! empty( $instance['iframe'] ) ? $instance['iframe'] : 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d121430.51852379416!2d-93.0231616243329!3d17.992516972964772!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85edd796d7420653%3A0xf5607b62558ae894!2sVillahermosa%2C+Tabasco!5e0!3m2!1sen!2smx!4v1535262274497';
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'text_domain' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
    </p>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'iframe' ) ); ?>"><?php esc_attr_e( 'Iframe URL:', 'text_domain' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'iframe' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'iframe' ) ); ?>" type="text" value="<?php echo esc_attr( $iframe ); ?>" placeholder="Iframe URL">
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['iframe'] = ( ! empty( $new_instance['iframe'] ) ) ? esc_url_raw( $new_instance['iframe'] ) : '';

		return $instance;
	}

} // class Foo_Widget

// register Foo_Widget widget
function register_foo_widget() {
  register_widget( 'Foo_Widget' );
}
add_action( 'widgets_init', 'register_foo_widget' );

?>