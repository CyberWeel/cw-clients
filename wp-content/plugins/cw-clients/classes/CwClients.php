<?php
# Main plugin class
final class CwClients {
  static public function showAdminPage () {
    global $wpdb;
    include_once CW_CLIENTS_ADMIN.'/template.php';
  }

  static public function showClientsTemplate () {
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

  static public function showFormTemplate () {
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