<?php
/**
 * @package promociones Hotel Quito
 * @version 0.0
 */
/*
Plugin Name: Promociones
Plugin URI: http://wordpress.org/plugins/pua-slider/
Description: Promociones by Kanika
Author: Nicolás Vela
Version: 0.0
Author URI: http://kanika.com
*/
class promociones {
    public function __construct(){
    	add_shortcode( 'promociones' , array( $this, 'promo_ini') ); 
    }

    public function promo_ini($atts){

        echo '<script type="text/javascript"> var admin_url = "'.admin_url().'";</script>';
    	echo '<script src="'.plugin_dir_url( __FILE__ ).'popup.js"></script>';
        echo '<script src="'.plugin_dir_url( __FILE__ ).'center.js"></script>';
        echo '<link rel="stylesheet" href="'.plugin_dir_url( __FILE__ ).'style.css">';
        echo '<div class="promociones" data-equalizer>';

    	$my_query = new WP_Query( 'category_name=Hospedaje,Restaurante,Festivales y promociones' );

		if ( $my_query->have_posts() ) {
            $count = 1;
            $count_id = 1;
            $total_post = $my_query->found_posts;

			while ( $my_query->have_posts() ) {
                if($count == 1){
                    echo '<div class="row" id="fila-'.$count_id.'">';
                    $count_id++;
                }
				$my_query->the_post();

                $tipo = '';
                $category = wp_get_post_categories($my_query->post->ID);
                if($category[0] != '4'){
                    if($category[0] == '7'){$tipo = '<div class="tipo tipo_restaurante">restaurante</div>';}
                    else if($category[0] == '8'){$tipo = '<div class="tipo tipo_hospedaje">hospedaje</div>';}

    				get_html($my_query, $tipo);
                }else{
                    $tipo = '<div class="bienvenida"><div class="left bienvenida_text">BIENVENIDOS</div> <div class="tipo_bienvenida left"></div><div class="estrellas left"></div></div>';
                    get_html($my_query, $tipo);
                }
                if($total_post == $count){
                    echo '</div>';
                }else if(( $count % 3 ) == 0 ){
                    echo '</div><div class="row" id="fila-'.$count_id.'">';
                    $count_id++;
                }
                $count++;
			}
		}
		wp_reset_postdata();
        echo '</div>';

    }	
}

function get_html($my_query, $tipo){
    $post_id = $my_query->post->ID;
    if($post_id == '64'){$class = 'cont_bien';}
    echo '<div class="small-12 large-4 columns prom_item" id="seccion-';
    the_ID();
    echo '" data-equalizer-watch>';
    if($post_id != '64'){
        echo '<a href="#" onclick="popup('."'";
        the_ID();
        echo "'".')">';
    }
    echo '<div class="tit_promo">'.$tipo;
    if($post_id != '64'){
        the_title();
        echo '</a>';
    }
    echo '</div>';
    echo '<div class="cont_prom '.$class.'">';
    if($post_id != '64'){
        echo '<a href="#" onclick="popup('."'";
        the_ID();
        echo "'".')">';
    }

    the_content('', false);
    if($post_id != '64'){          
        echo '</a>';
    }
    echo '</div></div>';
}

// pop up dinamico trabaja con popup.js

function get_popup_post() {
    if(isset($_POST['main_catid'])){
        $post = get_post($_POST['main_catid']);
        echo $post->post_title;
        echo $post->post_content;

        die();
   } 
}
add_action('wp_ajax_popup', 'get_popup_post');
add_action('wp_ajax_nopriv_popup', 'get_popup_post');


$promociones = new promociones();