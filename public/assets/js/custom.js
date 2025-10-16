
var langLbl = {
    "confirmNameUpdate": "Do you want to update name?",
    "confirmEmailUpdate": "Do you want to update email?",
    "confirmRemove": "Do you want to remove",
    "confirmReset": "Do you want to reset settings",
    "confirmDelete": "Do you want to delete",
    "confirmChange": "Do You want to change the status?",
    "confirmResend": "Do You want to resend Invite?",
    "processing": "Processing...",
    "confirmApprove": "Do you want to approve?",
    "confirmDecline": "Do you want to decline?",
    "confirmReuploading": "Do you want to enable reuploading?",
    "confirmUploadCRSReport": "Are you sure you want to run your Credit Report? \nBy selecting yes you are authorizing your attorney to run your credit report and import all of your creditors into the questionnaire.",
  };

  var siteConstants =  {
    "webroot": '/',
    "webroot_traditional": '/',
    "rewritingEnabled": true
  };


var laws = {
    ajaxRequestLog: [],
    logAjaxRequest: function (url, data, res) {
        var d = (new Date()).getTime();
        var last = d - 120000;
        var obj = {url: url,
            data: (typeof data == "object") ? JSON.stringify(data) : data,
            res: (typeof res == "object") ? JSON.stringify(res) : res,
            t: d};
        var repeatCount = 0;
        for (var i = laws.ajaxRequestLog.length - 1; i >= 0; i--) {
            var oldObj = laws.ajaxRequestLog[i];
            if (oldObj.t < last) {
                laws.ajaxRequestLog.splice(i, 1);
                continue;
            }
            if (oldObj.url == obj.url && oldObj.data == obj.data && oldObj.res == obj.res) {
                repeatCount++;
            }
        }
        if (repeatCount >= 10) {
            if (confirm('This page seems to be stuck with some ajax call loop.\nDo you want to reload the page?')) {
               location.reload(true);
            }
        }
        laws.ajaxRequestLog.push(obj);
    },
    ajax: function (url, data, fn, options) {
        var o = $.extend(true, {fOutMode: 'html', timeout: 300000, maxRetry: 0, retryNumber: 0}, options);
        if ("string" == $.type(data)) {
            data += '&fOutMode=' + o.fOutMode + '&fIsAjax=1';
        }
        if ("object" == $.type(data)) {
            var data = $.extend(true, {}, data);
            if (!data.isAjax)
                data.fIsAjax = 1;
            if (!data.fOutMode)
                data.fOutMode = o.fOutMode;
        }
        $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: url,
            data: data,
            dataType: o.fOutMode,
            success: function (t) {
                laws.logAjaxRequest(url, data, t);
                if (o.fOutMode == 'json') {
                    if (t.status == -1) {
                        alert(t.msg);
                        if (options.errorFn) {
                            options.errorFn();
                        }
                        return;
                    }
                }
                fn(t);
            },
            error: function (jqXHR, textStatus, error) {
                if (textStatus == "parsererror" && jqXHR.statusText == "OK") {
                    alert('Seems some json error.' + jqXHR.responseText);
                    return;
                }
                o.retryNumber++;
                if (o.retryNumber <= o.maxRetry) {
                    console.log('Will retry ' + o.retryNumber);
                    setTimeout(function () {
                        laws.ajax(url, data, fn, o)
                    }, 3000);
                }
            },
            timeout: o.timeout
        });
    },
    updateWithAjax: function (url, data, fn, options) {
        $.systemMessage(langLbl.processing, 'alert--process alert');
        var o = $.extend(true, {fOutMode: 'json'}, options);
        this.ajax(url, data, function (ans) {
            if (ans.status != 1) {
                $.systemMessage(ans.msg, 'alert alert--danger');
                return;
            }
            $.systemMessage(ans.msg, 'alert--success');
            fn(ans);
        }, o);
    },
    camel2dashed: function (str) {
        return str.replace(/([a-zA-Z])(?=[A-Z])/g, '$1-').toLowerCase();
    },
    breakUrl: function (url) {
        url = url.substring(2000);
        var arr = url.split('/');
        var obj = {controller: arr[0], action: '', others: []};
        arr.shift();
        if (!arr.length)
            return obj;
        obj.action = arr[0];
        arr.shift();
        obj.others = arr;
        return obj;
    },
    makeUrl: function (controller, action, others, use_root_url, urlRewritingEnabled) {
        if (typeof urlRewritingEnabled === 'undefined') {
            urlRewritingEnabled = (siteConstants.rewritingEnabled == 1);
        }
        if (!use_root_url) {
            use_root_url = (urlRewritingEnabled) ? siteConstants.webroot : siteConstants.webroot_traditional;
        }
        var url;
        if (!controller)
            controller = '';
        if (!action)
            action = '';
        controller = this.camel2dashed(controller);
        action = this.camel2dashed(action);
        if (!others) {
            others = [];
        }

        if ('' == action && others.length)
            action = 'index';
        url = use_root_url + controller;
        if ('' != action)
            url += '/' + action;
        if (others.length) {
            for (x in others)
                others[x] = encodeURIComponent(others[x]);
            url += '/' + others.join('/');
        }
        if (typeof ezcalcToken != 'undefined') {
            url += '?_token=' + ezcalcToken;
        }
        return url;
    },
    frmData: function (frm) {
        return $(frm).serialize();
    },
    qStringToObject: function (q) {
        var args = new Object();
        var pairs = q.split("&");
        for (var i = 0; i < pairs.length; i++) {
            var pos = pairs[i].indexOf('=');
            if (pos == -1)
                continue;
            var argname = pairs[i].substring(0, pos);
            var value = pairs[i].substring(pos + 1);
            args[argname] = unescape(value);
        }
        return args;
    },
    urlWrittenQueryObject: function () {
        var url = location.pathname;
        url = url.substring(siteConstants.userWebRoot.length);
        var arr = url.split('/');
        if (arr.length <= 2)
            return {};
        arr.shift();
        arr.shift();
        var obj = {};
        for (var i = 0; i < arr.length; i += 2) {
            obj[arr[i]] = arr[i + 1];
        }
        return obj;
    },
    getLoader: function () {
        return '<div class="circularLoader loader-Js"><svg width="30" height="30" class="circular"><circle stroke-miterlimit="10" stroke-width="6" fill="none" r="19.9" cy="25.2" cx="25" class="path"/></svg></div>';
    },
    displayProcessing: function (msg, cls, autoclose) {
        if (typeof msg == 'undefined' || msg == 'undefined') {
            msg = langLbl.processing;
        }
        $.systemMessage(msg, 'alert--process', autoclose);
    },
    ajaxMultipart: function (url, data, fn, options) {
        var o = $.extend(true, {fOutMode: 'html', timeout: 300000, maxRetry: 0, retryNumber: 0}, options);
        if ("object" == $.type(data)) {
            data.append("fIsAjax", 1);
            data.append("fOutMode", o.fOutMode);
        }
        $.ajax({
            method: "POST",
            enctype: 'multipart/form-data',
            url: url,
            data: data,
            dataType: o.fOutMode,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 300000,
            success: function (t) {
                laws.logAjaxRequest(url, data, t);
                if (o.fOutMode == 'json') {
                    if (t.status == -1) {

                        if (options.errorFn) {
                            options.errorFn();
                        }
                        return;
                    }
                }
                fn(t);
            },
            error: function (jqXHR, textStatus, error) {
                if (textStatus == "parsererror" && jqXHR.statusText == "OK") {
                    alert('Seems some json error.' + jqXHR.responseText);
                    return;
                }
                o.retryNumber++;
                if (o.retryNumber <= o.maxRetry) {
                    console.log('Will retry ' + o.retryNumber);
                    setTimeout(function () {
                        laws.ajax(url, data, fn, o)
                    }, 3000);
                } else {
                    if (!options.errorFn) {
                        alert(jqXHR.statusText + '\n' + textStatus);
                    }
                }
                console.log("Ajax Request " + url + " error: " + textStatus + " -- " + error);
                if (options.errorFn) {
                    options.errorFn();
                }
            },
            timeout: o.timeout
        });
    },
};

