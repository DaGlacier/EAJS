<?php
// Prevent direct file access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Interface for the posts table data.
 *
 * Each column in the posts table implements this interface to retrieve its data.
 *
 * @package   Posts_Table_Pro\Data
 * @author    Barn2 Media <info@barn2.co.uk>
 * @license   GPL-3.0
 * @copyright Barn2 Media Ltd
 */
interface Posts_Table_Data {

	public function get_data();

	public function get_filter_data();

	public function get_sort_data();

}