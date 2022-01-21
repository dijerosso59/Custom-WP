<?php
global $wpdb;
$result = $wpdb->get_results("SELECT * FROM  $wpdb->terms" );
?>

<section id="admin">
    <h1>Voici la page admin custom</h1>
    <?php
    foreach ($result as $key => $value) {
        echo "<p>Ligne dans wp_terms :<br>Id : ". $value->term_id ."<br>Nom : ". $value->name ."<br>Slug : ". $value->slug ."<br>Groupe de term : ". $value->term_group ." </p> ";
    }
    ?>
    
</section>