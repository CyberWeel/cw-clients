<?php
/**
* Plugin Name: CyberWeel Clients
* Description: Plugin for output client's forms
* Version: 1.0.0
* Author: CyberWeel
*/

add_action('admin_menu', function() {
  add_menu_page(
    'CW Clients',
    'CW Clients',
    'manage_options',
    'cw_clients',
    'cwClientsAdmin',
    'dashicons-admin-users',
    4
  );
});
function cwClientsAdmin() {
  global $wpdb;
  include_once('cw-clients-admin.php');
}

add_shortcode('cw_clients', array('CwClients', 'showClients'));
add_shortcode('cw_clients_form', array('CwClients', 'showForm'));
final class CwClients {
  static public function showClients () {
    $posts = get_posts(array(
      'numberposts' => 20,
      'category' => 3,
      'orderby' => 'date',
      'order' => 'DESC',
      'post_type' => 'post'
    ));

    global $post;
    ob_start();

    foreach($posts as $post):
      setup_postdata($post);
      ?>
      <div>
        <div>Time: <?=$post->post_date?></div>
        <div>Phone: <?=get_post_meta($post->ID, 'phone', true)?></div>
        <div>Country: <?=get_post_meta($post->ID, 'country', true)?></div>
        <div>Description: <?=get_post_meta($post->ID, 'description', true)?></div>
      </div>
      <?php
    endforeach;
    wp_reset_postdata();
    return ob_get_clean();
  }

  static public function showForm () {
    ob_start();
    ?>
      <form class="cw-clients-form" action="" method="POST">
        <div class="cw-clients-form-row">
          <label class="cw-clients-form-label" for="cw_clients_form_phone">Phone number:</label>
          <input class="cw-clients-form-input" name="phone" type="phone" id="cw_clients_form_phone">
        </div>
        <div class="cw-clients-form-row">
          <label class="cw-clients-form-label" for="cw_clients_form_country">Country:</label>
          <input class="cw-clients-form-input" name="country" type="text" id="cw_clients_form_country">
        </div>
        <div class="cw-clients-form-row">
          <label class="cw-clients-form-label" for="cw_clients_form_description">Description:</label>
          <textarea class="cw-clients-form-textarea" name="description" id="cw_clients_form_description"></textarea>
        </div>
        <div class="cw-clients-form-row">
          <button class="cw-clients-form-submit">Send</button>
        </div>
      </form>
    <?php
    return ob_get_clean();
  }
}