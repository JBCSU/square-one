<?php
declare( strict_types=1 );

namespace Tribe\Project\Templates\Controllers;

use Tribe\Project\Templates\Abstract_Template;
use Tribe\Project\Templates\Component_Factory;
use Tribe\Project\Templates\Components\Footer\Footer_Wrap;
use Tribe\Project\Templates\Controllers\Content\Footer\Default_Footer as Footer_Content;
use Twig\Environment;

class Footer extends Abstract_Template {
	/**
	 * @var Footer_Content
	 */
	private $content;

	public function __construct( Environment $twig, Component_Factory $factory, Footer_Content $content ) {
		parent::__construct( $twig, $factory );
		$this->content = $content;
	}

	public function render( string $path = '' ): string {
		return $this->factory->get( Footer_Wrap::class, [
			Footer_Wrap::CONTENT => $this->content->render(),
		] )->render( $path );
	}

}
