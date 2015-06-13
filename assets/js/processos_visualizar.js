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

  $('#evento').on('change', function(e) {

    var value = this.value;

    if (value == 4 || value == 5) {
      $('#form_complemento').show();
    } else {
      $('#form_complemento').hide();
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