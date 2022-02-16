$(document).ready(function(){
    
    $('#cancel').click(function() {
        $("input").removeAttr("required");
    });
      
    $('#delete').click(function() {
        $("input").removeAttr("required");
    });
  
    $('#toggle_pwd').click(function() {
        var txt = $('.passwd').is(":hidden") ? 'hide' : 'show';
        $('#toggle_pwd').html(txt).toggleClass('hid');
        $('.passwd').toggle('fast');
    });
  
});
