<?php

include 'views/header.php';
switch( $_GET['page'] ) {
	case 'themes':
		include 'views/themes.php';
		
		break;
	case 'upload':
		include 'views/update.php';
		
		break;
	default:
		include 'home.php';
}
include 'views/footer.php';