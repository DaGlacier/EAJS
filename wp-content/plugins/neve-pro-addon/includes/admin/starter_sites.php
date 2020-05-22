<?php
/**
 * Author:          Andrei Baicus <andrei@themeisle.com>
 * Created on:      2019-06-04
 *
 * @package starter_sites.php
 */

namespace Neve_Pro\Admin;


use Neve_Pro\Traits\Core;

/**
 * Class Starter_Sites
 *
 * @package Neve_Pro\Admin
 */
class Starter_Sites {
	use Core;

	/**
	 * Initialize the starter sites class.
	 */
	public function init() {
		add_filter( 'neve_filter_onboarding_data', array( $this, 'add_starter_sites' ) );
	}

	/**
	 * Add the starter sites.
	 *
	 * @param array $starter_sites starter sites array.
	 *
	 * @return mixed
	 */
	public function add_starter_sites( $starter_sites ) {
		if ( $this->get_license_type() < 2 ) {
			return $starter_sites;
		}

		unset( $starter_sites['upsell'] );

		if ( ! isset( $starter_sites['remote'] ) ) {
			$starter_sites['remote'] = array();
		}

		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		$remote_starter_sites = array(
			'thrive architect' => array(
				'neve-thrive-cafe'                  => array(
					'url'              => 'https://demo.themeisle.com/neve-cafe-th/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-cafe-th/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/06/neve-caffe-new-ss.jpg',
					'title'            => 'Coffee Shop',
					'external_plugins' => array(
						[
							'name'       => 'Thrive Architect',
							'active'     => is_plugin_active( 'thrive-visual-editor/thrive-visual-editor.php' ),
							'author_url' => esc_url( 'https://thrivethemes.com/architect/' ),
						],
					),
				),
				'neve-thrive-fashion'               => array(
					'url'              => 'https://demo.themeisle.com/neve-fashion-th/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-fashion-th/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/07/neve-fashion-demo-screenshot.png',
					'title'            => 'Fashion',
					'external_plugins' => array(
						[
							'name'       => 'Thrive Architect',
							'active'     => is_plugin_active( 'thrive-visual-editor/thrive-visual-editor.php' ),
							'author_url' => esc_url( 'https://thrivethemes.com/architect/' ),
						],
					),
				),
				'neve-thrive-showcase'              => array(
					'url'              => 'https://demo.themeisle.com/neve-showcase-th/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-showcase-th/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-showcase-new.jpg',
					'title'            => 'Showcase',
					'external_plugins' => array(
						[
							'name'       => 'Thrive Architect',
							'active'     => is_plugin_active( 'thrive-visual-editor/thrive-visual-editor.php' ),
							'author_url' => esc_url( 'https://thrivethemes.com/architect/' ),
						],
					),
				),
				'neve-thrive-job-listings'          => array(
					'url'              => 'https://demo.themeisle.com/neve-job-listings-th/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-job-listings-th/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-job-listings.jpg',
					'title'            => 'Job Listing',
					'external_plugins' => array(
						[
							'name'       => 'Thrive Architect',
							'active'     => is_plugin_active( 'thrive-visual-editor/thrive-visual-editor.php' ),
							'author_url' => esc_url( 'https://thrivethemes.com/architect/' ),
						],
					),
				),
				'neve-thrive-real-estate'           => array(
					'url'              => 'https://demo.themeisle.com/neve-real-estate-th/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-real-estate-th/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-real-estate.jpg',
					'title'            => 'Real Estate',
					'external_plugins' => array(
						[
							'name'       => 'Thrive Architect',
							'active'     => is_plugin_active( 'thrive-visual-editor/thrive-visual-editor.php' ),
							'author_url' => esc_url( 'https://thrivethemes.com/architect/' ),
						],
					),
				),
				'neve-thrive-events'                => array(
					'url'              => 'https://demo.themeisle.com/neve-events-th/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-events-th/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-events.jpg',
					'title'            => 'Events',
					'external_plugins' => array(
						[
							'name'       => 'Thrive Architect',
							'active'     => is_plugin_active( 'thrive-visual-editor/thrive-visual-editor.php' ),
							'author_url' => esc_url( 'https://thrivethemes.com/architect/' ),
						],
					),
				),
				'neve-thrive-photography-portfolio' => array(
					'url'              => 'https://demo.themeisle.com/neve-photography-portfolio-th/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-photography-portfolio-th/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-studio-photography.jpg',
					'title'            => 'Photography Studio',
					'external_plugins' => array(
						[
							'name'       => 'Thrive Architect',
							'active'     => is_plugin_active( 'thrive-visual-editor/thrive-visual-editor.php' ),
							'author_url' => esc_url( 'https://thrivethemes.com/architect/' ),
						],
					),
				),
				'neve-thrive-video-agency'          => array(
					'url'              => 'https://demo.themeisle.com/neve-video-th/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-video-th/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-vide-agency.jpg',
					'title'            => 'Video Agency',
					'external_plugins' => array(
						[
							'name'       => 'Thrive Architect',
							'active'     => is_plugin_active( 'thrive-visual-editor/thrive-visual-editor.php' ),
							'author_url' => esc_url( 'https://thrivethemes.com/architect/' ),
						],
					),
				),
				'neve-thrive-farm'                  => array(
					'url'              => 'https://demo.themeisle.com/neve-farm-th/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-farm-th/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-farm.jpg',
					'title'            => 'Farm',
					'external_plugins' => array(
						[
							'name'       => 'Thrive Architect',
							'active'     => is_plugin_active( 'thrive-visual-editor/thrive-visual-editor.php' ),
							'author_url' => esc_url( 'https://thrivethemes.com/architect/' ),
						],
					),
				),
				'neve-thrive-speed'                 => array(
					'url'              => 'https://demo.themeisle.com/neve-pro-th/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-pro-th/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/10/neve-speed.jpg',
					'title'            => 'Speed',
					'external_plugins' => array(
						[
							'name'       => 'Thrive Architect',
							'active'     => is_plugin_active( 'thrive-visual-editor/thrive-visual-editor.php' ),
							'author_url' => esc_url( 'https://thrivethemes.com/architect/' ),
						],
					),
				),
			),
			'divi builder'     => array(
				'neve-divi-lawyers'      => array(
					'url'              => 'https://demo.themeisle.com/neve-lawyers-dv/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-lawyers-dv/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/12/neve-lawyers.jpg',
					'title'            => 'Lawyers',
					'external_plugins' => [
						[
							'name'       => 'Divi Builder',
							'active'     => is_plugin_active( 'divi-builder/divi-builder.php' ),
							'author_url' => esc_url( 'https://www.elegantthemes.com/gallery/divi/' ),
						],
					],
				),
				'neve-divi-cafe'         => array(
					'url'              => 'https://demo.themeisle.com/neve-cafe-dv/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-cafe-dv/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/06/neve-caffe-new-ss.jpg',
					'title'            => 'Coffee Shop',
					'external_plugins' => [
						[
							'name'       => 'Divi Builder',
							'active'     => is_plugin_active( 'divi-builder/divi-builder.php' ),
							'author_url' => esc_url( 'https://www.elegantthemes.com/gallery/divi/' ),
						],
					],
				),
				'neve-divi-fashion'      => array(
					'url'              => 'https://demo.themeisle.com/neve-fashion-dv/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-fashion-dv/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/07/neve-fashion-demo-screenshot.png',
					'title'            => 'Fashion',
					'external_plugins' => [
						[
							'name'       => 'Divi Builder',
							'active'     => is_plugin_active( 'divi-builder/divi-builder.php' ),
							'author_url' => esc_url( 'https://www.elegantthemes.com/gallery/divi/' ),
						],
					],
				),
				'neve-divi-job-listings' => array(
					'url'              => 'https://demo.themeisle.com/neve-job-listing-dv/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-job-listing-dv/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-job-listings.jpg',
					'title'            => 'Job Listing',
					'external_plugins' => [
						[
							'name'       => 'Divi Builder',
							'active'     => is_plugin_active( 'divi-builder/divi-builder.php' ),
							'author_url' => esc_url( 'https://www.elegantthemes.com/gallery/divi/' ),
						],
					],
				),
				'neve-divi-real-estate'  => array(
					'url'              => 'https://demo.themeisle.com/neve-real-estate-dv/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-real-estate-dv/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-real-estate.jpg',
					'title'            => 'Real Estate',
					'external_plugins' => [
						[
							'name'       => 'Divi Builder',
							'active'     => is_plugin_active( 'divi-builder/divi-builder.php' ),
							'author_url' => esc_url( 'https://www.elegantthemes.com/gallery/divi/' ),
						],
					],
				),
				'neve-divi-events'       => array(
					'url'              => 'https://demo.themeisle.com/neve-events-dv/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-events-dv/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-events.jpg',
					'title'            => 'Events',
					'external_plugins' => [
						[
							'name'       => 'Divi Builder',
							'active'     => is_plugin_active( 'divi-builder/divi-builder.php' ),
							'author_url' => esc_url( 'https://www.elegantthemes.com/gallery/divi/' ),
						],
					],
				),
				'neve-divi-farm'         => array(
					'url'              => 'https://demo.themeisle.com/neve-farm-dv/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-farm-dv/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-farm.jpg',
					'title'            => 'Farm',
					'external_plugins' => [
						[
							'name'       => 'Divi Builder',
							'active'     => is_plugin_active( 'divi-builder/divi-builder.php' ),
							'author_url' => esc_url( 'https://www.elegantthemes.com/gallery/divi/' ),
						],
					],
				),
				'neve-divi-kindergarten' => array(
					'url'              => 'https://demo.themeisle.com/neve-kindergarten-dv/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-kindergarten-dv/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-kindergarden.jpg',
					'title'            => 'Kindergarten',
					'external_plugins' => [
						[
							'name'       => 'Divi Builder',
							'active'     => is_plugin_active( 'divi-builder/divi-builder.php' ),
							'author_url' => esc_url( 'https://www.elegantthemes.com/gallery/divi/' ),
						],
					],
				),
				'neve-divi-speed'        => array(
					'url'              => 'https://demo.themeisle.com/neve-pro-dv/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-pro-dv/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/10/neve-speed.jpg',
					'title'            => 'Speed',
					'external_plugins' => [
						[
							'name'       => 'Divi Builder',
							'active'     => is_plugin_active( 'divi-builder/divi-builder.php' ),
							'author_url' => esc_url( 'https://www.elegantthemes.com/gallery/divi/' ),
						],
					],
				),
				'neve-divi-funnel'       => array(
					'url'              => 'https://demo.themeisle.com/neve-sales-funnel-dv/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-sales-funnel-dv/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/10/neve-sales.jpg',
					'title'            => 'Sales Funnel',
					'external_plugins' => [
						[
							'name'       => 'Divi Builder',
							'active'     => is_plugin_active( 'divi-builder/divi-builder.php' ),
							'author_url' => esc_url( 'https://www.elegantthemes.com/gallery/divi/' ),
						],
					],
				),
			),
			'beaver builder'   => array(
				'neve-beaver-cafe'                  => array(
					'url'              => 'https://demo.themeisle.com/neve-cafe-bb/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-cafe-bb/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/06/neve-caffe-new-ss.jpg',
					'title'            => 'Coffee Shop',
					'unsplash_gallery' => 'https://unsplash.com/collections/4587666/cafe',
				),
				'neve-beaver-constructions'         => array(
					'url'              => 'https://demo.themeisle.com/neve-constructions-bb/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-constructions-bb/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/06/neve-construction-new-screenshot.jpg',
					'title'            => 'Constructions Company',
					'unsplash_gallery' => 'https://unsplash.com/collections/4847783/construction',
				),
				'neve-beaver-fashion'               => array(
					'url'              => 'https://demo.themeisle.com/neve-bb-fashion/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-bb-fashion/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/07/neve-fashion-demo-screenshot.png',
					'title'            => 'Fashion',
					'unsplash_gallery' => 'https://unsplash.com/collections/4926520/fashion',
				),
				'neve-beaver-showcase'              => array(
					'url'              => 'https://demo.themeisle.com/neve-showcase-bb/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-showcase-bb/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-showcase-new.jpg',
					'title'            => 'Showcase',
					'unsplash_gallery' => 'https://unsplash.com/collections/4587690/showcase/ed70b13c3a6d1219334f193873aaad61',
				),
				'neve-beaver-consultants'           => array(
					'url'              => 'https://demo.themeisle.com/neve-consultants-bb/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-consultants-bb/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-business-consulting.jpg',
					'title'            => 'Business Consulting',
					'unsplash_gallery' => 'https://unsplash.com/collections/8366058/consultants',
				),
				'neve-beaver-job-listings'          => array(
					'url'              => 'https://demo.themeisle.com/neve-job-listings-bb/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-job-listings-bb/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-job-listings.jpg',
					'title'            => 'Job Listing',
					'unsplash_gallery' => 'https://unsplash.com/collections/8327271/job-listing',
				),
				'neve-beaver-barber-shop'           => array(
					'url'              => 'https://demo.themeisle.com/neve-barber-shop-bb',
					'remote_json'      => 'https://s20206.pcdn.co/neve-barber-shop-bb/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-barber-shop.jpg',
					'title'            => 'Barber Shop',
					'unsplash_gallery' => 'https://unsplash.com/collections/8357212/barber-shop',
				),
				'neve-beaver-personal-trainer'      => array(
					'url'              => 'https://demo.themeisle.com/neve-personal-trainer-bb/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-personal-trainer-bb/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-personal-trainer.jpg',
					'title'            => 'Personal Trainer',
					'unsplash_gallery' => 'https://unsplash.com/collections/8351250/personal-trainer/4f469c0cb610352567f5233410c61742',
				),
				'neve-beaver-real-estate'           => array(
					'url'              => 'https://demo.themeisle.com/neve-real-estate-bb/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-real-estate-bb/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-real-estate.jpg',
					'title'            => 'Real Estate',
					'unsplash_gallery' => 'https://unsplash.com/collections/8280384/real-estate',
				),
				'neve-beaver-events'                => array(
					'url'              => 'https://demo.themeisle.com/neve-events-bb/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-events-bb/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-events.jpg',
					'title'            => 'Events',
					'unsplash_gallery' => 'https://unsplash.com/collections/8311870/music-events',
				),
				'neve-beaver-photography-portfolio' => array(
					'url'              => 'https://demo.themeisle.com/neve-photography-portfolio-bb/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-photography-portfolio-bb/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-studio-photography.jpg',
					'title'            => 'Photography Studio',
					'unsplash_gallery' => 'https://unsplash.com/collections/4587698/photography-portfolio',
				),
				'neve-beaver-video-agency'          => array(
					'url'              => 'https://demo.themeisle.com/neve-video-agency-bb/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-video-agency-bb/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-vide-agency.jpg',
					'title'            => 'Video Agency',
					'unsplash_gallery' => 'https://unsplash.com/collections/4770565/video-agency',
				),
				'neve-beaver-furniture-shop'        => array(
					'url'              => 'https://demo.themeisle.com/neve-furniture-shop-bb/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-furniture-shop-bb/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-furniture-shop.jpg',
					'title'            => 'Furniture Shop',
					'unsplash_gallery' => 'https://unsplash.com/collections/8527065/furniture-shop',
				),
				'neve-beaver-portrait-photography'  => array(
					'url'              => 'https://demo.themeisle.com/neve-portrait-photopraphy-bb/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-portrait-photopraphy-bb/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-wedding-photography.jpg',
					'title'            => 'Wedding Photography',
					'unsplash_gallery' => 'https://unsplash.com/collections/4587751/portrait-wedding-photography',
				),
				'neve-beaver-farm'                  => array(
					'url'              => 'https://demo.themeisle.com/neve-farm-bb/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-farm-bb/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-farm.jpg',
					'title'            => 'Farm',
					'unsplash_gallery' => 'https://unsplash.com/collections/8509382/farm',
				),
				'neve-beaver-photographer'          => array(
					'url'              => 'https://demo.themeisle.com/neve-photography-bb/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-photography-bb/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-photographer.jpg',
					'title'            => 'Photographer',
					'unsplash_gallery' => 'https://unsplash.com/collections/8676181/neve-photography/d47fed0fbab045ca4c4636a01fe53c0d',
				),
				'neve-beaver-kindergarten'          => array(
					'url'              => 'https://demo.themeisle.com/neve-kindergarden-bb/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-kindergarden-bb/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-kindergarden.jpg',
					'title'            => 'Kindergarten',
					'unsplash_gallery' => 'https://unsplash.com/collections/8606727/kindergarten',
				),
				'neve-beaver-florist'               => array(
					'url'              => 'https://demo.themeisle.com/neve-florist-bb/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-florist-bb/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/10/neve-florist.jpg',
					'title'            => 'Florist',
					'unsplash_gallery' => 'https://unsplash.com/collections/8715558/neve-florist/f9106cdfcd1a7309bac7c606760d7918',
				),
				'neve-beaver-cake-shop'             => array(
					'url'              => 'https://demo.themeisle.com/neve-cake-shop-bb/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-cake-shop-bb/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/10/neve-cake-shop.jpg',
					'title'            => 'Cake Shop',
					'unsplash_gallery' => 'https://unsplash.com/collections/7772437/cakery-bakery/5f40022a676873e52e1dc76b113c5915',
				),
				'neve-beaver-transport'             => array(
					'url'              => 'https://demo.themeisle.com/neve-transport-bb/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-transport-bb/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/10/neve-transport.jpg',
					'title'            => 'Transport',
					'unsplash_gallery' => 'https://unsplash.com/collections/8333254/logistics',
				),
				'neve-beaver-ebook'                 => array(
					'url'              => 'https://demo.themeisle.com/neve-ebook-bb/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-ebook-bb/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/10/neve-ebook.jpg',
					'title'            => 'eBook',
					'unsplash_gallery' => 'https://unsplash.com/collections/8687501/neve-ebook/53451c76913e4e176e377c0208e2e755',
				),
				'neve-beaver-speed'                 => array(
					'url'              => 'https://demo.themeisle.com/neve-pro-bb/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-pro-bb/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/10/neve-speed.jpg',
					'title'            => 'Speed',
					'unsplash_gallery' => 'https://unsplash.com/collections/8698685/neve-pro',
				),
				'neve-beaver-food-magazine'         => array(
					'url'              => 'https://demo.themeisle.com/neve-food-magazine-bb/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-food-magazine-bb/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/10/neve-food-magazine.jpg',
					'title'            => 'Food Magazine',
					'unsplash_gallery' => 'https://unsplash.com/collections/8789337/neve-food-magazine',
				),
				'neve-beaver-web-design'            => array(
					'url'              => 'https://demo.themeisle.com/neve-web-design-bb/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-web-design-bb/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/10/neve-web-design.jpg',
					'title'            => 'eCourse - Web Design',
					'unsplash_gallery' => 'https://unsplash.com/collections/8778651/neve-web-design-course/e3a1b8568395786acef49c20929c5dce',
				),
				'neve-beaver-yoga-studio'           => array(
					'url'              => 'https://demo.themeisle.com/neve-yoga-studio-bb/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-yoga-studio-bb/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/10/neve-yoga.jpg',
					'title'            => 'Yoga Studio',
					'unsplash_gallery' => 'https://unsplash.com/collections/8778361/yoga-studio/fd02983f43e4d1b4f9ea9651d1fd8233',
				),
				'neve-beaver-sales-funnel'          => array(
					'url'              => 'https://demo.themeisle.com/neve-sales-funnel-bb/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-sales-funnel-bb/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/10/neve-sales.jpg',
					'title'            => 'Sales Funnel',
					'unsplash_gallery' => 'https://unsplash.com/collections/8758788/sales-funnel-1/ce1d2f6de0dab35699688bab193323d0',
				),
				'neve-beaver-church'                => array(
					'url'              => 'https://demo.themeisle.com/neve-church-bb/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-church-bb/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/10/neve-church.jpg',
					'title'            => 'Church',
					'unsplash_gallery' => 'https://unsplash.com/collections/8805198/neve-church/58329104fbc1dd6ea065330ee9749198',
				),
				'neve-beaver-fashion-magazine'      => array(
					'url'              => 'https://demo.themeisle.com/neve-fashion-magazine-bb/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-fashion-magazine-bb/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/10/neve-fashion-mag.jpg',
					'title'            => 'Fashion Magazine',
					'unsplash_gallery' => 'https://unsplash.com/collections/8815720/fashion-mag',
				),
				'neve-beaver-winery'                => array(
					'url'              => 'https://demo.themeisle.com/neve-winery-bb/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-winery-bb/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/11/neve-winery.png',
					'title'            => 'Winery - Wine Shop',
					'unsplash_gallery' => 'https://unsplash.com/collections/8821407/winery',
				),
				'neve-beaver-news-magazine'         => array(
					'url'              => 'https://demo.themeisle.com/neve-news-magazine-bb/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-news-magazine-bb/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/11/neve-news.jpg',
					'title'            => 'News Magazine',
					'unsplash_gallery' => 'https://unsplash.com/collections/8843126/news-magazine/87e04aee675f7288715a01a4c674d2fc',
				),
				'neve-beaver-coworking'             => array(
					'url'              => 'https://demo.themeisle.com/neve-coworking-bb/',
					'url'              => 'https://s20206.pcdn.co/neve-coworking-bb/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/11/neve-coworking.jpg',
					'title'            => 'Coworking Space',
					'unsplash_gallery' => 'https://unsplash.com/collections/8820504/coworking/f3c1ba01d1177d2e2c4caa75dbf3066d',
				),
				'neve-beaver-car-rental'            => array(
					'url'              => 'https://demo.themeisle.com/neve-car-rental-bb/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-car-rental-bb/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/11/neve-cart-rental.jpg',
					'title'            => 'Car Rental',
					'unsplash_gallery' => 'https://unsplash.com/collections/8826109/car-rental',
				),
				'neve-beaver-translation-services'  => array(
					'url'              => 'https://demo.themeisle.com/neve-translation-services-bb/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-translation-services-bb/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/11/neve-translations.jpg',
					'title'            => 'Translation and Interpreter Services',
					'unsplash_gallery' => 'https://unsplash.com/collections/8903458/translation-services/f2ba08f0cb507af6bb520cd5c9643c5d',
				),
				'neve-beaver-blogger'               => array(
					'url'              => 'https://demo.themeisle.com/neve-blogger-bb/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-blogger-bb/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/11/neve-blogger.jpg',
					'title'            => 'Blogger',
					'unsplash_gallery' => 'https://unsplash.com/collections/8936140/minimal-blog',
				),
				'neve-beaver-coupons'               => array(
					'url'              => 'https://demo.themeisle.com/neve-coupons-bb/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-coupons-bb/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/11/neve-coupons.jpg',
					'title'            => 'Coupons Discounts and Offers',
					'unsplash_gallery' => 'https://unsplash.com/collections/8936046/neve-coupons/2f70b203a4a269b514f5839826d21f61',
				),
				'neve-beaver-escape-room'           => array(
					'url'              => 'https://demo.themeisle.com/neve-escape-room-bb/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-escape-room-bb/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/11/neve-escape-room.jpg',
					'title'            => 'Escape Room',
					'unsplash_gallery' => 'https://unsplash.com/collections/8924433/escape-room/c3145a3aca8fafa22251b01b280c1dbf',
				),
			),
			'elementor'        => array(
				'neve-cafe'                  => array(
					'url'              => 'https://demo.themeisle.com/neve-cafe/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-cafe/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/06/neve-caffe-new-ss.jpg',
					'title'            => 'Coffee Shop',
					'unsplash_gallery' => 'https://unsplash.com/collections/4587666/cafe',
				),
				'neve-constructions'         => array(
					'url'              => 'https://demo.themeisle.com/neve-constructions/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-constructions/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/06/neve-construction-new-screenshot.jpg',
					'title'            => 'Constructions Company',
					'unsplash_gallery' => 'https://unsplash.com/collections/4847783/construction',
				),
				'neve-fashion'               => array(
					'url'              => 'https://demo.themeisle.com/neve-fashion/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-fashion/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/07/neve-fashion-demo-screenshot.png',
					'title'            => 'Fashion',
					'unsplash_gallery' => 'https://unsplash.com/collections/4926520/fashion',
				),
				'neve-showcase'              => array(
					'url'              => 'https://demo.themeisle.com/neve-showcase/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-showcase/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-showcase-new.jpg',
					'title'            => 'Showcase',
					'unsplash_gallery' => 'https://unsplash.com/collections/4587690/showcase/ed70b13c3a6d1219334f193873aaad61',
				),
				'neve-consultants'           => array(
					'url'              => 'https://demo.themeisle.com/neve-consultants/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-consultants/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-business-consulting.jpg',
					'title'            => 'Business Consulting',
					'unsplash_gallery' => 'https://unsplash.com/collections/8366058/consultants',
				),
				'neve-job-listings'          => array(
					'url'              => 'https://demo.themeisle.com/neve-job-listings/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-job-listings/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-job-listings.jpg',
					'title'            => 'Job Listing',
					'unsplash_gallery' => 'https://unsplash.com/collections/8327271/job-listing',
				),
				'neve-barber-shop'           => array(
					'url'              => 'https://demo.themeisle.com/neve-barber-shop/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-barber-shop/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-barber-shop.jpg',
					'title'            => 'Barber Shop',
					'unsplash_gallery' => 'https://unsplash.com/collections/8357212/barber-shop',
				),
				'neve-personal-trainer'      => array(
					'url'              => 'https://demo.themeisle.com/neve-personal-trainer/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-personal-trainer/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-personal-trainer.jpg',
					'title'            => 'Personal Trainer',
					'unsplash_gallery' => 'https://unsplash.com/collections/8351250/personal-trainer/4f469c0cb610352567f5233410c61742',
				),
				'neve-real-estate'           => array(
					'url'              => 'https://demo.themeisle.com/neve-real-estate/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-real-estate/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-real-estate.jpg',
					'title'            => 'Real Estate',
					'unsplash_gallery' => 'https://unsplash.com/collections/8280384/real-estate',
				),
				'neve-events'                => array(
					'url'              => 'https://demo.themeisle.com/neve-events/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-events/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/08/neve-events-demo.jpg',
					'title'            => 'Events',
					'unsplash_gallery' => 'https://unsplash.com/collections/8311870/music-events',
				),
				'neve-portrait-photography'  => array(
					'url'              => 'https://demo.themeisle.com/neve-portrait-photopraphy/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-portrait-photopraphy/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-wedding-photography.jpg',
					'title'            => 'Wedding Photography',
					'unsplash_gallery' => 'https://unsplash.com/collections/4587751/portrait-wedding-photography',
				),
				'neve-photography-portfolio' => array(
					'url'              => 'https://demo.themeisle.com/neve-photography-portfolio/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-photography-portfolio/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-studio-photography.jpg',
					'title'            => 'Photography Studio',
					'unsplash_gallery' => 'https://unsplash.com/collections/4587698/photography-portfolio',
				),
				'neve-video-agency'          => array(
					'url'              => 'https://demo.themeisle.com/video-agency/',
					'remote_json'      => 'https://s20206.pcdn.co/video-agency/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-vide-agency.jpg',
					'title'            => 'Video Agency',
					'unsplash_gallery' => 'https://unsplash.com/collections/4770565/video-agency',
				),
				'neve-furniture-shop'        => array(
					'url'              => 'https://demo.themeisle.com/neve-furniture-shop/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-furniture-shop/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-furniture-shop.jpg',
					'title'            => 'Furniture Shop',
					'unsplash_gallery' => 'https://unsplash.com/collections/8527065/furniture-shop',
				),
				'neve-farm'                  => array(
					'url'              => 'https://demo.themeisle.com/neve-farm/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-farm/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-farm.jpg',
					'title'            => 'Farm',
					'unsplash_gallery' => 'https://unsplash.com/collections/8509382/farm',
				),
				'neve-photographer'          => array(
					'url'              => 'https://demo.themeisle.com/neve-photography/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-photography/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-photographer.jpg',
					'title'            => 'Photographer',
					'unsplash_gallery' => 'https://unsplash.com/collections/8676181/neve-photography/d47fed0fbab045ca4c4636a01fe53c0d',
				),
				'neve-kindergarten'          => array(
					'url'              => 'https://demo.themeisle.com/neve-kindergarten/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-kindergarten/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-kindergarden.jpg',
					'title'            => 'Kindergarten',
					'unsplash_gallery' => 'https://unsplash.com/collections/8606727/kindergarten',
				),
				'neve-florist'               => array(
					'url'              => 'https://demo.themeisle.com/neve-florist/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-florist/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/10/neve-florist.jpg',
					'title'            => 'Florist',
					'unsplash_gallery' => 'https://unsplash.com/collections/8715558/neve-florist/f9106cdfcd1a7309bac7c606760d7918',
				),
				'neve-cake-shop'             => array(
					'url'              => 'https://demo.themeisle.com/neve-cake-shop/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-cake-shop/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/10/neve-cake-shop.jpg',
					'title'            => 'Cake Shop',
					'unsplash_gallery' => 'https://unsplash.com/collections/7772437/cakery-bakery/5f40022a676873e52e1dc76b113c5915',
				),
				'neve-transport'             => array(
					'url'              => 'https://demo.themeisle.com/neve-transport/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-transport/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/10/neve-transport.jpg',
					'title'            => 'Transport',
					'unsplash_gallery' => 'https://unsplash.com/collections/8333254/logistics',
				),
				'neve-ebook'                 => array(
					'url'              => 'https://demo.themeisle.com/neve-ebook/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-ebook/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/10/neve-ebook.jpg',
					'title'            => 'eBook',
					'unsplash_gallery' => 'https://unsplash.com/collections/8687501/neve-ebook/53451c76913e4e176e377c0208e2e755',
				),
				'neve-speed'                 => array(
					'url'              => 'https://demo.themeisle.com/neve-pro/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-pro/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/10/neve-speed.jpg',
					'title'            => 'Speed',
					'unsplash_gallery' => 'https://unsplash.com/collections/8698685/neve-pro',
				),
				'neve-food-magazine'         => array(
					'url'              => 'https://demo.themeisle.com/neve-food-magazine/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-food-magazine/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/10/neve-food-magazine.jpg',
					'title'            => 'Food Magazine',
					'unsplash_gallery' => 'https://unsplash.com/collections/8789337/neve-food-magazine',
				),
				'neve-web-design'            => array(
					'url'              => 'https://demo.themeisle.com/neve-web-design/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-web-design/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/10/neve-web-design.jpg',
					'title'            => 'eCourse - Web Design',
					'unsplash_gallery' => 'https://unsplash.com/collections/8778651/neve-web-design-course/e3a1b8568395786acef49c20929c5dce',
				),
				'neve-yoga-studio'           => array(
					'url'              => 'https://demo.themeisle.com/neve-yoga-studio/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-yoga-studio/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/10/neve-yoga.jpg',
					'title'            => 'Yoga Studio',
					'unsplash_gallery' => 'https://unsplash.com/collections/8778361/yoga-studio/fd02983f43e4d1b4f9ea9651d1fd8233',
				),
				'neve-sales-funnel'          => array(
					'url'              => 'https://demo.themeisle.com/neve-sales-funnel/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-sales-funnel/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/10/neve-sales.jpg',
					'title'            => 'Crypto - Sales Funnel',
					'unsplash_gallery' => 'https://unsplash.com/collections/8758788/sales-funnel-1/ce1d2f6de0dab35699688bab193323d0',
				),
				'neve-church'                => array(
					'url'              => 'https://demo.themeisle.com/neve-church/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-church/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/10/neve-church.jpg',
					'title'            => 'Church',
					'unsplash_gallery' => 'https://unsplash.com/collections/8805198/neve-church/58329104fbc1dd6ea065330ee9749198',
				),
				'neve-fashion-magazine'      => array(
					'url'              => 'https://demo.themeisle.com/neve-fashion-magazine/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-fashion-magazine/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/10/neve-fashion-mag.jpg',
					'title'            => 'Fashion Magazine',
					'unsplash_gallery' => 'https://unsplash.com/collections/8815720/fashion-mag',
				),
				'neve-winery'                => array(
					'url'              => 'https://demo.themeisle.com/neve-winery/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-winery/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/11/neve-winery.png',
					'title'            => 'Winery - Wine Shop',
					'unsplash_gallery' => 'https://unsplash.com/collections/8821407/winery',
				),
				'neve-news-magazine'         => array(
					'url'              => 'https://demo.themeisle.com/neve-news-magazine/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-news-magazine/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/11/neve-news.jpg',
					'title'            => 'News Magazine',
					'unsplash_gallery' => 'https://unsplash.com/collections/8843126/news-magazine/87e04aee675f7288715a01a4c674d2fc',
				),
				'neve-coworking'             => array(
					'url'              => 'https://demo.themeisle.com/neve-coworking/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-coworking/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/11/neve-coworking.jpg',
					'title'            => 'Coworking Space',
					'unsplash_gallery' => 'https://unsplash.com/collections/8820504/coworking/f3c1ba01d1177d2e2c4caa75dbf3066d',
				),
				'neve-fishing-club'          => array(
					'url'              => 'https://demo.themeisle.com/neve-fishing-club/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-fishing-club/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/11/neve-fishing.jpg',
					'title'            => 'Fishing and Hunting Club',
					'unsplash_gallery' => 'https://unsplash.com/collections/8868787/hunting-and-fishing/6f67a5235958b49102a57b3c9364e5cf',
				),
				'neve-car-rental'            => array(
					'url'              => 'https://demo.themeisle.com/neve-car-rental/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-car-rental/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/11/neve-cart-rental.jpg',
					'title'            => 'Car Rental',
					'unsplash_gallery' => 'https://unsplash.com/collections/8826109/car-rental',
				),
				'neve-ski-resort'            => array(
					'url'              => 'https://demo.themeisle.com/neve-ski-resort/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-ski-resort/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/11/sky-resort.jpg',
					'title'            => 'Ski Resort Winter Hotel',
					'unsplash_gallery' => 'https://unsplash.com/collections/8869398/ski-resort/66f972e2406deafd52d439b5a32f76fd',
				),
				'neve-digital-product'       => array(
					'url'              => 'https://demo.themeisle.com/neve-digital-product-funnel/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-digital-product-funnel/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/11/neve-digital-product.jpg',
					'title'            => 'Digital Product Funnel',
					'unsplash_gallery' => 'https://unsplash.com/collections/8869329/digital-product',
				),
				'neve-moving-company'        => array(
					'url'              => 'https://demo.themeisle.com/neve-moving-company/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-moving-company/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/11/neve-moving-company.jpg',
					'title'            => 'Moving Company Logistics Services',
					'unsplash_gallery' => 'https://unsplash.com/collections/8907717/moving-company/9274ab9f8d8de88bcdea5d79598e80e4',
				),
				'neve-translation-services'  => array(
					'url'              => 'https://demo.themeisle.com/neve-translation-services/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-translation-services/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/11/neve-translations.jpg',
					'title'            => 'Translation and Interpreter Services',
					'unsplash_gallery' => 'https://unsplash.com/collections/8903458/translation-services/f2ba08f0cb507af6bb520cd5c9643c5d',
				),
				'neve-blogger'               => array(
					'url'              => 'https://demo.themeisle.com/neve-blogger/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-blogger/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/11/neve-blogger.jpg',
					'title'            => 'Blogger',
					'unsplash_gallery' => 'https://unsplash.com/collections/8936140/minimal-blog',
				),
				'neve-coupons'               => array(
					'url'              => 'https://demo.themeisle.com/neve-coupons/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-coupons/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/11/neve-coupons.jpg',
					'title'            => 'Coupons Discounts and Offers',
					'unsplash_gallery' => 'https://unsplash.com/collections/8936046/neve-coupons/2f70b203a4a269b514f5839826d21f61',
				),
				'neve-escape-room'           => array(
					'url'              => 'https://demo.themeisle.com/neve-escape-room/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-escape-room/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/11/neve-escape-room.jpg',
					'title'            => 'Escape Room',
					'unsplash_gallery' => 'https://unsplash.com/collections/8924433/escape-room/c3145a3aca8fafa22251b01b280c1dbf',
				),
				'neve-cv'                    => array(
					'url'              => 'https://demo.themeisle.com/neve-cv/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-cv/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/12/neve-resume.jpg',
					'title'            => 'Resume',
					'unsplash_gallery' => 'https://unsplash.com/collections/8972123/neve-resume-cv/ac3c66b0b032068b43bbd37d8dccbb46',
				),
				'neve-wellness'              => array(
					'url'              => 'https://demo.themeisle.com/neve-wellness/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-wellness/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/12/neve-wellness.jpg',
					'title'            => 'Wellness Spa',
					'unsplash_gallery' => 'https://unsplash.com/collections/8924925/wellness-and-spa/8c130f9a4809a74e12a9dfe5d1579af8',
				),
				'neve-courses'               => array(
					'url'              => 'https://demo.themeisle.com/neve-courses/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-courses/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/12/neve-courses.jpg',
					'title'            => 'Online Courses',
					'unsplash_gallery' => 'https://unsplash.com/collections/8983337/neve-courses/23700703215f81990fe9ad618b886ae3',
				),
				'neve-model-agency'          => array(
					'url'              => 'https://demo.themeisle.com/neve-model-agency/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-model-agency/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/12/neve-model-agency.jpg',
					'title'            => 'Fashion Model Agency',
					'unsplash_gallery' => 'https://unsplash.com/collections/9037292/fashion-agency',
				),
				'neve-it-company'            => array(
					'url'              => 'https://demo.themeisle.com/neve-it-company/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-it-company/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/12/neve-it-solution.jpg',
					'title'            => 'IT Technology Agency',
					'unsplash_gallery' => 'https://unsplash.com/collections/8907927/it-solutions/5b5c3086b3dcc45a5d3f2c98188e261a',
				),
				'neve-christmas-market'      => array(
					'url'              => 'https://demo.themeisle.com/neve-christmas-market/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-christmas-market/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/12/neve-christmas.jpg',
					'title'            => 'Christmas Market',
					'unsplash_gallery' => 'https://unsplash.com/collections/8992903/christmas-market/925e60bcf54eed468b3f80adb515008d',
				),
				'neve-podcast'               => array(
					'url'              => 'https://demo.themeisle.com/neve-podcast/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-podcast/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/12/neve-podcast.jpg',
					'title'            => 'Podcast',
					'unsplash_gallery' => 'https://unsplash.com/collections/8984175/neve-podcast/15ccb231f732a4a157321544c8e771fc',
				),
				'neve-digital-agency'        => array(
					'url'              => 'https://demo.themeisle.com/neve-digital-agency/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-digital-agency/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/12/neve-digital-agency.jpg',
					'title'            => 'Digital Agency',
					'unsplash_gallery' => 'https://unsplash.com/collections/9015394/neve-digital-agency/c794fcd505d0ac7fe2134479c3b8f670',
				),
			),
			'brizy'            => array(
				'neve-brizy-cafe'                 => array(
					'url'              => 'https://demo.themeisle.com/neve-cafe-brizy/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-cafe-brizy/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/06/neve-caffe-new-ss.jpg',
					'title'            => 'Coffee Shop',
					'unsplash_gallery' => 'https://unsplash.com/collections/4587666/cafe',
				),
				'neve-brizy-constructions'        => array(
					'url'              => 'https://demo.themeisle.com/neve-constructions-brizy/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-constructions-brizy/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/06/neve-construction-new-screenshot.jpg',
					'title'            => 'Constructions Company',
					'unsplash_gallery' => 'https://unsplash.com/collections/4847783/construction',
				),
				'neve-brizy-fashion'              => array(
					'url'              => 'https://demo.themeisle.com/neve-fashion-brizy/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-fashion-brizy/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/07/neve-fashion-demo-screenshot.png',
					'title'            => 'Fashion',
					'unsplash_gallery' => 'https://unsplash.com/collections/4926520/fashion',
				),
				'neve-brizy-showcase'             => array(
					'url'              => 'https://demo.themeisle.com/neve-showcase-brizy/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-showcase-brizy/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-showcase-new.jpg',
					'title'            => 'Showcase',
					'unsplash_gallery' => 'https://unsplash.com/collections/4587690/showcase/ed70b13c3a6d1219334f193873aaad61',
				),
				'neve-brizy-consultants'          => array(
					'url'              => 'https://demo.themeisle.com/neve-consultants-brizy/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-consultants-brizy/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-business-consulting.jpg',
					'title'            => 'Business Consulting',
					'unsplash_gallery' => 'https://unsplash.com/collections/8366058/consultants',
				),
				'neve-brizy-job-listings'         => array(
					'url'              => 'https://demo.themeisle.com/neve-job-listings-brizy/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-job-listings-brizy/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-job-listings.jpg',
					'title'            => 'Job Listing',
					'unsplash_gallery' => 'https://unsplash.com/collections/8327271/job-listing',
				),
				'neve-brizy-barber-shop'          => array(
					'url'              => 'https://demo.themeisle.com/neve-barber-shop-brizy/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-barber-shop-brizy/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-barber-shop.jpg',
					'title'            => 'Barber Shop',
					'unsplash_gallery' => 'https://unsplash.com/collections/8357212/barber-shop',
				),
				'neve-brizy-personal-traner'      => array(
					'url'              => 'https://demo.themeisle.com/neve-personal-trainer-brizy/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-personal-trainer-brizy/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-personal-trainer.jpg',
					'title'            => 'Personal Trainer',
					'unsplash_gallery' => 'https://unsplash.com/collections/8351250/personal-trainer/4f469c0cb610352567f5233410c61742',
				),
				'neve-brizy-real-estate'          => array(
					'url'              => 'https://demo.themeisle.com/neve-real-estate-brizy/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-real-estate-brizy/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-real-estate.jpg',
					'title'            => 'Real Estate',
					'unsplash_gallery' => 'https://unsplash.com/collections/8280384/real-estate',
				),
				'neve-brizy-events'               => array(
					'url'              => 'https://demo.themeisle.com/neve-events-brizy/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-events-brizy/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-events.jpg',
					'title'            => 'Events',
					'unsplash_gallery' => 'https://unsplash.com/collections/8311870/music-events',
				),
				'neve-brizy-portrait-photopraphy' => array(
					'url'              => 'https://demo.themeisle.com/neve-portrait-photography-brizy/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-portrait-photography-brizy/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-wedding-photography.jpg',
					'title'            => 'Wedding Photography',
					'unsplash_gallery' => 'https://unsplash.com/collections/4587751/portrait-wedding-photography',
				),
				'neve-brizy-furniture-shop'       => array(
					'url'              => 'https://demo.themeisle.com/neve-furniture-shop-brizy/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-furniture-shop-brizy/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-furniture-shop.jpg',
					'title'            => 'Furniture Shop',
					'unsplash_gallery' => 'https://unsplash.com/collections/8527065/furniture-shop',
				),
				'neve-brizy-farm'                 => array(
					'url'              => 'https://demo.themeisle.com/neve-farm-brizy/',
					'remote_json'      => 'https://s20206.pcdn.co/neve-farm-brizy/',
					'screenshot'       => 'https://demo.themeisle.com/hestia-pro-demo-content/wp-content/uploads/sites/105/2019/09/neve-farm.jpg',
					'title'            => 'Farm',
					'unsplash_gallery' => 'https://unsplash.com/collections/8509382/farm',
				),
			),
		);
		$addon_starter_sites  = array_merge_recursive( $starter_sites['remote'], $remote_starter_sites );

		$starter_sites['remote'] = $addon_starter_sites;

		return $starter_sites;
	}
}
