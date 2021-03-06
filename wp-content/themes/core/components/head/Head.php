<?php
declare( strict_types=1 );

namespace Tribe\Project\Templates\Components;

use Tribe\Project\Components\Component;

class Head extends Component {

	public function init() {
		$this->data['name']         = get_bloginfo( 'name' );
		$this->data['pingback_url'] = get_bloginfo( 'pingback_url' );
		$this->data['title']        = $this->get_page_title();
	}

	protected function get_page_title() {
		if ( is_front_page() ) {
			return '';
		}

		// Blog
		if ( is_home() ) {
			return __( 'Blog', 'tribe' );
		}

		// Search
		if ( is_search() ) {
			return __( 'Search Results', 'tribe' );
		}

		// 404
		if ( is_404() ) {
			return __( 'Page Not Found (404)', 'tribe' );
		}

		// Singular
		if ( is_singular() ) {
			return get_the_title();
		}

		// Archives
		return get_the_archive_title();
	}
}
