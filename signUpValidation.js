function validate() {
    var form = document.forms[0];
    var userID = form['userID'].value.trim();
    var password = form['password'].value.trim();
    var name = form['name'].value.trim();
    var country = form['country'].value;
    var zipcode = form['zipcode'].value.trim();
    var email = form['email'].value.trim();
    var sex = form['sex'].value;

    if (userID == '') {
        alert("User ID cannot be blank");
        return false;
    }
    if (userID.length < 5 || userID.length > 12) {
        alert("User ID must be between 5 to 12 characters in length");
        return false;
    }

    if (password == '') {
        alert("Password cannot be blank");
        return false;
    }
    if (password.length < 7 || password.length > 12) {
        alert("Password must be between 7 to 12 characters in length");
        return false;
    }

    if (name == "") {
        alert("Name cannot be blank");
        return false;
    }
    var nameRegex = /^[a-zA-Z\s]+$/;
    if (!nameRegex.test(name)) {
        alert("Name must contain alphabets only");
        return false;
    }

    if (country == "") {
        alert("Must select a country");
        return false;
    }

    if (zipcode == "") {
        alert("Zipcode cannot be blank");
        return false;
    }
    var zipregex = /^[0-9]+$/;
    if (!zipregex.test(zipcode)) {
        alert("Zipcode must contain numbers only");
        return false;
    }

    if (email == "") {
        alert("Email cannot be blank");
        return false;
    }
    var emailRegex = /^\S+@\S+\.\S+$/;
    if (!emailRegex.test(email)) {
        alert("Please enter a valid email address");
        return false;
    }

    return true;
}
