document.addEventListener("DOMContentLoaded",function() {
	console.log("submission_id.js loaded");
    document.addEventListener( 'wpcf7submit', function( event ) {
		// if validation is not failed
		if(event.detail.status != 'validation_failed'){
			//Form is submitted and validated ok, make AJAX call to update the ID
			var formid = event.detail.contactFormId;
			var id_value = document.querySelectorAll('[class*="wpcf7-submission_id"]');
			
			if (id_value.length > 0){
				value = id_value[0].value;
				
				var request = new XMLHttpRequest();

				request.open('POST', cf7_submission_id_object.ajax_url, true);
				request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
				request.onload = function () {
					if (this.status >= 200 && this.status < 400) {
						// If successful
						//console.log(this.response);
						counter_value = this.response;
						document.querySelectorAll(".wpcf7-submission_id, .wpcf7-submission_id_hidden").forEach( function(submission_id) {
							//console.log(submission_id);
							submission_id.value = counter_value;
						});
					}else {
						// If fail
						console.log(this.response);

					}
				};
				request.onerror = function() {
					// Connection error
				};
				request.send("action=update_cf7_submission_id&formid="+formid+"&id_value="+value);
				
			}
		}
	})
});