$.extend(laws, {
    getLoader: function() {
        return '<div class="loader-yk"><div class="loader-yk-inner"></div></div>';
    },

    scrollToTop: function(obj) {
        if (typeof obj == undefined || obj == null) {
            $('html, body').animate({
                scrollTop: $('html, body').offset().top - 100
            }, 'slow');
        } else {
            $('html, body').animate({
                scrollTop: $(obj).offset().top - 100
            }, 'slow');
        }
    },
    resetEditorInstance: function() {
        if (extendEditorJs == true) {
            var editors = oUtil.arrEditor;
            for (x in editors) {
                eval('delete window.' + editors[x]);
            }
            oUtil.arrEditor = [];
        }
    },

    resetEditorWidth: function(width = "100%") {
        if (typeof oUtil != 'undefined') {
            (oUtil.arrEditor).forEach(function(input) {
                var oEdit1 = eval(input);
                $("#idArea" + oEdit1.oName).attr("width", width);
            });
        }
    },

    setEditorLayout: function(lang_id) {
        if (extendEditorJs == true) {
            var editors = oUtil.arrEditor;
            layout = langLbl['language' + lang_id];
            for (x in editors) {
                $('#idContent' + editors[x]).contents().find("body").css('direction', layout);
            }
        }
    },

    resetFaceboxHeight: function() {
        var screenHeight = $(window).height();
      

         /*$('html').css('overflow','hidden');*/
        facebocxHeight = screenHeight;
        var fbContentHeight = parseInt($('#facebox .content').height()) + 150; // Additional height calculation
    
        setTimeout(function() {
            var adjustedHeight = 0.9 * screenHeight; // 90% of screen height
            $('#facebox .content').css('max-height', '100vh'); // Set max-height
            
        }, 700); // Timeout delay for rendering
        
        $('#facebox .content').css('overflow-y', 'auto');
        if (fbContentHeight > screenHeight - parseInt(100)) {
            $('#facebox .content').css('display', 'block');
        } else {
            $('#facebox .content').css('max-height', '');
        }
    },
    updateFaceboxContent: function(t, cls) {
        if (typeof cls == 'undefined' || cls == 'undefined') {
            cls = '';
        }
        $.facebox(t, cls);
        $.systemMessage.close();
        laws.resetFaceboxHeight();
    },
});

