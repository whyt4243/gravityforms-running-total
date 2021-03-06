<?php

/**
 * Shortcodes for Gravity Forms Running Total
 */
class GFRT_Shortcodes {
	function __construct() {
		add_shortcode( 'gfrt', array( $this, 'total' ) );
	}

	/*
	Usage: [gfrt id="1" field="3" debug="0"]
	*/
	function total( $atts ) {
		$form_id = 1; // Gets overwritten, but keeps PhpStorm from being angry.
		$form_id = $atts['id'];
		$debug   = $atts['debug'];
		$total   = 0;

		// From Chris Hajer April 15, 2014 to return more than 30 entries (the default)
		// Grabs all of the entries based on the $form_id
		$entries = RGFormsModel::get_leads( $form_id, 0, 'ASC', '', 0, 999, null, null, false, null, null, 'active', false );

		// loops through each form and grabs the "field" ID number based on what is submitted to the shortcode
		foreach ( $entries as $entry ) {

			// added this so a person can get a list of the data that is being submitted without looking at the DB
			if ( ( $debug == "true" ) OR ( $debug > 0 ) ) {
				print_r( $entry );
			}

			// strips the $
			$single_amount = str_replace( '$', '', $entry[ $atts[ field ] ] );

			// adds each value to to the total
			$total += $single_amount;

		}

		return $total;
	}

 		

}


new GFRT_Shortcodes();
