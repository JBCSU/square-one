<?php


namespace Tribe\Project\Templates;

class Unsupported_Browser extends Base {

	public function get_data(): array {
		$data                                = parent::get_data();
		$data['post']                        = $this->get_post();
		$data['css']                         = $this->get_css();
		$data['favicon']                     = $this->get_favicon();
		$data['legacy_browser_title']        = $this->get_legacy_page_title();
		$data['legacy_browser_content']      = $this->get_legacy_page_content();
		$data['legacy_logo_header']          = tribe_assets_url( 'theme/img/legacy-browser/logo-header.png' );
		$data['legacy_logo_footer']          = tribe_assets_url( 'theme/img/legacy-browser/logo-footer.png' );
		$data['legacy_browser_icon_chrome']  = tribe_assets_url( 'theme/img/legacy-browser/chrome.png' );
		$data['legacy_browser_icon_firefox'] = tribe_assets_url( 'theme/img/legacy-browser/firefox.png' );
		$data['legacy_browser_icon_safari']  = tribe_assets_url( 'theme/img/legacy-browser/safari.png' );
		$data['legacy_browser_icon_ie']      = tribe_assets_url( 'theme/img/legacy-browser/ie.png' );

		return $data;
	}

	protected function get_post() {
		return [];
	}

	protected function get_favicon() {
		return tribe_assets_url( 'theme/img/branding/favicon.ico' );
	}

	protected function get_css() {
		$css_dir    = trailingslashit( tribe_assets_url( 'theme/css' ) );
		$css_legacy = ( ! defined( 'SCRIPT_DEBUG' ) || SCRIPT_DEBUG === false ) ? 'dist/legacy.min.css' : 'legacy.css';

		return $css_dir . $css_legacy;
	}

	protected function get_legacy_page_title() {
		return sprintf( '%s %s', __(  'Welcome to', 'tribe' ), get_bloginfo( 'name' ) );
	}

	protected function get_legacy_page_content() {
		return sprintf(
			'%s <a href="http://browsehappy.com/" rel="external">%s</a>.',
			__( 'You are viewing this site in a browser that is no longer supported or secure. For the best possible experience, we recommend that you', 'tribe' ),
			__( 'update or use a modern browser', 'tribe' )
		);
	}
}
