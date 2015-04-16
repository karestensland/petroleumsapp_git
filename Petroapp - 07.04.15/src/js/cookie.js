groupName = "";
groupId = "";
userName = "";
userId = "";

function setCookie(groupName1, groupId1, userName1, userId1) {
	groupName=groupName1;
	groupId=groupId1;
	userName= userName1;
	userId=userId1;
	/*console.log(groupName);
	console.log(groupId);
	console.log(userName);
	console.log(userId);*/
	var d = new Date();
	d.setTime(d.getTime() + (1 * 24 * 60 * 60 * 1000));
	var expires = "expires=" + d.toGMTString();
	document.cookie = "groupName=" + groupName + "; " + expires;
	document.cookie = "groupId=" + groupId + "; " + expires;
	document.cookie = "userName=" + userName + "; " + expires;
	document.cookie = "userId=" + userId + "; " + expires;

}

function getCookie(gname) {
	var name = gname + "=";
	var ca = document.cookie.split(';');
	for (var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ')
		c = c.substring(1);
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}


function getAllCookies(){
	groupName = getCookie("groupName");
	groupId = getCookie("groupId");
	userName = getCookie("userName");
	userId = getCookie("userId");

}

function test1() {
	console.log("Gruppenavn: " + groupName);
	console.log("GruppeId: " + groupId);
}

/*
 function checkCookie() {
 var user=getCookie("username");
 if (user != "") {
 alert("Welcome again " + user);
 } else {
 user = prompt("Please enter your name:","");
 if (user != "" && user != null) {
 setCookie("username", user, 1);
 }
 }
 }
 */
