<div class="employees">
	<ul>
		<?php foreach ( $employees as $employee ) : ?>
		<li>
			<a href="?page=view&id=<?php echo $employee->id ?>">
				<?php echo $employee->name ?>
			</a>
		</li>
		<?php endforeach ?>
	</ul>
</div>