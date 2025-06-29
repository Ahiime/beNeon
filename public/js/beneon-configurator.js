jQuery(document).ready(function($){
    function updatePreview(){
        var text = $('#beneon-text').val();
        var color = $('#beneon-color').val();
        var font = $('#beneon-font').val();
        var size = $('#beneon-size').val();
        var backboard = $('#beneon-backboard').val();

        var radius = 0;
        if(backboard && backboard.toLowerCase().indexOf('circle') !== -1){
            radius = '50%';
        } else if(backboard && backboard.toLowerCase().indexOf('rounded') !== -1){
            radius = '20px';
        }

        $('#beneon-preview').css({
            'color': color,
            'font-family': font,
            'font-size': size + 'px',
            'border-radius': radius
        }).text(text);
    }

    $('#beneon-configurator').on('input change', '#beneon-text, #beneon-color, #beneon-font, #beneon-size, #beneon-backboard', updatePreview);
    updatePreview();
});
