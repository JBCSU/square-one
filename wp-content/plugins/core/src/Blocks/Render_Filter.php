<?php
declare( strict_types=1 );

namespace Tribe\Project\Blocks;

use Tribe\Gutenpanels\Blocks\Block_Type;
use Tribe\Project\Components\Handler;
use Tribe\Project\Controllers\Blocks\Block_Controller;
use Tribe\Project\Components\Component_Factory;
use Tribe\Project\Templates\Controllers;

class Render_Filter {

	/**
	 * @var Component_Factory
	 */
	private $factory;

	/**
	 * @var Handler
	 */
	private $handler;

	/**
	 * @var array A map of block type names to the Block_Controller class used to render it
	 */
	private $map;


	public function __construct( Component_Factory $factory, Handler $handler ) {
		$this->factory = $factory;
		$this->handler = $handler;
	}

	public function render( string $prefiltered, array $attributes, string $content, Block_Type $block_type ) {
		$controllers = apply_filters( 'tribe/project/controllers/registered_block_controllers', [] );

		$name = $block_type->name()->value();

		if ( ! array_key_exists( $name, $controllers ) ) {
			return $prefiltered;
		}

		/** @var Block_Controller $controller */
		$controller = $controllers[$name];

		ob_start();
		$controller->render( $attributes, $content, $block_type );
		return ob_get_clean();
	}
}
