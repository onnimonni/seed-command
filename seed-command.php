<?php

if ( ! class_exists( 'WP_CLI' ) ) {
	return;
}

$autoload = dirname( __FILE__ ) . '/vendor/autoload.php';
if ( file_exists( $autoload ) ) {
	require_once $autoload;
}

//add_filter( 'enable_maintenance_mode', 'onnin_hassu_testi' );

WP_CLI::add_hook( 'enable_maintenance_mode', function() {
	die('TESTING');
});

//debug_print_backtrace();

//error_log('test');

WP_CLI::add_command( 'seed', 'Seed_Command' );
