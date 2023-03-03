<?php

// Fonction indiquant ce que mon thème supporte
function dirosso_supports()
{
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

    add_theme_support('custom-logo');
}

// Fonction ajout assets CSS et JS
function dirosso_assets()
{
    wp_register_style('aos.css', 'https://unpkg.com/aos@2.3.1/dist/aos.css');
    // wp_register_style('aos.css', get_template_directory_uri() . '/node_modules/aos/dist/aos.css');

    wp_register_script('aos.js', 'https://unpkg.com/aos@2.3.1/dist/aos.js', [], false, true);

    wp_enqueue_style('aos.css');
    wp_enqueue_style('style', get_stylesheet_uri());

    wp_enqueue_script('aos.js');
    wp_enqueue_script("script.js", get_template_directory_uri() . "/assets/js/script.js", ["aos.js", "jquery"], false, true);
}

// Fonction qui agit sur les éléments de la pagination
function dirosso_pagination()
{

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
        echo '<li class="' . $class . '">';
        echo str_replace('page-numbers', 'dirosso-a-class', $page);
        echo '</li>';
    }
    echo '</ul>';
    echo '</nav>';
}

function dirosso_register_widget()
{
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
function dirosso_add_file_types_to_uploads($mime_file_types)
{
    $mime_file_types['svg'] = 'image/svg+xml';
    return $mime_file_types;
}

// function admin_page() {
//     $file = plugin_dir_path( __FILE__ ) . "admin/admin.php";

//     if ( file_exists( $file ) )
//         require $file;
// }

// function admin_css() {
// 	$admin_css_file = 'admin_css';
// 	$admin_css_link = get_template_directory_uri() . '/admin/admin.css';

// 	wp_enqueue_style($admin_css_file, $admin_css_link);
// }

// Exectution de chaques fonction sur un hook précis
add_action('after_setup_theme', 'dirosso_supports');

add_action('wp_enqueue_scripts', 'dirosso_assets');

add_action('widgets_init', 'dirosso_register_widget');

add_action('upload_mimes', 'dirosso_add_file_types_to_uploads');

// add_action('admin_menu', function() {
// 	add_menu_page( 'Page Admin', 'Page admin', 'manage_options', 'Page admin', 'admin_page', 'dashicons-calendar', 10 );
// });

// add_action('admin_print_styles', 'admin_css', 11);