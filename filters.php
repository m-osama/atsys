
Sort <a href="<?php echo add_query_arg( 'order', 'asc' ); ?>">ASC</a> or <a
        href="<?php echo add_query_arg( 'order', 'desc' ); ?>">DESC</a>

Month:
<select name="monthnum" id="monthnum" class="follow-url">
	<?php for ( $i = 1; $i <= 12; $i ++ ): ?>
        <option <?php selected( $i, get_query_var( 'monthnum' ) ?: getdate()['mon'] ) ?> value="<?php echo add_query_arg( 'monthnum', $i ); ?>"><?php echo $i ?></option>
	<?php endfor; ?>
</select>

Year:
<select name="year" id="year" class="follow-url">
	<?php $year = getdate()['year'];
	for ( $i = $year - 2; $i <= $year + 2; $i ++ ): ?>
        <option <?php selected( $i, get_query_var( 'year' ) ?: getdate()['year'] ) ?> value="<?php echo add_query_arg( 'year', $i ); ?>"><?php echo $i ?></option>
	<?php endfor; ?>
</select>

Employee:
<select name="year" id="year" class="follow-url">
	<?php $employees = get_employees();
	/** @var $employee \WP_User */
	foreach ( $employees as  $employee ): ?>
        <option <?php selected( $employee->ID, get_query_var( 'employee' ) ) ?> value="<?php echo add_query_arg( 'employee', $employee->ID ); ?>"><?php echo $employee->display_name ?></option>
	<?php endforeach; ?>
</select>

<script>
	document.addEventListener( 'change', event => {
		if ( event.target.classList.contains( 'follow-url' ) ) {
			window.location.href = event.target.value
		}
	} );
</script>
