let signIn = document.getElementById("sign-in");
let register = document.getElementById("register");

function ShowSignInForm() {
  if (signIn.style.display == "none") {
    signIn.style.display = "block";
    register.style.display = "none";
  } else {
    signIn.style.display = "none";
  }
}

function ShowRegistrationForm() {

  if (register.style.display == "none") {
    register.style.display = "block";
    signIn.style.display = "none";
  } else {
    register.style.display = "none";
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
