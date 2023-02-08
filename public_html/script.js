function ShowSignInForm() {
  document.getElementById("sign in").style.display = "block";
}

function CloseSignInForm() {
  document.getElementById("sign in").style.display = "none";
}

function ShowRegistrationForm() {
document.getElementById("register").style.display = "block";
}

function CloseRegistrationForm() {
  document.getElementById("register").style.display = "none";
}

function ShowPassTheSame() {
  var T = document.getElementById("passTheSame");

  if ( document.getElementById("passReg").value !=
    document.getElementById("confirmReg").value) {
    T.style.display = "block";
    document.getElementById("submitReg").disabled = true;
  } else {
    T.style.display = "none";
    document.getElementById("submitReg").disabled = false;
  }
}
