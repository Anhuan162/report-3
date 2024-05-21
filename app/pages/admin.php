<?php


if(!is_admin()){
	$section = $URL[1] ?? "home";
	$action = $URL[2] ?? null;
	$id = $URL[3] ?? null;

	switch ($section) {
		case 'home':
			require page('home');
			break;

		case 'music':
			require page('music');
			break;

		case 'category':
			require page('category');
			break;

		case 'artists':
			require page('artists');
			break;
		
		
		case 'about':
			require page('about');
			break;

		case 'contact':
			require page('contact');
			break;
		
		default:
			require page('404');
			break;
	}
}

else {
	$section = $URL[1] ?? "dashboard";
	$action = $URL[2] ?? null;
	$id = $URL[3] ?? null;

	switch ($section) {
		case 'dashboard':
			require page('admin/dashboard');
			break;

		case 'users':
			require page('admin/users');
			break;

		case 'categories':
			require page('admin/categories');
			break;

		case 'artists':
			require page('admin/artists');
			break;
		
		
		case 'songs':
			require page('admin/songs');
			break;
		
		default:
			require page('admin/404');
			break;
	}
}




?>





	