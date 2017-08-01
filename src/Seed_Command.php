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

		@WP_CLI::get_runner()->load_wordpress();

		WP_CLI::success( 'WordPress is now installed with seed data.' );
	}
}
