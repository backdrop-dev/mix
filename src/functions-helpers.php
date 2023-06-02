<?php
/**
 * Mix Manifest functions.
 *
 * @package   Backdrop
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2019-2023. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://github.com/benlumia007/backdrop-mix-manifest
 */

namespace Backdrop\Mix\Manifest;
use Backdrop\App;

function asset( $path ) {

	// Get the Laravel Mix manifest.
	$manifest = App::resolve( 'backdrop/mix/manifest/parent' );

	// Make sure to trim any slashes from the front of the path.
	$path = '/' . ltrim( $path, '/' );

	if ( $manifest && isset( $manifest[ $path ] ) ) {
		$path = $manifest[ $path ];
	}

	return get_template_directory_uri() . '/' . 'public' . $path;
}

function childAsset( $path ) {

	// Get the Laravel Mix manifest.
	$manifest = App::resolve( 'backdrop/mix/manifest/child' );

	// Make sure to trim any slashes from the front of the path.
	$path = '/' . ltrim( $path, '/' );

	// Retrieve the path from the manifest, or null if not found.
	$manifestPath = $manifest[$path] ?? null;

	// Get the theme's directory URI.
	$themeDirectoryUri = wp_get_theme()->get_stylesheet_directory_uri();

	// Construct the URL with the desired path from the manifest.
	return trailingslashit( $themeDirectoryUri ) . 'public' . $manifestPath;
}

function pluginAsset( $path ) {

	// Get the Laravel Mix manifest.
	$manifest = App::resolve( 'backdrop/mix/manifest/plugin' );

	// Make sure to trim any slashes from the front of the path.
	$path = '/' . ltrim( $path, '/' );

	// Retrieve the path from the manifest, or null if not found.
	$manifestPath = $manifest[ $path ] ?? null;

	return dirname( dirname( dirname( plugin_dir_url( __DIR__ )  )  ) ) . '/public' . $manifestPath;
}