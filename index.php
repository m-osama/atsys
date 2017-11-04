<?php handle_post_submission(); ?>
<?php get_header(); ?>

<h3>Check in / out</h3>
<form action="" method="post">
	<?php if ( $pending_checkin = get_user_current_checkin() ): ?>
        You're now check-ed in <?php echo wp_list_pluck( wp_get_post_terms( $pending_checkin->ID, 'location' ), 'name' )[0] ?>
        <br/>
        <input type="submit" name="action" value="Check out"/>
	<?php else: ?>
		<?php wp_dropdown_categories( [
			'name'         => 'location',
			'hierarchical' => true,
			'taxonomy'     => 'location',
			'hide_empty'   => false,
		] ); ?>

        <input type="submit" name="action" value="Check in">
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
        <th>Checkins</th>
        <th>Covering</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ( get_location_coverage() as $location_id => $location ): ?>
    <tr>
        <td><?php echo $location['location']->name ?></td>
        <td><?php echo count( $location['members'] ) ?></td>
        <td><?php echo count( $location['covering'] ) ?></td>
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

