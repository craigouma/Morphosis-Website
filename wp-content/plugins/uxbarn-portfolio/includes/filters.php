<?php

function uxb_port_single_title_filter_function( $title ) {
	// Return a row containing item title
	return '<div class="row no-margin-bottom"><div class="uxb-col large-12 columns"><h2 class="uxb-port-single-title">' . $title . '</h2></div></div>';
}



function uxb_port_tax_title_filter_function() {
	
	if ( is_tax( 'uxbarn_portfolio_tax' ) ) {
		
		// Return a row containing taxonomy template's title
		return '<div class="row no-margin-bottom"><div class="uxb-col large-12 columns"><h2 class="uxb-port-tax-title">' . __( 'Category: ', 'uxb_port' ) . '<span>' . single_term_title( '', false ) . '</span></h2><p>' . term_description() . '</p></div></div>';
	
	} else {
		return __( 'This filter must be placed in the taxonomy template of Portfolio post type only.', 'uxb_port' );
	}
	
}