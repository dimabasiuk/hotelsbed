/**
 * Created by dzozulya on 12.02.17.
 */
$(function () {

    $('#generate-button').on('click', function(e){
        e.preventDefault();
        console.log('test');
        $.ajax({
            url: '/admin/user/generate-password',
            method: 'post',
            success: function(data) {

                $('#password-field').val(data.password);
            }
        });
    });
});
