<?php defined('C5_EXECUTE') or die('Access Denied.'); ?>

<script>
    var pickGalleryItemImage = function() {
        var self = $(this);
        ConcreteFileManager.launchDialog(function (data) {
            ConcreteFileManager.getFileDetails(data.fID, function(r) {
                jQuery.fn.dialog.hideLoader();
                var file = r.files[0];
                self.html(file.resultsThumbnailImg);
                self.next('.image-fID').val(file.fID)
            });
        });
    };

    var removeGalleryItem = function() {
        var self        = $(this);
        var galleryItem = self.parents('.image-gallery-item');

        galleryItem.slideUp(200);

        setTimeout(function() {
            galleryItem.remove();
        }, 200);
    }

    var addGalleryItem = function() {
        var template = _.template($('#image-gallery-item-template').html());
        $('.image-gallery-item-container').append(template({
            item: {}
        }));
    }

    var moveGalleryItem = function(event) {
        var currentGalleryItem  = $(this).parents('.image-gallery-item');
        var galleryItems        = currentGalleryItem.parent().find('.image-gallery-item');
        var dir                 = event.data.dir;
        var currentIndex        = galleryItems.index(currentGalleryItem);
        var targetIndex         = currentIndex + dir;
        var temp                = currentGalleryItem.clone(true);

        if (targetIndex < 0 || targetIndex >= galleryItems.length) return;

        if ( dir > 0) {
            galleryItems.eq(targetIndex).after(temp);
        } else {
            galleryItems.eq(targetIndex).before(temp);
        }

        currentGalleryItem.remove();
    }

    $(document).ready(function() {
        var imageGalleryData    = $.parseJSON('<?php echo json_encode($rows); ?>');
        var container           = $('.image-gallery-item-container');
        var template            = _.template($('#image-gallery-item-template').html());

        for(var i in imageGalleryData) {
            $('.image-gallery-item-container').append(template({item: imageGalleryData[i]}));
        }

        container.on('click', '.ccm-pick-gallery-image', pickGalleryItemImage);
        container.on('click', '.remove-image-gallery-item', removeGalleryItem);
        container.on('click', '.fa-sort-asc', {'dir':-1}, moveGalleryItem);
        container.on('click', '.fa-sort-desc', {'dir':1}, moveGalleryItem);
        $('.add-image-gallery-item').bind('click', addGalleryItem);
    });
</script>

<span class="btn btn-success add-image-gallery-item" href=""><?php echo t('Add New Image'); ?></span>

<div class="image-gallery-item-container"></div>

<script type="text/template" id="image-gallery-item-template">
    <div class="image-gallery-item ccm-ui well">
        <i class="fa fa-sort-desc"></i>
        <i class="fa fa-sort-asc"></i>
        <div class="form-group">
            <label><?php echo t('Image') ?></label>
            <div class="ccm-pick-gallery-image">
                <% if (item.thumbnail) { %>
                <img src="<%= item.file_manager_image %>" alt=""/>
                <% } else { %>
                <i class="fa fa-picture-o"></i>
                <% } %>
            </div>
            <input type="hidden" name="fID[]" class="image-fID" value="<%= item.fID %>" />
        </div><!-- .form-group -->

        <div class="form-group">
            <label>Alternative <?php echo t('Title') ?></label>
            <input type="text" name="title[]" value="<%= item.title %>" />
        </div><!-- .form-group -->

        <div class="form-group">
            <span class="btn btn-danger remove-image-gallery-item"><?php echo t('Remove Image'); ?></span>
        </div><!-- .form-group -->
    </div><!-- .image-gallery-item -->
</script>

<style>
    .ccm-pick-gallery-image {
        padding: 15px;
        cursor: pointer;
        background: #dedede;
        border: 1px solid #cdcdcd;
        text-align: center;
        vertical-align: center;
  
    }

    .ccm-pick-gallery-image img {
        height: 15rem;
  
    }

    .image-gallery-item-container input[type="text"] {
        display: block;
        width: 100%;
    }
    .ccm-ui .btn.add-image-gallery-item {
        margin-bottom: 20px;
        display: inline-block;
    }
    .image-gallery-item {
        position: relative;
    }
    .image-gallery-item i.fa-sort-asc {
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
    }
    .image-gallery-item i.fa-sort-desc {
        position: absolute;
        top: 15px;
        cursor: pointer;
        right: 10px;
    }
</style>