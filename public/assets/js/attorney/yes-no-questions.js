(function (window, document, $) {
  'use strict';

  if (typeof $ === 'undefined') {
    console.warn('[yes-no-questions] jQuery is required');
  }

  const cfg = window.YesNoQuestionsConfig || {};

  function ajax(url, data, cb) {
    if (typeof laws !== 'undefined' && typeof laws.ajax === 'function') {
      laws.ajax(url, data, cb);
    } else {
      $.ajax({ url: url, method: 'POST', data: data }).done(cb);
    }
  }

  function initValidation() {
    if (typeof $.fn.validate !== 'function') return;
    $("#add_form").validate({
      errorPlacement: function (error, element) {
        const $fg = $(element).parents('.form-group');
        const $next = $fg.next('label');
        if ($next.hasClass('error')) $next.remove();
        $fg.after($(error)[0].outerHTML);
      },
      success: function (label, element) {
        label.parent().removeClass('error');
        $(element).parents('.form-group').next('label').remove();
      }
    });
  }

  // Expose functions used by onclick handlers
  window.edit_question = function edit_question(id) {
    const $input = $(".edit_question_input_" + id);
    if ($input.hasClass('form-control-none')) {
      $input.removeClass('form-control-none')
        .addClass('form-control form-control-custom-padding')
        .attr('readonly', false);
      $(".edit_question_" + id).addClass('d-none');
      $(".edit_question_submit_" + id).removeClass('d-none');
    }
  };

  window.update_question_fn = function update_question_fn(id, prev_question) {
    const url = (cfg.routes && cfg.routes.update) || '';
    const $input = $(".edit_question_input_" + id);
    const new_question = $input.val();
    if (new_question === '') {
      $.systemMessage('Question cannot be empty!', 'alert--danger', true);
      $input.focus();
      return;
    }
    if (prev_question == new_question) {
      window.updateclasses(id);
      return;
    }
    if (!confirm('Do you want to update question?')) return;

    $('#page_loader').show();
    ajax(url, { question_id: id, new_question: new_question }, function (res) {
      var ans = (typeof res === 'string') ? $.parseJSON(res) : res;
      $('#page_loader').hide();
      if (ans.status == 1) {
        $.systemMessage(ans.msg, 'alert--success', true);
        $input.val(new_question);
        window.updateclasses(id);
      } else {
        $.systemMessage(ans.msg, 'alert--danger', true);
      }
    });
  };

  window.soft_delete_question = function soft_delete_question(id) {
    const url = (cfg.routes && cfg.routes.delete) || '';
    if (!confirm('Do you want to delete question?')) return;
    ajax(url, { question_id: id }, function (res) {
      var ans = (typeof res === 'string') ? $.parseJSON(res) : res;
      if (ans.status == 1) {
        $.systemMessage(ans.msg, 'alert--success', true);
        $(".tr_" + id).fadeOut();
      } else {
        $.systemMessage(ans.msg, 'alert--danger', true);
      }
    });
  };

  window.updateclasses = function updateclasses(id) {
    const $input = $(".edit_question_input_" + id);
    $input.removeClass('form-control mr-2 form-control-custom-padding')
      .addClass('form-control-none')
      .attr('readonly', true);
    $(".edit_question_" + id).removeClass('d-none');
    $(".edit_question_submit_" + id).removeClass('pt-2').addClass('d-none');
  };

  $(function () {
    initValidation();
  });
})(window, document, window.jQuery);


