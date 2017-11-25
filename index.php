<?php handle_post_submission(); ?>
<?php get_header(); ?>

<h3>Check in / out</h3>
<form action="" method="post">
	<?php if ( $pending_checkin = get_user_current_checkin() ): ?>
        You're now check-ed in <?php echo wp_list_pluck( wp_get_post_terms( $pending_checkin->ID, 'location' ), 'name' )[0] ?>
        <br/>
        <input type="submit" name="action" value="Check out"/>
	<?php else: ?>
        <?php do_action( 'user_checkin_form' ); ?>
		<?php wp_dropdown_categories( [
			'name'         => 'location',
			'hierarchical' => true,
			'taxonomy'     => 'location',
            'class'        => 'select2',
			'hide_empty'   => false,
		] ); ?>
        <script src="<?php echo get_template_directory_uri(); ?>/assets/checkin.js"></script>
        <input type="hidden" name="gps" id="gps">

        <input type="submit" id="checkin" name="action" value="Check in" disabled>
        <?php do_action( 'end_user_checkin_form' ); ?>
	<?php endif; ?>
</form>

<h3>Jump to location</h3>
<?php wp_dropdown_categories( [
	'name'         => 'location_jump',
	'hierarchical' => true,
	'taxonomy'     => 'location',
	'hide_empty'   => false,
    'value_field'  => 'link',
    'walker' => new Location_Dropdown_Link_Walker()
] ); ?>


<script>
	document.addEventListener( 'change', event => {
		if ( event.target.name == 'location_jump' ) {
			window.location.href = event.target.value;
		}
	} );
</script>

<h3>Locations covered</h3>
<table>
    <thead>
    <tr>
        <th>Location</th>
        <th>People</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ( get_location_coverage() as $location_id => $location ): if ( ! count( $location['covering'] ) ) continue; ?>
    <tr>
        <td><?php echo $location['location']->name ?></td>
        <td><?php echo implode( ', ', wp_list_pluck( $location['covering'], 'display_name' ) ) ?></td>
    </tr>
    <?php endforeach ?>
    </tbody>
</table>

<script>
	document.addEventListener( 'change', event => {
		if ( event.target.name == 'location_jump' ) {
			window.location.href = event.target.value;
		}
	} );
</script>


<?php get_footer(); ?>

