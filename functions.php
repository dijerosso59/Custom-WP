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

// Exectution de chaques fonction sur un hook précis
add_action('after_setup_theme', 'dirosso_supports');

add_action('wp_enqueue_scripts', 'dirosso_assets');
