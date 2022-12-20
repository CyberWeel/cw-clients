<?php # Main plugin class
final class CwClients {
  # Print a template for admin page
  static public function showAdminPage() {
    include_once CW_CLIENTS_ADMIN.'/catalog.php';
  }

  # Print a template for clients catalog
  static public function showClientsTemplate () {
    $posts = get_posts(array(
      'numberposts' => 20,
      'category' => CW_CLIENTS_ID,
      'posts_per_page' => -1,
      'post_type' => 'post',
      'post_status' => 'publish',
      'nopaging' => true,
      'orderby' => 'date',
      'order' => 'DESC',
    ));
    global $post;
    ob_start();

    foreach($posts as $post):
      setup_postdata($post);
      $cwPostImages = get_attached_media('image');
      $sperma = get_post_thumbnail_id();
      ?>
      <div>
        <div>Time: <?=$post->post_date?></div>
        <div>Short description: <?php the_excerpt() ?></div>
        <div>Description: <?php the_content() ?></div>
        <div>Address: <?=get_post_meta($post->ID, 'address', true)?></div>
        <div>Phone number: <?=get_post_meta($post->ID, 'phone', true)?></div>
        <div>Email: <?=get_post_meta($post->ID, 'email', true)?></div>
        <div>Website: <?=get_post_meta($post->ID, 'website', true)?></div>
        <div>Facebook: <?=get_post_meta($post->ID, 'facebook', true)?></div>
        <div>WhatsApp: <?=get_post_meta($post->ID, 'whatsapp', true)?></div>
        <div>Link about us: <?=get_post_meta($post->ID, 'about', true)?></div>
        <div>Photos:</div>
        Thumbnail:
        <div style="width:300px;height:300px;">
          <?php the_post_thumbnail() ?>
        </div>
        <div>
          Other:
          <?php foreach ($cwPostImages as $cwPostImage):
            if ($cwPostImage->ID !== $sperma): ?>
            <img src="<?=$cwPostImage->guid?>" style="width:200px;height:200px;">
            <?php endif;
          endforeach ?>
        </div>
      </div>
      <hr>
      <?php
    endforeach;
    wp_reset_postdata();
    return ob_get_clean();
  }

  # Print a template for form page
  static public function showFormTemplate() {
    ob_start() ?>
    <form class="cw-clients-form" action="<?=$_SERVER['REQUEST_URI']?>" method="POST" enctype="multipart/form-data">
      <div class="cw-clients-form__row">
        <div class="cw-clients-form__error"></div>
      </div>
      <div class="cw-clients-form__row">
        <label class="cw-clients-form__label" for="cw_clients_form_logo">Logo:</label>
        <input class="cw-clients-form__file" name="logo" type="file" id="cw_clients_form_logo">
      </div>
      <div class="cw-clients-form__row">
        <label class="cw-clients-form__label" for="cw_clients_form_short">Short description:</label>
        <input class="cw-clients-form__input" name="short" type="text" id="cw_clients_form_short">
      </div>
      <div class="cw-clients-form__row">
        <label class="cw-clients-form__label" for="cw_clients_form_description">Description:</label>
        <textarea class="cw-clients-form__textarea" name="description" id="cw_clients_form_description"></textarea>
      </div>
      <div class="cw-clients-form__row">
        <label class="cw-clients-form__label">Photos:</label>
        <input class="cw-clients-form__file" name="file1" type="file" id="cw_clients_form_file_1">
        <input class="cw-clients-form__file" name="file2" type="file" id="cw_clients_form_file_2">
        <input class="cw-clients-form__file" name="file3" type="file" id="cw_clients_form_file_3">
      </div>
      <!-- TODO: Add countries (maybe in select) -->
      <div class="cw-clients-form__row">
        <label class="cw-clients-form__label" for="cw_clients_form_address">Address:</label>
        <input class="cw-clients-form__input" name="address" type="text" id="cw_clients_form_address">
      </div>
      <div class="cw-clients-form__row">
        <label class="cw-clients-form__label" for="cw_clients_form_phone">Phone number:</label>
        <input class="cw-clients-form__input" name="phone" type="phone" id="cw_clients_form_phone">
      </div>
      <div class="cw-clients-form__row">
        <label class="cw-clients-form__label" for="cw_clients_form_email">Email:</label>
        <input class="cw-clients-form__input" name="email" type="email" id="cw_clients_form_email">
      </div>
      <div class="cw-clients-form__row">
        <label class="cw-clients-form__label" for="cw_clients_form_website">Website:</label>
        <input class="cw-clients-form__input" name="website" type="text" id="cw_clients_form_website">
      </div>
      <div class="cw-clients-form__row">
        <p class="cw-clients-form__label">Socials:</p>
        <label class="cw-clients-form__label" for="cw_clients_form_facebook">Facebook:</label>
        <input class="cw-clients-form__input" name="facebook" type="text" id="cw_clients_form_facebook">
        <label class="cw-clients-form__label" for="cw_clients_form_whatsapp">WhatsApp:</label>
        <input class="cw-clients-form__input" name="whatsapp" type="text" id="cw_clients_form_whatsapp">
      </div>
      <div class="cw-clients-form__row">
        <label class="cw-clients-form__label" for="cw_clients_form_about">Link about us:</label>
        <input class="cw-clients-form__input" name="about" type="text" id="cw_clients_form_about">
      </div>
      <div class="cw-clients-form__row">
        <button class="cw-clients-form__submit">Send</button>
      </div>
    </form>
    <?php return ob_get_clean();
  }
}