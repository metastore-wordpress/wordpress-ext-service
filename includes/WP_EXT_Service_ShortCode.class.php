<?php

/**
 * Class WP_EXT_Service_ShortCode
 */
class WP_EXT_Service_ShortCode extends WP_EXT_Service {

	/**
	 * Constructor.
	 */
	public function __construct() {
		parent::__construct();

		$this->run();
	}

	/**
	 * Plugin: `initialize`.
	 */
	public function run() {
		add_shortcode( $this->archive_ID, [ $this, 'shortcode' ] );
	}

	/**
	 * ShortCode.
	 */
	public function shortcode( $atts, $content = null ) {

		/**
		 * Global variables.
		 */
		global $wp_query;

		/**
		 * Options.
		 */
		$defaults = [
			'type' => '',
		];

		$atts = shortcode_atts( $defaults, $atts, $this->archive_ID );

		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

		$args = [
			'post_type'      => $this->pt_ID,
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'paged'          => $paged,
			'tax_query'      => [
				[
					'taxonomy' => $this->pt_ID . '_meta',
					'field'    => 'slug',
					'terms'    => 'archive',
					'operator' => 'NOT IN',
				]
			],
		];

		/**
		 * Rendering data.
		 */
		$wp_query = new WP_Query( $args );

		if ( $wp_query->have_posts() ) {
			echo '<section class="wp-ext-' . $this->domain_ID . '">';
			echo '<h2><a href="/services">' . esc_html__( 'Услуги', 'wp-ext-' . $this->domain_ID ) . '</a></h2>';
			echo '<div class="service-grid">';

			while ( $wp_query->have_posts() ) {
				$wp_query->the_post();

				echo self::shortcode_render();
			}

			echo '</div>';
			echo '</section>';

			do_action( 'genesis_after_endwhile' );
		}

		/**
		 * Reset query.
		 */
		wp_reset_query();
	}

	/**
	 * Render: `shortcode`.
	 *
	 * @return string
	 */
	public function shortcode_render() {
		$cover = esc_html( get_field( $this->pt_ID . '_cover' ) );

		if ( $cover ) {
			$cover = '<i class="' . $cover . '"></i>';
		} else {
			$cover = '<i class="fas fa-check-circle"></i>';
		}

		$out = '<section class="service service-grid">';
		$out .= '<div class="service-cover"><a title="' . esc_attr( get_the_title() ) . '" href="' . esc_url( get_permalink() ) . '">' . $cover . '</a></div>';
		$out .= '<div class="service-body"><h4 class="service-title"><a href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a></h4><div class="service-content">' . get_the_content() . '</div></div>';
		$out .= '</section>';

		return $out;
	}
}

/**
 * Helper function to retrieve the static object without using globals.
 *
 * @return WP_EXT_Service_ShortCode
 */
function WP_EXT_Service_ShortCode() {
	static $object;

	if ( null == $object ) {
		$object = new WP_EXT_Service_ShortCode;
	}

	return $object;
}

/**
 * Initialize the object on `plugins_loaded`.
 */
add_action( 'plugins_loaded', [ WP_EXT_Service_ShortCode(), 'run' ] );
