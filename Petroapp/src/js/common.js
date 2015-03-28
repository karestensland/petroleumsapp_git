/*
 * Her er kode for å hente aktiv gruppe
 *
 */
window.onload = function getGroupNameAndID() {
	var data = {
		"test" : "test"
	};
	data = $(this).serialize() + "&" + $.param(data);

	$.ajax({
		type : "GET",
		contentType : "application/json; charset=utf-8",
		dataType : "json",
		url : "getActiveGroup.php", //Relative or absolute path to response.php file
		data : data,
		success : function(data) {
			console.log("success");
			console.log(data);

			groupName = data.groupName;
			console.log(groupName);
			groupId = data.groupId;
			console.log(groupId);

			//add data to html
			$("#groupName").html(groupName);

		},
		error : function(jqXHR, textStatus, errorThrown) {
			console.log("error");
			console.log(jqXHR);
			console.log(textStatus);
			console.log(errorThrown);
		}
	});
	return false;
};

//Denne funksjonen sjekker om user eksisterer og videre fylle inn i databasen før den går videre
//http://stackoverflow.com/questions/932653/how-to-prevent-buttons-from-submitting-forms
$(function()// execute once the DOM has loaded
{
	$("#setUserNameAndContinue").click(function(event) {
		var thisButton = this;
		var hrefValue = thisButton.getAttribute("href");

		event.preventDefault();
		// cancel default behavior

		/**
		 *Sjekk om user navnet eksisterer.
		 *Hvis ikke, så gi tilbakemelding.
		 *Om det er ledig, skriv til db + cookie.
		 *
		 * Hent user name  -- js -ferdig
		 * Sjekk username ledig -php /serverside -ferdig
		 * Hvis ikke ledig:
		 * 		gi tilbakemelding til bruker -js -ferdig
		 * 		vent for ny imput fra bruker -js
		 *  Hvis ledig:
		 * 		skrive til db -php -ferdig
		 * 		skrive til cookie
		 *
		 * Ferdig
		 *
		 *
		 *
		 */

		//get user name
		var userName = document.getElementById("userName").value;
		var data = {
			"userName" : userName,
			"groupId" : groupId
		};

		data = $(this).serialize() + "&" + $.param(data);
		var continueApp = false;
		$.ajax({
			type : "GET",
			contentType : "application/json; charset=utf-8",
			dataType : "json",
			url : "setUserName.php", //Relative or absolute path to response.php file
			data : data,
			success : function(data) {
				console.log("success set username");
				console.log(data);
				if (data === "user exists") {

					$("#userExistAlert").html("Brukeren eksisterer. Velg annet brukernavn!");
				} else {
					userId = data;
					
					//continue in app
					window.location.href = hrefValue;

					//Set cookie
					setCookie(groupName, groupId, userName, userId);
					
					//update title
					createTitle();
				}
			},
			error : function(jqXHR, textStatus, errorThrown) {
				console.log("error");
				console.log(jqXHR);
				console.log(textStatus);
				console.log(errorThrown);
			}
		});
		//return false;
	});
});

function createTitle() {
				document.getElementById("group_title").innerHTML = "Velkommen&nbsp;&nbsp;" + userName + "!";
			}



//preventing double tap zoom
(function($) {//https://gist.github.com/johan/2047491
	$.fn.nodoubletapzoom = function() {
		$(this).bind('touchstart', function preventZoom(e) {
			var t2 = e.timeStamp,
			    t1 = $(this).data('lastTouch') || t2,
			    dt = t2 - t1,
			    fingers = e.originalEvent.touches.length;
			$(this).data('lastTouch', t2);
			if (!dt || dt > 500 || fingers > 1)
				return;
			// not double-tap

			e.preventDefault();
			// double tap - prevent the zoom
			// also synthesize click events we just swallowed up
			$(this).trigger('click').trigger('click');
		});
	};
})(jQuery);

function BlockMove() {
	event.preventDefault();
	//Hindrer Safari i å flytte vinduet
}	//http://matt.might.net/articles/how-to-native-iphone-ipad-apps-in-javascript/

