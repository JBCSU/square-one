<?php

namespace Tribe\Project\Templates\Components;

use Tribe\Project\Components\Component;

/**
 * Class Text
 *
 * @property string   $content
 * @property string   $tag
 * @property string[] $classes
 * @property string[] $attrs
 */
class Text extends Component {

	public const TEXT    = 'content';
	public const TAG     = 'tag';
	public const CLASSES = 'classes';
	public const ATTRS   = 'attrs';

	protected function defaults(): array {
		return [
			self::TAG     => 'div',
			self::CLASSES => [],
			self::ATTRS   => [],
		];
	}
}
