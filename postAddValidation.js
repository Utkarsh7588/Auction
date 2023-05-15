function validateForm() {
    var imageInput = document.getElementById('image');
    var descriptionInput = document.getElementById('description');
    var historyInput = document.getElementById('history');
    var qualityInput = document.getElementById('quality');
  
    if (Input.value.trim() === "" ||
    descriptionInput.value.trim() === "" ||
    historyInput.value.trim() === "" ||
    qualityInput.value.trim() === "") {
  alert("Please fill in all fields.");
  return false;
}
  
    return true;
  }
  