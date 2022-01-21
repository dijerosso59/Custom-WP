<?php

// Fonction indiquant ce que mon thème supporte
function luca_supports () {

    // Titre dynamique dans le header
    add_theme_support('title-tag');

    // Image mise en avant
    add_theme_support('post-thumbnails');

    // Gestion des menus
    add_theme_support('menus');

    // Emplacement du menu de navigation
    register_nav_menu('header', 'En tête du menu');

    // Emplacement du menu du footer
    register_nav_menu('footer', 'Pied de page');

    add_theme_support('woocommerce');
}

// Fonction ajout assets CSS et JS
function luca_assets () {

    wp_register_style('aos.css', 'https://unpkg.com/aos@2.3.1/dist/aos.css');

    wp_register_script('aos.js', 'https://unpkg.com/aos@2.3.1/dist/aos.js', [], false, true);

    wp_enqueue_style('aos.css');
    wp_enqueue_style('style', get_stylesheet_uri());

    wp_enqueue_script('aos.js');
    wp_enqueue_script("script.js", get_template_directory_uri() . "/assets/script.js", ["aos.js", "jquery"], false, true);
}

// Fonction ajout class li menu
function luca_class_menu_li ($classes) {
    $classes[] = 'luca-li-classs';
    return $classes;
}

// Fonction ajout class a menu
function luca_class_menu_a ($attrs) {
    $attrs['class'] = 'luca-a-class';
    return $attrs;
}

// Fonction qui agit sur les éléments de la pagination
function luca_pagination () {

    // Récupère la pagination dans $pagination
    $pagination = paginate_links(['type' => 'array']);

    //Si la pagination est nulle, on ne retourne rien
    if ($pagination == null) {
        return;
    }

    //Affichage de la structure personalisée
    echo '<nav aria-label="Pagination">';
    echo '<ul class="flex justify-center">';
    foreach ($pagination as $page) {
        $active = strpos($page, "current") !== false;
        $class = "p-2 bg-white border border-gray-200 text-blue-500 hover:text-white hover:bg-blue-600 rounded";
        if ($active) {
            $class = "p-2 bg-white border border-gray-200 text-white bg-blue-600 rounded";
        }
        echo '<li class="'.$class.'">';
        echo str_replace('page-numbers', 'luca-a-class', $page);
        echo '</li>';
    }
    echo '</ul>';
    echo '</nav>';
}

function luca_register_widget () {
    register_sidebar([
        'id' => 'menu',
        'name' => 'Widget Menu',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4>',
        'after_title' => '</h4>'
    ]);
}

/* Autoriser les fichiers SVG */
function wpc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}

function admin_page() {
    $file = plugin_dir_path( __FILE__ ) . "admin/admin.php";

    if ( file_exists( $file ) )
        require $file;
}

function admin_css() {
	$admin_css_file = 'admin_css';
	$admin_css_link = get_template_directory_uri() . '/admin/admin.css';

	wp_enqueue_style($admin_css_file, $admin_css_link);
}

// Exectution de chaques fonction sur un hook précis
add_action('after_setup_theme', 'luca_supports');

add_action('wp_enqueue_scripts', 'luca_assets');

add_action('widgets_init', 'luca_register_widget');

add_action('admin_menu', function() {
	add_menu_page( 'Page Admin', 'Page admin', 'manage_options', 'Page admin', 'admin_page', 'dashicons-calendar', 10 );
});

add_action('admin_print_styles', 'admin_css', 11);

// Remet l'éditeur classique WordPress sur le hook use_block_editor_for_post
// add_filter('use_block_editor_for_post', '__return_false', 10);

add_filter('nav_menu_css_class', 'luca_class_menu_li');

add_filter('nav_menu_link_attributes', 'luca_class_menu_a');

add_filter('upload_mimes', 'wpc_mime_types');