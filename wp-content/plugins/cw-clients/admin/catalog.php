<?php # General template for admin page
$posts = get_posts(CwClients::getPostsParams());
global $post;

if (count($posts) > 0):
  include_once CW_CLIENTS_ADMIN.'/styles.php';
  ?>
  <section class="cw-clients-admin">
    <h1 class="cw-clients-admin__heading">Clients</h1>
    <div class="cw-clients-admin__content">
      <table class="cw-clients-admin__table">
        <thead>
          <tr>
            <th class="cw-clients-admin__th">ID</th>
            <th class="cw-clients-admin__th">Email</th>
            <th class="cw-clients-admin__th">Phone</th>
            <th class="cw-clients-admin__th">Website</th>
            <th class="cw-clients-admin__th">Link about us</th>
            <th class="cw-clients-admin__th">Status</th>
            <th class="cw-clients-admin__th">Date</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($posts as $post) {
            setup_postdata($post);
            ?>
            <tr class="cw-clients-admin__tr">
              <td class="cw-clients-admin__td">
                <a href="/wp-admin/post.php?post=<?=get_the_ID()?>&amp;action=edit">
                  Client's Card #<?=get_the_ID()?>
                </a>
                <div class="cw-clients-admin__actions row-actions">
                  <a href="/wp-admin/post.php?post=<?=get_the_ID()?>&amp;action=edit">Edit</a>
                  |
                  <a class="cw-clients-admin__actions-delete"href="<?=wp_nonce_url('/wp-admin/post.php?post='.get_the_ID().'&amp;action=trash', 'trash-post_'.$post->ID)?>">Delete</a>
                  |
                  <a href="<?=wp_get_shortlink()?>">Go to</a>
                </div>
              </td>
              <td class="cw-clients-admin__td"><?=get_post_meta($post->ID, 'email', true)?></td>
              <td class="cw-clients-admin__td"><?=get_post_meta($post->ID, 'phone', true)?></td>
              <td class="cw-clients-admin__td"><?=get_post_meta($post->ID, 'website', true)?></td>
              <td class="cw-clients-admin__td"><?=get_post_meta($post->ID, 'about', true)?></td>
              <td class="cw-clients-admin__td"><?=$post->post_status?></td>
              <td class="cw-clients-admin__td"><?=get_the_date('d.m.Y, H:i:s')?></td>
            </tr>
            <?php
          }

          wp_reset_postdata();
          ?>
        </tbody>
      </table>
    </div>
  </section>
<?
else:
  ?>
  <p>There is no posts yet.</p>
  <?php
endif;