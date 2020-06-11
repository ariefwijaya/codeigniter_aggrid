(function(window,undefined){

	var $ = window.jQuery;
	  
   
	  $.debounce = function (func, wait, immediate) {
		  var timeout;
		  return function() {
			  var context = this, args = arguments;
			  var later = function() {
				  timeout = null;
				  if (!immediate) func.apply(context, args);
			  };
			  var callNow = immediate && !timeout;
			  clearTimeout(timeout);
			  timeout = setTimeout(later, wait);
			  if (callNow) func.apply(context, args);
		  };
	  };


	  $.showToast = function(message, toastType = "") {
		switch (toastType) {
			case "error":
				iziToast.error({
					title: "Oops..",
					message: message,
					position: 'bottomCenter'
				});
				break;
			case "warning":
				iziToast.warning({
					title: "Warning!",
					message: message,
					position: 'bottomCenter'
				});
				break;
			case "info":
				iziToast.info({
					message: message,
					position: 'bottomCenter'
				});
			case "success":
				iziToast.success({
					title: "Success!",
					message: message,
					position: 'bottomCenter'
				});
				break;
			default:
				iziToast.show({
					message: message,
					position: 'bottomCenter'
				});
				break;
		}
	};

	$.checkAudioDuration =  function(audioSelector, durationSelector = null) {
        var audio = $(audioSelector)[0];
        if (audio != undefined && !isNaN(audio.duration) ) {
            var duration = audio.duration;
            if (durationSelector) {
                $(durationSelector).val(duration);
            } else {
                $.showToast("Audio Duration is " + duration + " Seconds", 'info');
            }
        } else {
            $.showToast("Audo file not found or Failed to get audio file!", "error");
        }
    };
	
  })(this);


  