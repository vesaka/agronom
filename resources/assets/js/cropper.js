var Cropper = {
    URL: window.URL || window.webkitURL,
    $image: $('#image'),
    options: {},
    originalImageURL: '',
    uploadedImageType: 'image/jpeg',
    uploadedImageURL: '',
    $inputImage: $('#inputImage'),
    holder: $('[name="crop_data"]'),
    refresh: function (e) {
        Cropper.holder.val(JSON.stringify({
            x: parseInt(e.x),
            y: parseInt(e.y),
            width: parseInt(e.width),
            height: parseInt(e.height)
        }));
    },
    init: function (options) {
        this.options = options;
        $('[data-toggle="tooltip"]').tooltip();
        this.$image.on({
            ready: function (e) {
            },
            crop: function (e) {
                Cropper.refresh(e);
            }
        }).cropper(this.options);

        $('.controls').on('click', '[data-method]', function () {
            var $this = $(this),
                    data = $this.data(),
                    $target,
                    result;
                    console.log(this);
            if (Cropper.$image.data('cropper') && data.method) {
                data = $.extend({}, data); // Clone a new one

                if (typeof data.target !== 'undefined') {
                    $target = $(data.target);

                    if (typeof data.option === 'undefined') {
                        try {
                            data.option = JSON.parse($target.val());
                        } catch (e) {
                            console.log(e.message);
                        }
                    }
                }

                result = Cropper.$image.cropper(data.method, data.option, data.secondOption);

                if ($.isPlainObject(result) && $target) {
                    try {
                        $target.val(JSON.stringify(result));
                    } catch (e) {
                        console.log(e.message);
                    }
                }

            }
        });

        if (this.URL) {
            this.$inputImage.change(function () {
                var files = this.files,
                        file,
                        uploadedImageType;

                if (!Cropper.$image.data('cropper')) {
                    return;
                }

                if (files && files.length) {
                    file = files[0];
                    console.log(file);
                    if (/^image\/\w+$/.test(file.type)) {
                        uploadedImageType = file.type;

                        if (this.uploadedImageURL) {
                            Cropper.URL.revokeObjectURL(this.uploadedImageURL);
                        }

                        this.uploadedImageURL = Cropper.URL.createObjectURL(file);
                        Cropper.$image.cropper('destroy').attr('src', this.uploadedImageURL).cropper(Cropper.options);
                    } else {
                        window.alert('Please choose an image file.');
                    }
                }
            });
        } else {
            this.$inputImage.prop('disabled', true).parent().addClass('disabled');
        }
    }

};

$(function () {

    'use strict';

    // Keyboard
    $(document.body).on('keydown', function (e) {

        if (!Cropper.$image.data('cropper') || this.scrollTop > 300) {
            return;
        }

        switch (e.which) {
            case 37:
                e.preventDefault();
                Cropper.$image.cropper('move', -1, 0);
                break;

            case 38:
                e.preventDefault();
                Cropper.$image.cropper('move', 0, -1);
                break;

            case 39:
                e.preventDefault();
                Cropper.$image.cropper('move', 1, 0);
                break;

            case 40:
                e.preventDefault();
                Cropper.$image.cropper('move', 0, 1);
                break;
        }
    });

});



