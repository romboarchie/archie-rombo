jQuery(document).ready(function ($) {

    // Initialize Color Picker
    $('.my-color-field').wpColorPicker();

    // Generic Media Uploader Logic
    var mediaUploader;

    $('.upload-media-button').click(function (e) {
        e.preventDefault();
        var button = $(this);
        var inputField = button.data('input');
        var previewImg = button.data('preview');

        if (mediaUploader) {
            mediaUploader.off('select');
        }

        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Media',
            button: {
                text: 'Use this media'
            },
            multiple: false
        });

        mediaUploader.on('select', function () {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            $(inputField).val(attachment.id);
            $(previewImg).attr('src', attachment.url).show();
            button.siblings('.remove-media-button').show();
        });

        mediaUploader.open();
    });

    $('.remove-media-button').click(function (e) {
        e.preventDefault();
        var button = $(this);
        var inputField = button.data('input');
        var previewImg = button.data('preview');

        $(inputField).val('');
        $(previewImg).attr('src', '').hide();
        button.hide();
    });
});
