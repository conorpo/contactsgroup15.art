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
  if ( document.getElementById("passReg").value != document.getElementById("confirmReg").value) {
    console.log(document.getElementById("submitReg"));
    document.getElementById("submitReg").value = "pwd must match";
    document.getElementById("submitReg").disabled = true;
  } else {
    document.getElementById("submitReg").value = "Submit";
    document.getElementById("submitReg").disabled = false;
  }
}
