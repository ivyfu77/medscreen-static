
var isClicked = false;
function toggleMenu() {
	isClicked = !isClicked;
	var obj = document.getElementById("popup");
	if (isClicked) {
	  obj.className += "open";
	} else {
	  obj.className = "";
	}
}

$('#contactUs').submit(function() {
	$("#sendMsg").hide();
	$.ajax({
	    url: "PHPMailer/gmail.php", 
	    method: "POST",
	    data: {
	    	name: $('#name').val(),
	    	email: $('#email').val(),
	    	message: $("#comments").val()
	    },
	    dataType: "json",
	    success: function(data) {
	    	console.log(data);
	    	if (data.status == "success") {
	    		$('#name').val("");
	    		$('#email').val("");
	    		$("#comments").val("");
	    		$("#sendMsg").text(data.message);
	    		$("#sendMsg").css("color", "#26b899");
	    		$("#sendMsg").show(0).delay(5000).hide(0);;
	    	} else if (data.status == "error") {
	    		$("#sendMsg").text("Sorry can't send your message now.");
	    		$("#sendMsg").css("color", "#e2372a");
	    		console.log(data.message);
	    		$("#sendMsg").show(0).delay(3000).hide(0);    		
	    	}
	    },
	    error: function() {
	    	$("#sendMsg").text("Server Error.");
	    	$("#sendMsg").css("color", "#e2372a");
	    	$("#sendMsg").show(0).delay(3000).hide(0);
	    }
	});
	return false;
});
