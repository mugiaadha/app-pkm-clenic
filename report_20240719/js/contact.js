$(document).ready(function(){	
	$("#contactForm").submit(function(event){
		submitForm();
		return false;
	});
});
// function to handle form submit
function submitForm(){
	 $.ajax({
		type: "POST",
		url: "x.php",
		cache:false,
		data: $('form#contactForm').serialize(),
		success: function(response){
			// $("#contact").html(response)
			// $("#signa").modal('hide');
		},
		error: function(){
			alert("Error");
		}
	});
}