<?php


if ( ! function_exists( 'beneon_show_if_3d_preview_enabled' ) ) {
	/**
	 * Show or no preview.
	 *
	 * @param object $cmb The element to be shown or hide.
	 * @return boolean
	 */
	function beneon_show_if_3d_preview_enabled( $cmb ) {
		return ( $cmb->object_id() && get_post_meta( $cmb->object_id(), 'beneon_3d_preview', true ) === 'yes' );
	}
}


if ( ! function_exists( 'beneon_get_post_options' ) ) {
	/**
	 * Get post options.
	 *
	 * @param array $query_args The queries.
	 * @return arrat
	 */
	function beneon_get_post_options( $query_args ) {
		$args = wp_parse_args(
			$query_args,
			array(
				'post_type'      => 'post',
				'posts_per_page' => -1,
			)
		);

		$posts = get_posts( $args );

		$post_options = array();
		if ( $posts ) {
			foreach ( $posts as $post ) {
				$post_options[ $post->ID ] = $post->post_title;
			}
		}

		return $post_options;
	}
}
