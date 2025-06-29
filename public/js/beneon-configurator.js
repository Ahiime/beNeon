jQuery(document).ready(function($){
    function updatePreview(){
        var text = $('#beneon-text').val();
        var color = $('#beneon-color').val();
        var font = $('#beneon-font').val();
        var size = $('#beneon-size').val();
        $('#beneon-preview').css({
            'color': color,
            'font-family': font,
            'font-size': size + 'px'
        }).text(text);
    }

    $('#beneon-configurator').on('input change', '#beneon-text, #beneon-color, #beneon-font, #beneon-size', updatePreview);
    updatePreview();
});
