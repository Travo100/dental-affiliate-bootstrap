<?php
function register_vgallery_post_type() {
  register_post_type('vgallery', array(
    'labels' => array(
      'name' => 'VGallery',
      'single_name' => 'VGallery'
    ),
    'public' => false,
    'supports' => array('title')
  ));
}
add_action('init', 'register_vgallery_post_type');

function add_vgallery_menu_page() {
  add_menu_page( 'Video Gallery', 'Video Gallery', 'administrator', 'video_gallery', 'render_vgallery_menu_page' );
}
add_action('admin_menu', 'add_vgallery_menu_page');

function render_vgallery_menu_page() {
  if (isset($_POST['action'])) {
    if (isset($_POST['order'])) {
      update_option('vgallery_order', $_POST['order']);
    }
    if (isset($_POST['remove_post'])) {
      echo '<h1>Deleted</h1>';
      $order = array_map(intval, explode(',', get_option('vgallery_order')));
      unset($order[array_search($post_id, $order)]);
      update_option('vgallery_order', implode(',', $order));
      wp_delete_post(intval($_POST['post_id']));
    } else {
      if ($_POST['action'] == 'new_post') {
        $id = wp_insert_post(array(
          'post_title' => $_POST['video_name'],
          'post_type' => 'vgallery',
          'post_status' => 'publish'
        ));
        if (isset($_POST['vid'])) { update_post_meta($id, 'vid', $_POST['vid']); }
        if (isset($_POST['video_name'])) { update_post_meta($id, 'video_name', $_POST['video_name']); }
        if (isset($_POST['video_desc'])) { update_post_meta($id, 'video_desc', $_POST['video_desc']); }
        update_option('vgallery_order', get_option('vgallery_order') . ',' . $id);
      } else if ($_POST['action'] == 'update_post') {
        $id = $_POST['post_id'];
        if (isset($_POST['video_desc'])) { update_post_meta($id, 'video_desc', $_POST['video_desc']); }
        if (isset($_POST['video_name'])) { update_post_meta($id, 'video_name', $_POST['video_name']); }
        if (isset($_POST['vid'])) { update_post_meta($id, 'vid', $_POST['vid']); }
      }
    }
  }
?>
<script>
  jQuery(document).ready(function($) {
    var $target;
    $('.upload-image').click(function() {
      $target = $(this);
      tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
    });
    window.send_to_editor = function(html) {
      var src = $('img', html).attr('src');
      $target.children('input').val(src);
      $target.children('.image-preview').html('<img style="max-width: 100%; height: auto;" src="' + src + '" />');
      tb_remove();
    };


    $('li .content_options').find('.all_options').hide();
    $('li .content_options').find('.input_title').find('.edit-btn').click(function() {
        jQuery(this).parent().parent().parent().find('.all_options').slideToggle();
    });

    var buffer = '<?php echo get_option('vgallery_order'); ?>';
    $('#order').sortable({ 'update': function() {
      buffer = '';
      var $target = $('#order li .content_options');
      $target.each(function(i) {
        buffer += $(this).find('[name="post_id"]').val();
        if ($target.length - 1 !== i) {
          buffer += ',';
        }
      });
      console.log(buffer);
    }});
    $('form').on('submit', function() {
      $(this).append('<input type="hidden" name="order" value="' + buffer + '">');
    });
  });
</script>
<div class="smile-gallery-admin">
<?php
  render_vedit_field(0, 'add');
  ?> <ul id="order" style="padding: 0px"> <?php
    foreach(get_vgallery_ids() as $id) {
      ?> <li style="list-style: none;"> <?php
      if (intval($id) !== 0) {
        render_vedit_field(intval($id), 'update');
      }
      ?> </li> <?php
    }
  ?> </ul> </div><?php
}
function render_vedit_field($post_id, $mode) {
?>
<div style="width: 45%; margin: 25px;" class="content_options">
  <form method="post">
    <div class="input_section">
    <div style="background-color: #ffffff;" class="input_title" <?php if ($mode == 'update') { ?>style="background-color: #5e5e5e;"<?php } ?>>
        <h3><?php if ($mode == 'update') { echo '<span style="width: 120px; display: inline-block;">' . get_post_meta($post_id, 'video_name', true) . '</span>'; } else { echo 'New Video'; }?></h3>
        <span class="submit">
        <?php
          if ($mode == 'add') {
            ?>
              <input type="hidden" name="action" value="new_post">
              <input type="submit" class="button-primary" value="Add">
            <?php
          } else if ($mode == 'update') {
            ?>
              <input type="hidden" name="action" value="update_post">
              <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
              <input type="button" class="button-primary edit-btn" value="Edit">
              <input type="submit" class="button-primary" value="Update">
              <input type="submit" name="remove_post" class="button-primary" value="Delete">
            <?php
          }
        ?>
        </span>
        <div class="clearfix"></div>
      </div>
      <div class="all_options">
        <div class="option_input option_text">
          <label for="video_name">Name</label>
          <input style="width: 80%;" type="text" name="video_name" value="<?php echo get_post_meta($post_id, 'video_name', true); ?>">
          <div class="clearfix"></div>
        </div>
        <div class="option_input option_text">
          <label for="embed">Video Id<br /><span style="font-size: 11px">(11 character ID)</span></label>
          <input style="width: 80%;" type="text" name="vid" value="<?php echo get_post_meta($post_id, 'vid', true); ?>">
          <div class="clearfix"></div>
        </div>
        <div class="option_input option_textarea">
          <label for="video_desc">Description</label>
          <textarea style="width: 80%;" name="video_desc"><?php echo get_post_meta($post_id, 'video_desc', true); ?></textarea>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </form>
</div>
<?php
}

function get_vgallery_ids() {
  return explode(',', get_option('vgallery_order'));
}
?>
