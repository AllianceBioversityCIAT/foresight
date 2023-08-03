<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/static/images/favicon.png" sizes="32x32" />
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/static/images/favicon-180x180.png" />
	<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/static/images/favicon-270x270.png" />
	<?php wp_head(); ?>
</head>
<body class="w-full min-w-[320px]">



<nav class="bg-white fixed w-full z-20 top-0 left-0">
		<div class="max-w-screen-2xl flex flex-wrap items-center justify-between mx-auto">
			<a href="#" class="flex items-center">
				<img class="h-20 p-2" src="<?= get_template_directory_uri() ?>/static/images/foresight-logo-dark.png" alt="logo">
			</a>
			<div class="flex px-4 lg:order-2">
				<div class="hidden lg:flex">
					<ul class="flex flex-row gap-2.5 items-center justify-center">
						<li><a href="#" class="fa-brands fa-linkedin-in fa-lg text-green"></a></li>
						<li><a href="#" class="fa-brands fa-twitter fa-lg text-green"></a></li>
						<li><a href="#" class="fa-brands fa-facebook-f fa-lg text-green"></a></li>
					</ul>
				</div>


				<button data-collapse-toggle="navbar-dropdown2" type="button" class="relative group p-1 rounded-lg lg:hidden hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-gray-100" aria-controls="navbar-dropdown" aria-expanded="false" onclick="this.classList.toggle('open-menu');this.setAttribute('aria-expanded', this.classList.contains('open-menu'))">
					<span class="sr-only">Open main menu</span>
					<div class="flex overflow-hidden items-center justify-center w-[28px] h-[28px]">
						<div class="text-black flex flex-col justify-between w-[20px] h-[20px] transform transition-all duration-300 origin-center overflow-hidden">
							<i class="bg-black h-[2px] w-7 transform transition-all duration-300 origin-left group-[.open-menu]:rotate-[42deg]"></i>
							<i class="bg-black h-[2px] w-7 transform transition-all duration-300 group-[.open-menu]:-translate-x-10"></i>
							<i class="bg-black h-[2px] w-7 transform transition-all duration-300 group-[.open-menu]:-translate-x-10"></i>
							<i class="bg-black h-[2px] w-7 transform transition-all duration-300 origin-left group-[.open-menu]:-rotate-[42deg]"></i>
						</div>
					</div>
				</button>
			</div>
			

			<div class="items-center justify-between border-gray lg:border-none border-t hidden w-full lg:flex lg:w-auto lg:order-1" id="navbar-dropdown2">
				<!-- Main Menu -->
				<ul class="flex flex-col font-bold px-2 lg:p-0 mt-4 lg:flex-row lg:space-x-8">
					<li>
						<a href="#" class="block py-2 pl-3 pr-4 text-black lg:p-0" aria-current="page">
							Home
						</a>
					</li>
					<li>
						<button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center justify-between py-2 pl-3 pr-4 lg:p-0 lg:w-auto text-black">
							Dropdown 
							<svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
								<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
							</svg>
						</button>
						<!-- Dropdown -->
						<div id="dropdownNavbar" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 shadow w-48">
							<ul class="py-2 text-sm text-black" aria-labelledby="dropdownLargeButton">
								<li>
									<a href="#" class="block px-4 py-2 hover:bg-gray-100">Option 1</a>
								</li>
								<li>
									<a href="#" class="block px-4 py-2 hover:bg-gray-100">Option 2</a>
								</li>
								<li>
									<a href="#" class="block px-4 py-2 hover:bg-gray-100">Option 3</a>
								</li>
							</ul>
						</div>
					</li>
					<li>
						<a href="#" class="block py-2 pl-3 pr-4 text-black lg:p-0" aria-current="page">
							Login
						</a>
					</li>
					<li>
						<a href="#" class="block py-2 pl-3 pr-4 text-black lg:p-0" aria-current="page">
							Contact Us
						</a>
					</li>
				</ul>

				<!-- Social Menu -->
				<div class="flex bg-black lg:hidden">
					<ul class="bg-black flex my-10 px-4 gap-5">
						<li><a href="#" class="fa-brands fa-linkedin-in fa-lg text-green"></a></li>
						<li><a href="#" class="fa-brands fa-twitter fa-lg text-green"></a></li>
						<li><a href="#" class="fa-brands fa-facebook-f fa-lg text-green"></a></li>
					</ul>
				</div>
			</div>
		</div>
</nav>

<!-- Hero -->
<section class="h-screen flex flex-col pt-20 3xl:container 3xl:mx-auto">
	<div class="px-20 lg:px-44 flex flex-1 items-center justify-center lg:justify-start bg-center bg-cover bg-no-repeat bg-[url('https://devcgforesight.wpengine.com/wp-content/uploads/2023/08/hero-image.jpeg')] bg-black-100/70 bg-blend-multiply">
		<h1 class="font-montserrat font-extrabold text-yellow-primary px-1 break-words lg:text-left text-[40px] lg:text-[55px] text-center">Foresight Portal</h1>
	</div>
	<div class="bg-black text-white h-32 3xl:container 3xl:mx-auto hidden lg:flex">
		SUBMENU
	</div>
</section>

<?php

	if ( class_exists( 'Timber' ) ) {

		$context = Timber::context();
		$context[ 'frontPage' ] = new Timber\Post();

		Timber::render( './view/front-page.twig', $context );

	} else {
		echo '<h1>Timber plugin is required</h1>';
	}

wp_footer();

?>
</body>
</html>