$(document).bind('reveal.facebox', function() {
    laws.resetFaceboxHeight();
});

$(window).on("orientationchange", function() {
    laws.resetFaceboxHeight();
});

$(document).bind('loading.facebox', function() {
    $('#facebox .content').addClass('fbminwidth');
});

$(document).bind('afterClose.facebox', function() {
    $('html').css('overflow', '');
});

/* $(document).bind('afterClose.facebox', laws.resetEditorInstance); */
$(document).bind('beforeReveal.facebox', function() {
    $('#facebox .content').addClass('fbminwidth');
    $('html').css('overflow', '')
});

$(document).bind('reveal.facebox', function() {
    $('#facebox .content').addClass('fbminwidth');
});



$.systemMessage = function (message, alertType, autoClose) {
    $('.alert').removeClass('alert--success');
    $('.alert').removeClass('alert--danger');
    $('.alert').removeClass('alert--process');
    $('.alert').removeClass('alert--info');
    $('.alert').addClass((typeof alertType == 'undefined' || alertType == 'undefined') ? 'alert--info' : alertType);
    $('.alert .sysmsgcontent').html(message);
    $('.alert').fadeIn();
    if (typeof autoClose != 'undefined' && autoClose != 'undefined' && autoClose != false) {
        const messageEl = document.querySelector('.custom_alerting.sysmsgcontent');

    // Get the text content
    const text = messageEl?.textContent || '';
    
    // Count the number of words
    const wordCount = text.trim().split(/\s+/).length;
    const wordsPerSecond = 3.5; // moderate pace
    const bufferSeconds = 2;
    const timeout = wordCount > 0 ? (Math.ceil((wordCount / wordsPerSecond) + bufferSeconds) * 1000) : 3000; // in milliseconds
    if(wordCount>2){
       setTimeout(function () {
            $(document).trigger('close.sysmsgcontent');
        }, timeout);
    }else{
            setTimeout(function () {
                $(document).trigger('close.sysmsgcontent');
            }, 2000); 
        }
    }
    
};
$.extend($.systemMessage, {
    settings: {
        closeimage: 'images/facebox/close.gif',
    },
    initialize: function () {
        $('.alert .close').click($.systemMessage.close());
    },
    loading: function () {
        $('.alert').show();
    },
    fillSysMessage: function (data, cls, autoClose) {
        $('.alert').removeClass('alert--success');
        $('.alert').removeClass('alert--danger');
        $('.alert').removeClass('alert--process');
        if (cls) {
            $('.alert').addClass(cls);
        }

        $('.alert .sysmsgcontent').html(data);
        $('.alert').fadeIn();

        if (autoClose) {
            setTimeout(function () {
                $.systemMessage.close();
            }, 50000000);
        }
    },
    close: function () {

    },
});
function initialize() {

    $('.alert .close').click($.systemMessage.close);
}
$(document).on('click', '.close', function () {

    $(document).trigger('close.sysmsgcontent');
});
$(document).bind('close.sysmsgcontent', function () {

    $('.alert').fadeOut();
});

