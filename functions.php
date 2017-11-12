<?php

add_action( 'template_redirect', function () {
	if ( ! is_user_logged_in() ) {
		wp_redirect( site_url( 'wp-login.php' ) );
	}
} );

add_action( 'init', function () {

	register_post_type( 'checkin', [
		'label'    => 'Checkin',
		'public'   => true,
		'has_archive' => true,
		'supports' => [ 'author' ],
	] );

	register_taxonomy( 'location', 'checkin', [
		'label'             => 'Location',
		'public'            => true,
		'hierarchical'      => true,
		'show_admin_column' => true,
	] );
} );

add_action( 'fm_post_checkin', function () {
	$fm = new Fieldmanager_Group( [
		'name'     => 'checkin',
		'serialize_data' => false,
		'add_to_prefix' => false,
		'children' => [
			'name'     => new Fieldmanager_Select( 'Location', [
				'datasource' => new Fieldmanager_Datasource_Term( [
					'taxonomy'              => 'location',
					'taxonomy_hierarchical' => true,
				] ),
			] ),
			'gps'      => new Fieldmanager_Textfield( 'GPS' ),
			'checkin'  => new Fieldmanager_Datepicker( 'Check-in time', [ 'use_time' => true, 'default_value' => time() ] ),
			'checkout' => new Fieldmanager_Datepicker( 'Check-out time', [ 'use_time' => true ] ),
		],
	] );
	$fm->add_meta_box( 'Checkin Information', 'checkin' );
} );

add_action( 'fm_user', function () {
	$fm = new Fieldmanager_Group( [
		'name' => 'employee',
		'serialize_data' => false,
		'add_to_prefix' => false,
		'children' => [
			'position'     => new Fieldmanager_Select( 'Position', [
				'options' => [
					'member' => 'Team Member',
					'lead' => 'Team Lead',
					'manager' => 'Manager',
				],
			] ),
			'lead' => new Fieldmanager_Select( 'Lead', [
				'datasource' => new Fieldmanager_Datasource_User(),
			]),
			'hiring_date' => new Fieldmanager_Datepicker( 'Hiring Date' ),
			'company_id' => new Fieldmanager_TextField( 'Company ID' ),
		],
	] );

	if ( current_user_can( 'manage_options' ) ) {
		$fm->add_user_form( 'Employee Information' );
	}
} );

function get_user_current_checkin() {
	$user_id = get_current_user_id();
	$today = getdate();

	$posts = get_posts([
		'post_type' => 'checkin',
		'author' => intval( $user_id ),
		'date_query' => [
			[
				'year'  => $today['year'],
				'month' => $today['mon'],
				'day'   => $today['mday'],
			],
		],
		'meta_query' => [
			[
				'key' => 'checkout',
				'value' => '',
			],
		],
	]);

	if ( $posts ) {
		return current( $posts );
	} else {
		return false;
	}
}

function handle_post_submission() {
	if ( empty( $_POST ) ) {
		return;
	}

	$action = filter_input( INPUT_POST, 'action' );

	if ( $checkin = get_user_current_checkin() ) {
		if ( $action === 'Check out' ) {
			update_post_meta( $checkin->ID, 'checkout', time() );
		} else {
			wp_die( 'Invalid operation.' );
		}
	} elseif ( $action === 'Check in' ) {
		$location = filter_input( INPUT_POST, 'location', FILTER_SANITIZE_NUMBER_INT );
		$post_id = wp_insert_post( [
			'post_type' => 'checkin',
			'post_status' => 'publish',
			'meta_input' => [
				'checkin' => time(),
				'checkout' => '',
			],
		] );
		if ( $post_id && ! is_wp_error( $post_id ) ) {
			wp_set_post_terms( $post_id, $location, 'location' );
		}
	}
}

add_action( 'pre_get_posts', function( \WP_Query $query ) {
	if ( ! $query->is_main_query() ) {
		return;
	}
	if ( is_post_type_archive('checkin')  ) {
		$employee = get_query_var( 'employee', get_current_user_id() );

		if ( $employee !== get_current_user_id() && ! current_user_can( 'view-checkins', $employee ) ) {
			wp_die( 'O2mor ya 3asal' );
		}
		$query->set( 'author', $employee );
	}

	if ( is_tax( 'location' ) ) {
		$query->set( 'author__in', wp_list_pluck( get_employees(), 'ID' ) );
	}
});

