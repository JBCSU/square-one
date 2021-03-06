<?php
declare( strict_types=1 );

namespace Tribe\Project\Templates\Controllers\Header;

use Tribe\Project\Nav_Menus\Menu;
use Tribe\Project\Nav_Menus\Walker\Walker_Nav_Menu_Primary;
use Tribe\Project\Templates\Abstract_Controller;
use Tribe\Project\Templates\Components\Header\Navigation as Navigation_Context;

class Navigation extends Abstract_Controller {
	public function render( string $path = '' ): string {
		return $this->factory->get( Navigation_Context::class, [
			Navigation_Context::MENU => $this->get_primary_nav_menu(),
		] )->render( $path );
	}

	public function get_primary_nav_menu() {
		$args = [
			'theme_location'  => 'primary',
			'container'       => false,
			'container_class' => '',
			'menu_class'      => '',
			'menu_id'         => '',
			'depth'           => 3,
			'items_wrap'      => '%3$s',
			'fallback_cb'     => false,
			'walker'          => new Walker_Nav_Menu_Primary(),
		];

		return Menu::menu( $args );
	}

}
