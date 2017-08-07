<?php

namespace Tribe\Project\Templates\Components;

use Tribe\Project\Panels\Types\CardGrid;
use Tribe\Project\Twig\Twig_Template;

class Card extends Twig_Template {

	const TITLE       = 'title';
	const DESCRIPTION = 'description';
	const IMAGE       = 'image';
	const CTA         = 'cta';
	const CTA_URL     = 'url';
	const CTA_LABEL   = 'label';
	const CTA_TARGET  = 'target';

	protected $card = [];

	public function __construct( $card, $template, \Twig_Environment $twig = null ) {
		parent::__construct( $template, $twig );

		$this->card = $card;
	}

	public function get_data(): array {
		$data = [
			'card_classes'         => $this->get_card_classes(),
			'card_header_classes'  => $this->get_card_header_classes(),
			'title'                => $this->get_title(),
			'card_content_classes' => $this->get_card_content_classes(),
			'description'          => $this->get_card_description(),
			'image'                => $this->get_card_image( $this->card[ self::IMAGE ] ),
			'image_classes'        => $this->get_image_classes(),
			'button'               => $this->get_button(),
		];

		return $data;
	}

	protected function get_title() {

		if ( empty( $this->card[ self::TITLE ] ) ) {
			return '';
		}

		$title   = esc_html( $this->card[ self::TITLE ] );
		$classes = $this->get_card_title_classes();
		$attrs   = $this->get_card_title_attrs();
		$tag     = 'h3';

		$title_obj = Title::factory( $title, $tag, $classes, $attrs );

		return $title_obj->render();
	}

	protected function get_card_image( $img ) {

		if ( empty( $img ) ) {
			return false;
		}

		$options = [
			'as_bg'        => false,
			'use_lazyload' => false,
			'echo'         => false,
			'src_size'     => 'component-card',
		];

		$image = Image::factory( $img, $options );

		return $image->render();
	}

	protected function get_button() {

		if ( empty( $this->card[ self::CTA ][ self::CTA_URL ] ) ) {
			return '';
		}

		$options = [
			'url'         => esc_url( $this->card[ self::CTA ][ self::CTA_URL ] ),
			'label'       => esc_html( $this->card[ self::CTA ][ self::CTA_LABEL ] ),
			'target'      => esc_attr( $this->card[ self::CTA ][ self::CTA_TARGET ] ),
			'btn_as_link' => true,
		];

		$button = Button::factory( $options );

		return $button->render();
	}

	protected function get_card_classes() {
		$classes = [ 'c-card' ];

		return implode( ' ', $classes );
	}

	protected function get_card_header_classes() {
		$classes = [ 'c-card__header' ];

		return implode( ' ', $classes );
	}

	protected function get_image_classes() {
		$classes = [ 'c-image' ];

		return implode( ' ', $classes );
	}

	protected function get_card_title_classes() {
		$classes = [ 'c-card__title' ];

		return $classes;
	}

	protected function get_card_title_attrs() {
		return [
			'data-depth'    => 0,
			'data-name'     => CardGrid::FIELD_CARD_TITLE,
			'data-index'    => esc_attr( get_nest_index() ),
			'data-livetext' => true,
		];
	}

	protected function get_card_content_classes() {
		$classes = [ 'c-card__content' ];

		return implode( ' ', $classes );
	}

	protected function get_card_description() {

		if ( empty( $this->card[ self::DESCRIPTION ] ) ) {
			return '';
		}

		$classes = [ 'c-card__desc' ];
		$attrs   = [];

		if ( is_panel_preview() ) {
			$attrs = [
				'data-depth'    => 0,
				'data-name'     => CardGrid::FIELD_CARD_DESCRIPTION,
				'data-index'    => esc_attr( get_nest_index() ),
				'data-autop'    => 'true',
				'data-livetext' => true,
			];
		}

		$desc_object = Description::factory( $this->card[ self::DESCRIPTION ], $classes, $attrs );

		return $desc_object->render();
	}

	/**
	 * Get an instance of this controller bound to the correct data.
	 *
	 * @param        $card
	 * @param string $template
	 *
	 * @return static
	 */
	public static function factory( $card, $template = 'components/card.twig' ) {
		return new static( $card, $template );
	}
}