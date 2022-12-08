<?php
# Template for showing on admin page

$posts = get_posts(array(
  'numberposts' => 20,
  'category' => CW_CLIENTS_PLUGIN_ID,
  'orderby' => 'date',
  'order' => 'DESC',
  'post_type' => 'post',
  'post_status' => 'publish,draft'
));

global $post;
?>
<section class="cw-clients-admin">
  <h1 class="cw-clients-admin__heading">CW Clients</h1>
  <div class="cw-clients-admin__content">
    <?php foreach($posts as $post): ?>
      <?php setup_postdata($post); ?>

      <div class="cw-clients-admin__card">
        <div>Time: <?=$post->post_date?></div>
        <div>Status: <?=$post->post_status?></div>
        <div>Phone: <?=get_post_meta($post->ID, 'phone', true)?></div>
        <div>Country: <?=get_post_meta($post->ID, 'country', true)?></div>
        <div>Description: <?=get_post_meta($post->ID, 'description', true)?></div>
      </div>

      <br><br>

    <?php endforeach ?>
  </div>
</section>
<?php wp_reset_postdata(); ?>