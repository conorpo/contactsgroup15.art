const loginBox = document.getElementById("login");
const registerBox = document.getElementById("register");


document.getElementById("main_banner").classList.add("main-banner-active");
document.getElementById("login_button").addEventListener("click",(evt) => {
  ShowForm(loginBox);
})
document.getElementById("register_button").addEventListener("click",(evt) => {
  ShowForm(registerBox);
})

function ShowForm(ele) {
  loginBox.classList.add("invisible");
  registerBox.classList.add("invisible");

  if(ele){
    ele.classList.remove("invisible");
  }
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
