<?php get_header(); ?>

<table>
    <thead>
    <tr>
        <th>Location</th>
        <th>Check-in</th>
        <th>Check-out</th>
    </tr>
    </thead>
    <tbody>
	<?php while ( have_posts() ): the_post(); ?>
        <tr>
            <td><?php echo wp_get_post_terms( get_the_ID(), 'location' )[0]->name ?></td>
            <td><?php echo date( 'd/m/Y h:ia', get_post()->checkin ) ?></td>
            <td><?php echo get_post()->checkout ? date( 'd/m/Y h:ia', get_post()->checkout ) : '-' ?></td>
        </tr>
	<?php endwhile; ?>
    </tbody>
</table>

<?php get_template_part( 'filters' ); ?>

<?php get_footer(); ?>