$(document).on('click', '.close', function () {

    $(document).trigger('close.sysmsgcontent');
});
function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true
}
$(document).ready(function(){
$(document).on("keyup", ".phone-number-field", function(evt) {


    var self = $(this);
    self.val(self.val().replace(/[^0-9\.]/g, ''));
    self.val(self.val().replace(/(\d{3})\-?(\d{3})\-?(\d{4})/,'$1-$2-$3'))
    var first10 = $(this).val().substring(0, 12);
    if (this.value.length > 12) {
        this.value = first10;
    }


});
$(document).on("change", ".convert-text-for-other", function(e) {
    if ($(this).val() == "-1") {
       $(this).next("div.other_income").removeClass("hide-data");
    }else{
        $(this).next("div.other_income").addClass("hide-data");
    }
});

$(document).ready(function () {
    $('.paystub-additional-date').on('change', function () {
        var $input = $(this);
        var enteredDate = new Date($input.val());
        var startDate = new Date($input.data('startdate'));
        var endDate = new Date($input.data('enddate'));
        var $formGroup = $input.closest('.form-group');

        // Remove existing error message
        $formGroup.next('.date-error-msg').remove();

        if (isNaN(enteredDate)) {
            showError("Please enter a valid date.");
            $input.val('');
            return;
        }

        if (enteredDate < startDate || enteredDate > endDate) {
            showError(`Please enter Pay Stub date between ${$input.data('startdate')} & ${$input.data('enddate')}.`);
            $input.val('');
        }

        function showError(message) {
            $('<div class="date-error-msg text-danger mt-1"><small class="fw-600">' + message + '</small></div>').insertAfter($formGroup);
        }
    });
});

});

