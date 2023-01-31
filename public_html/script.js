function ShowSignInForm() {
  var T = document.getElementById("sign-in");
  if (T.style.display == "none") {
    T.style.display = "block";
  } else {
    T.style.display = "none";
  }
}

function ShowRegistrationForm() {
  var T = document.getElementById("register");
  if (T.style.display == "none") {
	T.style.display = "block";
   } else {
	T.style.display = "none";
   }
}
