<?php
/*
 * Template Name: Gallery
 */
get_header();
?>
<div class="content">
  <div class="container">
    <div class="col-md-12">
      <?php
      if (have_posts()) {
        while (have_posts()) {
          the_post();
          the_content();
        }
      }
?>

    <!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
    <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
        <!-- The container for the modal slides -->
        <div class="slides"></div>
        <!-- Controls for the borderless lightbox -->
        <h3 class="title"></h3>
        <a class="prev">‹</a>
        <a class="next">›</a>
        <a class="close">×</a>
        <a class="play-pause"></a>
        <ol class="indicator"></ol>
        <!-- The modal dialog, which will be used to wrap the lightbox content -->
        <div class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body next"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left prev">
                            <i class="glyphicon glyphicon-chevron-left"></i>
                            Previous
                        </button>
                        <button type="button" class="btn btn-primary next">
                            Next
                            <i class="glyphicon glyphicon-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="links" class="gallery-wrapper">
    <?php
    foreach(get_gallery_ids() as $id) {
      if (intval($id) !== 0) {
      $before_src = get_post_meta($id, 'before_src', true);
      $after_src = get_post_meta($id, 'after_src', true);
      $face_src = get_post_meta($id, 'face_src', true);
    ?>
      <div class="case-study">
        <p class="pt-name"><?php echo get_post_meta($id, 'patient_name', true); ?></p>
        <p class="proc-name"><?php echo get_post_meta($id, 'procedure_name', true); ?></p>
        <div clas="row">
        <?php if (trim($face_src) !== '') { ?>
          <div class="col-md-7">
            <a data-gallery href="<?php echo $face_src; ?>"><div class="full-face" style="background-image:url('<?php echo $face_src; ?>')"></div></a>
          </div>
          <div class="col-md-5">
            <a data-gallery href="<?php echo $before_src; ?>"><img class="bap" src="<?php echo $before_src; ?>" /><label>Before</label></a>
            <a data-gallery href="<?php echo $after_src; ?>"><img class="bap" src="<?php echo $after_src; ?>" /><label>After</label></a>
          </div>
        <?php } else { ?>
          <div class="col-md-6">
            <a data-gallery href="<?php echo $before_src; ?>>"><img src="<?php echo $before_src; ?>" /><label>Before</label></a>
          </div>
          <div class="col-md-6">
            <a data-gallery href="<?php echo $after_src; ?>"><img src="<?php echo $after_src; ?>" /><label>After</label></a>
          </div>
        <?php } ?>
        </div>
        <p class="pt-notes"><hr /><?php echo get_post_meta($id, 'notes', true); ?></p>
      </div>
    <?php
    } }
    ?>
    </div>
    </div>
    </div>
  </div>
</div>
<div class="container content">
</div>
<?php get_footer(); ?>