packagePurchasePopup = function(ptype, client_id, ajaxurl ){
    laws.ajax(ajaxurl, { client_id:client_id,type:ptype}, function (response) {
      laws.updateFaceboxContent(response,'large-fb-width');
    });
  }

  payrollPurchasePopup = function(payroll_type,client_id,ajaxurl){
    laws.ajax(ajaxurl, { client_id:client_id,type:payroll_type}, function (response) {
      laws.updateFaceboxContent(response,'large-fb-width');
    });
  }

  servicePurchase = function(subscription_type,client_id,ajaxurl){
    laws.ajax(ajaxurl, { client_id:client_id,type:subscription_type}, function (response) {
    
      if(isJson(response)){
		var res = JSON.parse(response);
            if (res.status == 0) {
				$.systemMessage(res.msg, 'alert--danger', true);
            }else if(res.status == 1){
				$.systemMessage(res.msg, 'alert--success', true);
               
                setTimeout(function() {
                   location.reload(true);
                }, 1000);
			}
		} else {
            laws.updateFaceboxContent(response,'large-fb-width');
			}
    });
  }



  function copytoclip() {
    // Get the text field
    var copyText = document.getElementById("myInput");
  
    // Select the text field
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices
  
    // Copy the text inside the text field
    navigator.clipboard.writeText(copyText.value);
    
    // Alert the copied text
    alert("Copied the text: " + copyText.value);
  }

  // Function to copy URL from data attribute
  function copyFromDataUrl(element) {
    var url = $(element).data('url');
    var successMessage = $(element).data('success') || 'URL Copied!';
    
    if (!url) {
      console.error('No URL found in data-url attribute');
      return;
    }
    
    // Copy to clipboard
    if (navigator.clipboard && navigator.clipboard.writeText) {
      navigator.clipboard.writeText(url).then(function() {
        // Show success message
        laws.showSysMessage(successMessage, 'success');
      }).catch(function(err) {
        console.error('Failed to copy:', err);
        // Fallback method
        copyToClipboardFallback(url, successMessage);
      });
    } else {
      // Fallback for older browsers
      copyToClipboardFallback(url, successMessage);
    }
  }

  // Fallback copy method for older browsers
  function copyToClipboardFallback(text, successMessage) {
    var textArea = document.createElement("textarea");
    textArea.value = text;
    textArea.style.position = "fixed";
    textArea.style.top = "-9999px";
    textArea.style.left = "-9999px";
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();
    
    try {
      var successful = document.execCommand('copy');
      if (successful) {
        laws.showSysMessage(successMessage || 'URL Copied!', 'success');
      } else {
        console.error('Copy command failed');
        laws.showSysMessage('Failed to copy URL', 'error');
      }
    } catch (err) {
      console.error('Unable to copy:', err);
      laws.showSysMessage('Unable to copy URL', 'error');
    }
    
    document.body.removeChild(textArea);
  }

  function loginEye(){


  const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#password');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});

}

function showConfirmation(message, callback) {
    // Create custom modal HTML
    const modalHtml = `
        <div id="customConfirm" style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:9999;display:flex;justify-content:center;align-items:center;">
            <div style="background:white;padding:20px;border-radius:5px;max-width:80%;">
                <p>${message}</p>
                <div style="display:flex;justify-content:center;margin-top:20px;gap:1rem;">
                    <button id="confirmYes" class="btn-new-ui-default">Yes</button>
                    <button id="confirmNo" class="btn-new-ui-default">No</button>
                </div>
            </div>
        </div>
    `;
    
    // Add to body
    $('body').append(modalHtml);
    
    // Handle clicks
    $('#confirmYes').on('click', function() {
        $('#customConfirm').remove();
        callback(true);
    });
    
    $('#confirmNo').on('click', function() {
        $('#customConfirm').remove();
        callback(false);
    });
}


// Reuse the existing success modal as-is (no text overrides)
// Safe to call from anywhere after the page loads
window.showSuccessModal = function () {
    try {
        $('#successModal').modal('show');
    } catch (e) {
        console.error('showSuccessModal error:', e);
    }
};

