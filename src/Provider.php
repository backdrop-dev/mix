<?php
/**
 * Mix Manifest provider.
 *
 * @package   Backdrop
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2019-2023. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://github.com/benlumia007/backdrop-mix-manifest
 */

namespace Backdrop\Mix\Manifest;
use Backdrop\Core\ServiceProvider;

/**
 * App service provider.
 *
 * @since  1.0.0
 * @access public
 */
class Provider extends ServiceProvider {

	/**
	 * Callback executed when the `\Hybrid\Core\Application` class registers
	 * providers. Use this method to bind items to the container.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function register() {

		// Bind the Laravel Mix manifest for cache-busting.
		$this->app->singleton( 'backdrop/mix/manifest/parent', function() {

			$file = get_template_directory() . 'public/mix-manifest.json';

			return file_exists( $file ) ? json_decode( file_get_contents( $file ), true ) : null;
		} );

		// Bind the Laravel Mix manifest for cache-busting.
		$this->app->singleton( 'backdrop/mix/manifest/child', function() {

			$file = get_stylesheet_directory() . 'public/mix-manifest.json';

			return file_exists( $file ) ? json_decode( file_get_contents( $file ), true ) : null;
		} );
	}
}