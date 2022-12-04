<?php
/**
* Plugin Name: CyberWeel Clients
* Description: Plugin for output client's forms
* Version: 1.0.0
* Author: CyberWeel
*/

add_shortcode('cw_clients_form', array('CwClients', 'form_template'));

class CwClients {
  static public function form_template() {
    ob_start()?>
    <form class="cw-clients-form" action="" method="POST">
      <div class="cw-clients-form-row">
        <input class="cw-clients-form-input" type="text" placeholder="Name of company">
        <button class="cw-clients-form-submit">Send</button>
      </div>
    </form>
    <script></script>
    <?php
    return ob_get_clean();
  }
}