<?php # General template for admin page
$posts = get_posts(array(
  'numberposts' => 20,
  'posts_per_page' => -1,
  'category' => CW_CLIENTS_ID,
  'post_type' => 'post',
  'post_status' => 'any',
  'nopaging' => true,
  'orderby' => 'date',
  'order' => 'DESC',
  'suppress_filters' => true
));
global $post;
?>
<section class="cw-clients-admin">
  <h1 class="cw-clients-admin__heading">Clients</h1>
  <div class="cw-clients-admin__content">
    <table class="wp-list-table widefat fixed striped table-view-list posts">
      <thead>
        <tr>
          <th scope="col" id="id" class="manage-column column-id">ID</th>
          <th scope="col" id="phone" class="manage-column column-phone">Phone</th>
          <th scope="col" id="country" class="manage-column column-country">Country</th>
          <th scope="col" id="status" class="manage-column column-status">Status</th>
          <th scope="col" id="date" class="manage-column column-date sortable asc">Date</th>
        </tr>
      </thead>
      <tbody id="the-list">
        <?php foreach($posts as $post): ?>
          <?php setup_postdata($post) ?>
          <tr class="iedit author-self level-0 post-<?=get_the_ID()?> type-post status-publish format-standard hentry category-<?=CW_CLIENTS_ID?>">
            <td class="title column-title has-row-actions column-primary page-title" data-colname="Заголовок">
              <strong>
                <a class="row-title" href="/wp-admin/post.php?post=<?=get_the_ID()?>&amp;action=edit"><?=get_the_ID()?></a>
              </strong>
              <div class="row-actions">
                <span class="edit">
                  <a href="/wp-admin/post.php?post=<?=get_the_ID()?>&amp;action=edit">Изменить</a> |
                </span>
                <span class="trash">
                  <a href="/wp-admin/post.php?post=<?=get_the_ID()?>&amp;action=trash&amp;_wpnonce=9ff1ab2081" class="submitdelete">Удалить</a> |
                </span>
                <span class="view">
                  <a href="<?=wp_get_shortlink()?>" rel="bookmark">Перейти</a>
                </span>
              </div>
            </td>
            <td><?=get_post_meta($post->ID, 'phone', true)?></td>
            <td><?=get_post_meta($post->ID, 'country', true)?></td>
            <td><?=$post->post_status?></td>
            <td><?=get_the_date('d.m.Y, H:i:s')?></td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</section>
<?php wp_reset_postdata() ?>
<?php # TODO: Грязный файл. Очистить от лишнего. Также, не все кнопки работают ?>