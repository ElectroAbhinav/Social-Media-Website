$(document).ready(function(){
	//On click signup, hide login and show registration.
	$("#signup").click(function(){
		$("#first").slideUp("slow",function(){
			$("#second").slideDown("slow");
		});
	});
});

$(document).ready(function(){
	//on click signin, hide signup and show login.
	$("#signin").click(function(){
		$("#second").slideUp("slow",function(){
			$("#first").slideDown("slow");
		});
	});
});