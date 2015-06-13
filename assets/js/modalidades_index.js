$(document).ready(function() {

  $.fn.editable.defaults.mode = 'inline';

  $('.nome').editable({
    validate: function(value) {
     if($.trim(value) === '') return 'Campo obrigatório';
    }
  });

});