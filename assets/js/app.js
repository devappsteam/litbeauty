(function ($) {
    'use strict';

    $(function () {

        $('#__video_production').on('click', function () {
            var newVideo = $('<video>');
            newVideo.attr('src', '/wp-content/uploads/2023/07/producao_gommies.mp4');
            newVideo.attr('autoplay', '');
            newVideo.attr('controls', '');
            newVideo.attr('width', '100%');
            newVideo.attr('height', 'auto');
            $(this).html(newVideo);
        });

        $('#__video_influence').on('click', function () {
            var newVideo = $('<video>');
            newVideo.attr('src', '/wp-content/uploads/2023/07/producao_gommies.mp4');
            newVideo.attr('autoplay', '');
            newVideo.attr('controls', '');
            newVideo.attr('width', '100%');
            newVideo.attr('height', 'auto');
            $(this).html(newVideo);
        });
    });
})(jQuery);