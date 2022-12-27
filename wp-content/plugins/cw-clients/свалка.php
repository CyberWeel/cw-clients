1. Админка: в каталоге в колонку "Заголовок" добавить ID формы для идентификации.
2. Админка: в детальной карточке при отсутствии картинок добавить кнопку "Add images".
3. Фронт: AJAX при отправке формы - добавить какой-нибудь логичный поп-ап с перенаправлением на главную страницу через 5 секунд, например.
4. Фронт: пагинация в каталоге.



$current_page = !empty($_GET['paged']) ? $_GET['paged'] : 1;

      echo paginate_links(array(
        'base' => site_url().'/clients-posts/%_%',
        'format' => '?paged=%#%',
        //'total' => $query->max_num_pages,
        'total' => 5,
        'current' => $current_page,
        'show_all' => false,
        'end_size' => 1,
        'mid_size' => 1,
        'prev_next' => true,
        'prev_text' => 'Previous '.CW_CLIENTS_LABEL,
        'next_text' => 'Next '.CW_CLIENTS_LABEL
      ));




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
          <?php wp_reset_postdata() ?>
        </tbody>
</table>






FUNCTIONS

/*

$cwPostImages = get_attached_media('image');
foreach ($cwPostImages as $cwPostImage):
  if ($cwPostImage->ID !== get_post_thumbnail_id()): ?>
  <img src="<?=$cwPostImage->guid?>" style="width:200px;height:200px;">
  <?php endif;
endforeach ?>
<?=get_the_post_thumbnail_url(null, 'thumbnail')?>
*/






CATALOG:

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

<style>
  .cw-clients-admin__table {
    width: 100%;
    margin: 0;
    border: 1px solid #c3c4c7;
    border-spacing: 0;
    table-layout: fixed;
    background: #fff;
    box-shadow: 0 1px 1px rgb(0 0 0 / 4%);
    clear: both;
  }
  .cw-clients-admin__table * {
    word-wrap: break-word;
  }
  .cw-clients-admin__th {
    padding: 8px 10px;
    border-bottom: 1px solid #c3c4c7;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.4em;
    text-align: left;
    color: #2c3338;
  }
  .cw-clients-admin__tr:nth-child(odd) {
    background-color: #f6f7f7;
  }
  .cw-clients-admin__td {
    vertical-align: top;
    padding: 8px 10px;
    font-size: 13px;
    line-height: 1.5em;
    color: #50575e;
  }
  .cw-clients-admin__td:first-child {
    font-weight: bold;
  }
  .cw-clients-admin__td a {
    text-decoration: none;
    transition: none;
  }
  .cw-clients-admin__actions {
    padding: 2px 0 0;
    font-size: 13px;
    color: #a7aaad;
    position: relative;
    left: -9999em;
  }
  .cw-clients-admin__actions-delete {
    color: #b32d2e;
  }
</style>