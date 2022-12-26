<?php # Main plugin class
final class CwClients {
  # Set of parameters for getting posts
  static public function getPostsParams(string $status = 'any') :array {
    return array(
      'numberposts' => 20,
      'posts_per_page' => -1,
      'category' => CW_CLIENTS_ID,
      'post_type' => CW_CLIENTS_TYPE,
      'post_status' => $status,
      'nopaging' => true,
      'orderby' => 'date',
      'order' => 'DESC'
    );
  }

  # Print a template for clients catalog
  static public function showClientsTemplate () {
    $posts = get_posts(self::getPostsParams('publish'));
    global $post;
    ob_start();

    if (count($posts) > 0) {
      foreach($posts as $post) {
        setup_postdata($post);
        $logoID = get_post_thumbnail_id();
        ?>
        <article class="cw-clients-item">
          <a class="cw-clients-item__link" href="<?=wp_get_shortlink()?>">
            <?php if ($logoID): ?>
              <img class="cw-clients-item__logo" src="<?=get_the_post_thumbnail_url(null, 'thumbnail')?>" alt="Client's logo image">
            <?php else: ?>
              <div class="cw-clients-item__logo-dummy"></div>
            <?php endif ?>

            <p class="cw-clients-item__desc"><?=get_the_excerpt()?></p>
          </a>
        </article>
        <?php
      }

      wp_reset_postdata();
    }
    else {
      ?>
      <p>There is no posts yet.</p>
      <?php
    }

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
        <textarea class="cw-clients-form__textarea" name="description" id="cw_clients_form_description" maxlength="500"></textarea>
      </div>
      <div class="cw-clients-form__row">
        <label class="cw-clients-form__label">Photos:</label>
        <input class="cw-clients-form__file" name="file1" type="file" id="cw_clients_form_file_1">
        <input class="cw-clients-form__file" name="file2" type="file" id="cw_clients_form_file_2">
        <input class="cw-clients-form__file" name="file3" type="file" id="cw_clients_form_file_3">
      </div>
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

  # Print a meta box for admin page post editor
  static public function showMetaBox($post, $vars) {
    $name = $vars['args']['name'];
    $type = $vars['args']['type'];
    $meta = $vars['args']['meta'];
    $value;

    switch ($meta) {
      case 'meta':
        $value = get_post_meta($post->ID, $name, true);
        break;
      case 'excerpt':
        $value = get_the_excerpt();
        break;
    }

    echo '<input type="'.$type.'" name="'.$name.'" value="'.$value.'">';
  }

  # ...
  static public function showMetaGallery($post) {
    $thumbnail = get_post_thumbnail_id();
    $images = get_attached_media('image');
    $postImages = array();

    foreach ($images as $image) {
      if ($image->ID !== $thumbnail) {
        $postImages[] = $image->ID;
      }
    }

    $postImages = implode(',', $postImages);

    echo do_shortcode('[gallery ids="'.$postImages.'" orderby="ID" order="ASC" columns="1" size="thumbnail" link="file"]');
  }
}