function get_employees() {

	$query = [];

	$user_id = get_current_user_id();
	$position = get_user_meta( $user_id, 'position', true );

	if ( user_can( $user_id, 'manage_options' ) || 'manager' === $position ) {
		$query['meta_key'] = 'position';
	} elseif ( 'lead' === $position ) {
		$query['meta_query'][] = [
			'meta_key' => 'lead',
			'meta_value' => $user_id,
		];
	}

	$user_query = new WP_User_Query( $query );
	return $user_query->get_results();
}

add_filter( 'map_meta_cap', function( $caps, $cap, $user_id, $args ) {
	if ( 'view-checkins' !== $cap ) {
		return $caps;
	}

	$position = get_user_meta( $user_id, 'position', true );

	if ( user_can( $user_id, 'manage_options' ) ) {
		$caps = [ 'exist' ];
	} elseif ( 'manager' === $position ) { // Managers can see it all
		$caps = [ 'exist' ];
	} elseif ( 'lead' === $position ) { // Leads only see their team's
		$employee = $args[0];
		$lead = get_user_meta( $employee, 'lead', true );
		if ( $user_id == $lead ) {
			$caps = [ 'exist' ];
		}
	}

	return $caps;
}, 10, 4 );

add_filter( 'query_vars', function( $vars ) {
	$vars[] = 'employee';
	return $vars;
});

add_action( 'init', function(){
	if ( ! current_user_can( 'manage_options' ) ) {
		show_admin_bar( false );
	}
});

remove_action('template_redirect', 'redirect_canonical');

class Location_Dropdown_Link_Walker extends Walker_CategoryDropdown {
	public function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
			$pad = str_repeat('&nbsp;', $depth * 3);

			/** This filter is documented in wp-includes/category-template.php */
			$cat_name = apply_filters( 'list_cats', $category->name, $category );

			if ( isset( $args['value_field'] ) && ( 'link' === $args['value_field'] || isset( $category->{$args['value_field']} ) ) ) {
				$value_field = $args['value_field'];
			} else {
				$value_field = 'term_id';
			}

			if ( 'link' === $value_field ) {
				$value = get_term_link( $category, $args[ 'taxonomy'] );
			} else {
				$value = esc_attr( $category->{$value_field} );
			}

			$output .= "\t<option class=\"level-$depth\" value=\"" . $value . "\"";

			// Type-juggling causes false matches, so we force everything to a string.
			if ( (string) $category->{$value_field} === (string) $args['selected'] )
				$output .= ' selected="selected"';
			$output .= '>';
			$output .= $pad.$cat_name;
			if ( $args['show_count'] )
				$output .= '&nbsp;&nbsp;('. number_format_i18n( $category->count ) .')';
			$output .= "</option>\n";
		}
}

function get_location_coverage() {
	$locations = get_terms( ['taxonomy' => 'location', 'hide_empty' => false ]);
	$coverage = [];
	foreach ( $locations as $location ) {
		$checkins = get_posts([
			'post_type' => 'checkin',
			'tax_query' => [
				[
					'taxonomy' => 'location',
					'terms' => [ $location->term_id ],
					'field' => 'term_id',
				],
			],
			'post_status' => 'publish',
			'date_query' => [
				[
					'year' => getdate()['year'],
					'monthnum' => getdate()['mon'],
					'day' => getdate()['mday'],
				]
			]
		]);
		$members = array_map( function ( $post ) { return get_user_by( 'ID', $post->post_author ); }, $checkins );
		$members_still = array_filter( $checkins, function ( $post ) { return '' == $post->checkout; } );
		$covering = array_map( function ( $post ) { return get_user_by( 'ID', $post->post_author ); }, $members_still );

		$coverage[ $location->term_id ] = [
			'location' => $location,
			'checkins' => $checkins,
			'members' => $members,
			'covering' => $covering,
		];
	}

	return $coverage;
}
