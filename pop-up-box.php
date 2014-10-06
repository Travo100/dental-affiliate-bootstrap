<?php
function popup_metabox() {
  $screens = array('page');
  foreach($screens as $screen) {
    add_meta_box(
      'popupbox',
      'Pop Up Box',
      'render_popup_metabox',
      $screen
    );
  }
}
add_action('add_meta_boxes', 'popup_metabox');

function render_popup_metabox($post) {
?>
  <form>
    <input type="hidden" name="popup_metabox">
    <table style="width: 95%;" cellpadding="5">
      <tr>
        <td style="width: 20%;">Enable</td>
        <td><input name="popup_enabled" type="checkbox" <?php echo (get_post_meta($post->ID, 'popup_enabled', true) == true) ? 'checked' : ''; ?>></td>
      </tr>
      <tr>
        <td style="width: 20%;">Content</td>
        <td><?php wp_editor(get_post_meta($post->ID, 'popup_box_content', true), 'popup_box_content'); ?></td>
      </tr>
    </table>
  </form>
<?php
}

function  save_popup_metabox($post_id) {
  if (isset($_POST['popup_metabox'])) {
    update_post_meta($post_id, 'popup_enabled', $_POST['popup_enabled']);
    update_post_meta($post_id, 'popup_box_content', $_POST['popup_box_content']);
  }
}
add_action('save_post', 'save_popup_metabox');
