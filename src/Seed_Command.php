<?php

use \WP_CLI\Utils;

/**
 * Installs seed data to WordPress
 *
 * ## EXAMPLES
 *
 *     # Create new WordPress installation
 *     $ wp seed install
 *     Success: WordPress is now installed with seed data.
 */
class Seed_Command extends WP_CLI_Command {

	/**
	 * Installs seed data.
	 *
	 * Runs WordPress installation with seed data.
	 *
	 * ## EXAMPLES
	 *
	 *     $ wp seed install
	 *     Success: WordPress is now installed with seed data.
	 */
	public function install( $_, $assoc_args ) {

		WP_CLI::confirm( "Are you sure you want seed '" . DB_NAME . "' database?", $assoc_args );

		@WP_CLI::get_runner()->load_wordpress();

		$title = ( getenv( 'WP_SEED_TITLE' ) ?: 'WordPress' );
		$user_name = ( getenv( 'WP_SEED_USER_NAME' ) ?: 'admin' );
		$user_password = wp_generate_password(32);

		// Try to check the email from multiple sources
		if ( getenv( 'WP_SEED_USER_EMAIL' ) ) {
			$user_email = getenv( 'WP_SEED_USER_EMAIL' );
		} else if ( defined( 'WP_HOME' ) ) {
			$user_email = 'admin@' . parse_url( WP_HOME, PHP_URL_HOST );
		} else if ( getenv( 'SERVER_NAME' ) ) {
			$user_email = 'admin@' . getenv( 'SERVER_NAME' );
		}

		// Use hidden if the environment is not public
		if ( getenv( 'WP_ENV' ) ) {
			switch ( getenv( 'WP_ENV' ) ) {
				case 'production':
				case 'prod':
					$public = true;
					break;
				
				default:
					$public = false;
					break;
			}
		}

		if ( defined( 'WPLANG' ) ) {
			$language = WPLANG;
		} else if ( getenv( 'WP_SEED_LANGUAGE' ) ) {
			$language = getenv( 'WP_SEED_LANGUAGE' );
		}

		wp_install( $title, $user_name, $user_email, $public, '', $user_password, $language );

		// Activate all plugins

		// Run the seed functions in plugins
		//do_action( 'wp_create_seed_data', [] );

		WP_CLI::success( 'WordPress is now installed with seed data.' );
	}
}
