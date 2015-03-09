
		<script language="javascript" type="text/javascript">
			//Browser Support Code
			function quizAddQuestion() {
				var ajaxRequest;
				// The variable that makes Ajax possible!

				try {
					// Opera 8.0+, Firefox, Safari
					ajaxRequest = new XMLHttpRequest();
				} catch (e) {
					// Internet Explorer Browsers
					try {
						ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
					} catch (e) {
						try {
							ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
						} catch (e) {
							// Something went wrong
							alert("Your browser broke!");
							return false;
						}
					}
				}
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function() {//motta en funksjon
					if (ajaxRequest.readyState == 4) {// Status = 4 betyr at responsen er ferdig og vi kan motta data
						// Get the data from the server's response
					
						var ajaxDisplay = document.getElementById('ajaxDiv');
						ajaxDisplay.innerHTML = ajaxRequest.responseText;
						document.getElementById('quiz_question').value = '';
						document.getElementById('quiz_answ_corr').value = '';
						document.getElementById('quiz_answ_wrong1').value = '';
						document.getElementById('quiz_answ_wrong2').value = '';
						document.getElementById('quiz_answ_wrong3').value = '';
					

					}
				};
				var question = document.getElementById('quiz_question').value;
				var corr_answr = document.getElementById('quiz_answ_corr').value;
				var wrong1 = document.getElementById('quiz_answ_wrong1').value;
				var wrong2 = document.getElementById('quiz_answ_wrong2').value;
				var wrong3 = document.getElementById('quiz_answ_wrong3').value;
		
				var queryString = "?question=" + question + "&corr_answr=" + corr_answr + "&wrong1=" + wrong1 + "&wrong2=" + wrong2 + "&wrong3=" + wrong3;
				//var queryString = "?admin_insertgname=" + admin_insertgname; //ny

				ajaxRequest.open("GET", "adminfilldb.php" + queryString, true); 
				ajaxRequest.send(null);
				// Sender forespørsel til serveren

			}
			
			
			<script language="javascript" type="text/javascript">
			//Browser Support Code
			function quizAddQuestion() {
				var ajaxRequest;
				// The variable that makes Ajax possible!

				try {
					// Opera 8.0+, Firefox, Safari
					ajaxRequest = new XMLHttpRequest();
				} catch (e) {
					// Internet Explorer Browsers
					try {
						ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
					} catch (e) {
						try {
							ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
						} catch (e) {
							// Something went wrong
							alert("Your browser broke!");
							return false;
						}
					}
				}
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function() {//motta en funksjon
					if (ajaxRequest.readyState == 4) {// Status = 4 betyr at responsen er ferdig og vi kan motta data
						// Get the data from the server's response
					
						var ajaxDisplay = document.getElementById('ajaxDiv');
						ajaxDisplay.innerHTML = ajaxRequest.responseText;
						document.getElementById('quiz_question').value = '';
						document.getElementById('quiz_answ_corr').value = '';
						document.getElementById('quiz_answ_wrong1').value = '';
						document.getElementById('quiz_answ_wrong2').value = '';
						document.getElementById('quiz_answ_wrong3').value = '';
					

					}
				};
				var question = document.getElementById('quiz_question').value;
				var corr_answr = document.getElementById('quiz_answ_corr').value;
				var wrong1 = document.getElementById('quiz_answ_wrong1').value;
				var wrong2 = document.getElementById('quiz_answ_wrong2').value;
				var wrong3 = document.getElementById('quiz_answ_wrong3').value;
		
				var queryString = "?question=" + question + "&corr_answr=" + corr_answr + "&wrong1=" + wrong1 + "&wrong2=" + wrong2 + "&wrong3=" + wrong3;
				//var queryString = "?admin_insertgname=" + admin_insertgname; //ny

				ajaxRequest.open("GET", "adminfilldb.php" + queryString, true); 
				ajaxRequest.send(null);
				// Sender forespørsel til serveren

			}

		</script>
		
