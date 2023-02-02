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

function ShowPassTheSame() {
  var T = document.getElementById("passTheSame");
  
  if (
    document.getElementById("passReg").value !=
    document.getElementById("confirmReg").value
  ) {
    T.style.display = "block";
    document.getElementById("submitReg").disabled = true;
  } else {
    T.style.display = "none";
    document.getElementById("submitReg").disabled = false;
  }
}
