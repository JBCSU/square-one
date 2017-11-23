<?php


namespace Tribe\Project\Service_Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Tribe\Project\Queues\Backends\Mysql;
use Tribe\Project\Queues\Backends\WP_Cache;
use Tribe\Project\Queues\Backends\Redis;
use Tribe\Project\Queues\DefaultQueue;
use Predis\Client;

class Queues_Provider implements ServiceProviderInterface {

	public function register( Container $container ) {

		$container['queues.backend.redis.client'] = function() {
			$connection = defined( 'REDIS_CONNECTION') ? REDIS_CONNECTION : [
				'scheme' => 'tcp',
				'host'   => 'redis',
				'port'   => 6379,
			];
			return new Client( $connection );
		};

		$container['queues.backend.redis'] = function() use ( $container ) {
			return new Redis( $container['queues.backend.redis.client'] );
		};

		$container['queues.backend.wp_cache'] = function(){
			return new WP_Cache();
		};

		$container['queues.backend.mysql'] = function() {
			return new Mysql();
		};

		$container['queues.DefaultQueue'] = function ( $container ) {
			$backend = $container['queues.backend.redis'];
			return new DefaultQueue( $backend );
		};

		add_action( 'plugins_loaded', function () use ($container) {
			$container['queues.DefaultQueue'];
		} );
	}
}