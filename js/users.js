$(document).ready(function(){
    
    $('#cancel').click(function() {
        $("input").removeAttr("required");
    });
      
    $('#delete').click(function() {
        $("input").removeAttr("required");
    });
  
    // hide or show passwords (too wide column)
    $('#toggle_compact').click(function() {
        $('.ul_toggle').toggleClass('compact');
        var txt = $('.ul_toggle').hasClass("compact") ? 'expand' : 'compact';
        $('#toggle_compact').html(txt);
    });
  
    $('#toggle_pwd').click(function() {
        var txt = $('.passwd').is(":hidden") ? 'hide' : 'show';
        $('#toggle_pwd').html(txt).toggleClass('hid');
        $('#pwd_th').toggle();
        $('.passwd').toggle('fast');
    });
  
});
