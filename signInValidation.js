function validateForm() {
  var form = document.getElementById("myForm");
  var userIdInput = document.getElementById("userId");
  var passwordInput = document.getElementById("password");
  var phoneInput = document.getElementById("phone");
  var zipcodeInput = document.getElementById("zipcode");

  if (userIdInput.value.trim() === "" ||
      passwordInput.value.trim() === "" ) {
    alert("Please fill in all fields.");
    return false;
  }



  // If all validations pass, the form will be submitted
}
