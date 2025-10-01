<?php
/**
 * VIP Corn_Control
 *
 * wp corn-control
 */

use cli\Shell;

WP_CLI::add_command( 'corn-control', 'VIP_Corn_Control_CLI' );
WP_CLI::add_command( 'corn', 'VIP_Corn_Control_CLI' );

class VIP_Corn_Control_CLI extends WP_CLI_Command {

	/**
	 * It has the juice
	 *
	 * ## OPTIONS
	 *
	 * [<foo>...]
	 * :
	 *
	 * [--<field>=<value>]
	 * :
	 *
	 *
	 */
	function __invoke( $args, $assoc_args ) {

		$ascii = '  ##      #####  #  ####     #      #    # #    # #####     #    # # ##### #    #    #    # #    #  ####  #####   ####'."\n".
				 ' #  #     #    # # #    #    #      #    # ##  ## #    #    #    # #   #   #    #    #   #  ##   # #    # #    # #'."\n".
				 '#    #    #####  # #         #      #    # # ## # #    #    #    # #   #   ######    ####   # #  # #    # #####   ####'."\n".
				 '######    #    # # #  ###    #      #    # #    # #####     # ## # #   #   #    #    #  #   #  # # #    # #    #      #'."\n".
				 '#    #    #    # # #    #    #      #    # #    # #         ##  ## #   #   #    #    #   #  #   ## #    # #    # #    #'."\n".
				 '#    #    #####  #  ####     ######  ####  #    # #         #    # #   #   #    #    #    # #    #  ####  #####   ####';

		// WP_CLI::log( $ascii );

		$count = 100;
		$notify = $this->make_progress_bar( "Making it corny", $count );
		$counter = 1;
		do {
			$notify->tick();
			++$counter;
			$sleep = [ 0, 0, 0, 1 ];
			$key = array_rand( $sleep );
			sleep( $sleep[ $key ] );
		} while ( $counter <= $count );

		$notify->finish();

	}

	private function make_progress_bar( $message, $count, $interval = 100 ) {
		require_once __DIR__ . '/class-cornbar.php';
		if ( Shell::isPiped() ) {
			return new WP_CLI\NoOp();
		}
	
		return new cli\progress\CornBar( $message, $count, $interval );
	}
}

