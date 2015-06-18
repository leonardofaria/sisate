$(document).on('change', '.btn-file :file', function() {
	var input = $(this),
	numFiles = input.get(0).files ? input.get(0).files.length : 1,
	label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
	input.trigger('fileselect', [numFiles, label]);
});

$(document).ready(function() {

	$('[data-toggle="tooltip"]').tooltip({html:true});

	$('.btn-file :file').on('fileselect', function(event, numFiles, label) {

		var input = $(this).parents('.input-group').find(':text'),
		log = numFiles > 1 ? numFiles + ' files selected' : label;

		if( input.length ) {
			input.val(log);
		} else {
			if(log) alert(log);
		}

	});

  (function() {
    // Função anônima para obter um array
    // dos eventos que exigem documento
    $.getJSON("../../api/eventos", function(data) {
      var eventos = [];
      $.each(data, function(key, value) {
        if (value.documento == 'S') {
          eventos.push(value.id);
        }
      });

      $('#analisar_evento').data('eventos', eventos);
    });
  })();

  $('#analisar_evento').on('change', function(e) {

    var value = this.value;

    if (value == 4 || value == 5) {
      $('#form_complemento').show();
      $('#analisar_arquivos').removeProp('required');
      $('#analisar_arquivos').parent().parent().removeClass('has-error');
      $('#analisar_arquivos_erro').html('');
      $('#analisar_complemento').attr('required', 'required');
    } else if ($.inArray(parseInt(value), $(this).data('eventos')) > -1) {
      $('#form_complemento').hide();
      $('#analisar_complemento').removeProp('required');
      $('#analisar_arquivos').attr('required', 'required');
      $('#analisar_arquivos_erro').show();
    } else {
      $('#form_complemento').hide();
      $('#analisar_complemento, #analisar_arquivos').removeProp('required');
    }

  });

  /* http://stackoverflow.com/questions/18422223/bootstrap-3-modal-vertical-position-center */
  function adjustModalMaxHeightAndPosition(){
    $('.modal').each(function(){
      if($(this).hasClass('in') === false){
          $(this).show(); /* Need this to get modal dimensions */
      }
      var contentHeight = $(window).height() - 60;
      var headerHeight = $(this).find('.modal-header').outerHeight() || 2;
      var footerHeight = $(this).find('.modal-footer').outerHeight() || 2;

      $(this).find('.modal-content').css({
        'max-height': function () {
          return contentHeight;
        }
      });

      $(this).find('.modal-body').css({
        'max-height': function () {
          return (contentHeight - (headerHeight + footerHeight));
        }
      });

      $(this).find('.modal-dialog').addClass('modal-dialog-center').css({
        'margin-top': function () {
          return -($(this).outerHeight() / 2);
        },
        'margin-left': function () {
          return -($(this).outerWidth() / 2);
        }
      });
      if($(this).hasClass('in') === false){
        $(this).hide(); /* Hide modal */
      }
    });
  }

  if ($(window).height() >= 320){
    $(window).resize(adjustModalMaxHeightAndPosition).trigger("resize");
  }
});