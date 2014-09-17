<?php
function register_gallery_post_type() {
  register_post_type('gallery', array(
    'labels' => array(
      'name' => 'Gallery',
      'single_name' => 'Gallery'
    ),
    'public' => false,
    'supports' => array('title')
  ));
}
add_action('init', 'register_gallery_post_type');

function add_gallery_menu_page() {
  add_menu_page( 'Smile Gallery', 'Smile Gallery', 'administrator', 'smile_gallery', 'render_gallery_menu_page' );
}
add_action('admin_menu', 'add_gallery_menu_page');

function render_gallery_menu_page() {
  if (isset($_POST['action'])) {
    if (isset($_POST['order'])) {
      update_option('gallery_order', $_POST['order']);
    }
    if (isset($_POST['remove_post'])) {
      echo '<h1>Deleted</h1>';
      $order = array_map(intval, explode(',', get_option('gallery_order')));
      unset($order[array_search($post_id, $order)]);
      update_option('gallery_order', implode(',', $order));
      wp_delete_post(intval($_POST['post_id']));
    } else {
      if ($_POST['action'] == 'new_post') {
        $id = wp_insert_post(array(
          'post_title' => $_POST['patient_name'],
          'post_type' => 'gallery',
          'post_status' => 'publish'
        ));
        if (isset($_POST['before_src'])) { update_post_meta($id, 'before_src', $_POST['before_src']); }
        if (isset($_POST['after_src'])) { update_post_meta($id, 'after_src', $_POST['after_src']); }
        if (isset($_POST['patient_name'])) { update_post_meta($id, 'patient_name', $_POST['patient_name']); }
        if (isset($_POST['procedure_name'])) { update_post_meta($id, 'procedure_name', $_POST['procedure_name']); }
        if (isset($_POST['face_src'])) { update_post_meta($id, 'face_src', $_POST['face_src']); }
        if (isset($_POST['notes'])) { update_post_meta($id, 'notes', $_POST['notes']); }
        update_option('gallery_order', get_option('gallery_order') . ',' . $id);
      } else if ($_POST['action'] == 'update_post') {
        $id = $_POST['post_id'];
        if (isset($_POST['before_src'])) { update_post_meta($id, 'before_src', $_POST['before_src']); }
        if (isset($_POST['after_src'])) { update_post_meta($id, 'after_src', $_POST['after_src']); }
        if (isset($_POST['face_src'])) { update_post_meta($id, 'face_src', $_POST['face_src']); }
        if (isset($_POST['patient_name'])) { update_post_meta($id, 'patient_name', $_POST['patient_name']); }
        if (isset($_POST['procedure_name'])) { update_post_meta($id, 'procedure_name', $_POST['procedure_name']); }
        if (isset($_POST['notes'])) { update_post_meta($id, 'notes', $_POST['notes']); }
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

    var buffer = '<?php echo get_option('gallery_order'); ?>';
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
  render_edit_field(0, 'add');
  ?> <ul id="order" style="padding: 0px"> <?php
    foreach(get_gallery_ids() as $id) {
      ?> <li style="list-style: none;"> <?php
      if (intval($id) !== 0) {
        render_edit_field(intval($id), 'update');
      }
      ?> </li> <?php
    }
  ?> </ul> </div><?php
}
function render_edit_field($post_id, $mode) {
?>
<div style="width: 45%; margin: 25px;" class="content_options">
  <form method="post">
    <div class="input_section">
    <div style="background-color: #ffffff;" class="input_title" <?php if ($mode == 'update') { ?>style="background-color: #5e5e5e;"<?php } ?>>
        <h3><?php if ($mode == 'update') { echo '<span style="width: 120px; display: inline-block;">' . get_post_meta($post_id, 'patient_name', true) . '</span>'; } else { echo 'New Patient'; }?></h3>
<?php
if ($mode == 'update' && trim(get_post_meta($post_id, 'before_src', true)) !== '' && trim(get_post_meta($post_id, 'after_src', true)) !== '') {
  echo '<img style="max-height: 22px; margin: 3px; width: auto;" src="' . get_post_meta($post_id, 'before_src', true) . '" />';
  echo '<img style="max-height: 22px; margin: 3px; width: auto;" src="' . get_post_meta($post_id, 'after_src', true) . '" />';
}
?>
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
          <label for="patient_name">Patient Name</label>
          <input style="width: 80%;" type="text" name="patient_name" value="<?php echo get_post_meta($post_id, 'patient_name', true); ?>">
          <div class="clearfix"></div>
        </div>
        <div class="option_input option_text">
          <label for="procedure_name">Procedure</label>
          <input style="width: 80%;" type="text" name="procedure_name" value="<?php echo get_post_meta($post_id, 'procedure_name', true); ?>">
        </div>
        <div class="option_input option_text">
          <label for="procedure_name">Full Face</label>
          <div class="upload-image" style="float: left; width: 80%; margin: 0px; box-sizing: border-box;">
          <input type="hidden" value="<?php echo get_post_meta($post_id, 'face_src', true); ?>" name="face_src">
            <div class="image-preview" style="border: 2px dashed #c1c1c1; margin-top: 10px; margin-bottom: 10px; cursor: pointer;">
              <?php  if (trim(get_post_meta($post_id, 'face_src', true)) !== '') { ?>
                <img src="<?php echo get_post_meta($post_id, 'face_src', true); ?>" style="max-width: 100%; height: auto;"/>
              <?php } else { ?>
                <?php echo get_post_meta($post_id, 'face_src', true); ?>
                <h4 style="font-size: 30px; inline-display: block; text-align: center; margin: 75px auto;">Full Face</h4>
              <?php } ?>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="option_input">
          <label>Photos</label>
          <div class="upload-image" style="float: left; width: 40%; margin: 0px; box-sizing: border-box;">
          <input type="hidden" value="<?php echo get_post_meta($post_id, 'before_src', true); ?>" name="before_src">
            <div class="image-preview" style="border: 2px dashed #c1c1c1; margin-top: 10px; margin-bottom: 10px; cursor: pointer;">
              <?php if (trim(get_post_meta($post_id, 'before_src', true)) !== '') { ?>
                <img src="<?php echo get_post_meta($post_id, 'before_src', true); ?>" style="max-width: 100%; height: auto;"/>
              <?php } else { ?>
                <h4 style="font-size: 30px; inline-display: block; text-align: center; margin: 75px auto;">Before</h4>
              <?php } ?>
            </div>
          </div>
          <div class="upload-image" style="float: left; width: 40%; margin: 0px; box-sizing: border-box">
            <input type="hidden" name="after_src" value="<?php echo get_post_meta($post_id, 'after_src', true); ?>">
            <div class="image-preview" style="border: 2px dashed #c1c1c1; margin-top: 10px; margin-bottom: 10px; cursor: pointer;">
              <?php if (trim(get_post_meta($post_id, 'after_src', true)) !== '') { ?>
                <img src="<?php echo get_post_meta($post_id, 'after_src', true); ?>" style="max-width: 100%; height: auto;"/>
              <?php } else { ?>
                <h4 style="font-size: 30px; inline-display: block; text-align: center; margin: 75px auto;">After</h4>
              <?php } ?>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="option_input option_textarea">
          <label for="notes">Comments</label>
          <textarea style="width: 80%;" name="notes"><?php echo get_post_meta($post_id, 'notes', true); ?></textarea>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </form>
</div>
<?php
}

function get_gallery_ids() {
  return explode(',', get_option('gallery_order'));
}

function enqueue_gallery_tb() {
  wp_enqueue_script('jquery');
  wp_enqueue_Script('jquery-ui-core');
  wp_enqueue_Script('jquery-ui-sortable');
  wp_enqueue_style('thickbox');
  wp_enqueue_script('thickbox');
  wp_enqueue_script('media-upload');
}
add_action('admin_menu', 'enqueue_gallery_tb');
?>
