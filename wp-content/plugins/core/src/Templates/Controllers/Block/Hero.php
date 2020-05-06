<?php
declare( strict_types=1 );

namespace Tribe\Project\Templates\Controllers\Block;

/*
 * @TODO: THIS IS NOT COMPLETE AND WILL BE PICKED BACK UP BY RYAN
 */

class Hero extends Block_Controller {
	public function render( string $path = '' ): string {
		$title = ! empty( $this->attributes[ 'title' ] ) ? '<h1 class="test-hero__title">' . $this->attributes[ 'title' ] . '</h1>' : '';
		$description = ! empty( $this->attributes[ 'description' ] ) ? '<div class="test-hero__description">' . $this->attributes[ 'description' ] . '</div>' : '';
		$cta = ! empty( $this->attributes[ 'cta' ] ) && ! empty( $this->attributes[ 'cta' ][ 'text' ] ) ? '<a class="test-hero__cta" href="' . $this->attributes[ 'cta' ][ 'text' ] . '">Click Here for More Clicks</a>' : '';
		$icon = ! empty( $this->attributes[ 'icon' ] ) && ! empty( $this->attributes[ 'icon' ][ 'url' ] )
			? '<i class="test-hero__icon" style="background-image: url('. $this->attributes[ 'icon' ][ 'url' ] .');"></i>'
			: '';

		$hero_bg = ! empty( $this->attributes[ 'bg-image' ] ) && ! empty( $this->attributes[ 'bg-image' ][ 'url' ] )
			? 'background-image: url(' . $this->attributes[ 'bg-image' ][ 'url' ]  . ');'
			: '';

		$align = ! empty( $this->attributes[ 'align' ] )
			? 'display: flex; align-items:' . $this->attributes[ 'align' ] . '; justify-content:' . $this->attributes[ 'align' ] . ';'
			: '';


		return '
			<div class="test-hero" style="' . $hero_bg . $align . '">
				<div class="test-hero__content content-wrap t-sink s-spa t-theme--light">
					' . $icon . '
					' . $title . '
					' . $description . '
					' . $cta . '
				</div>
			</div>
';
	}
}