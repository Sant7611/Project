$(document).ready(function () {
  // user login and signup form submission
  $("#submit").click(function (e) {
    e.preventDefault();

    var uname = $("#username");
    var email = $("#email");
    var pwd = $("#pwd");
    var pwd2 = $("#pwd2");

    // Reset border colors and remove any existing error messages
    uname.css("border-color", "");
    email.css("border-color", "");
    pwd.css("border-color", "");
    pwd2.css("border-color", "");
    $(".msg").remove(); // Remove any existing error messages
    var errors = [];

    // Validation for username
    if (uname.val().trim() === "") {
      uname.css("border-color", "red");
      errors.push({
        key: "username",
        msg: '<span class="msg">Please enter your username</span>',
      });
      // return;
    }

    // Validation for email
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email.val())) {
      $(email).css("border-color", "red");
      errors.push({
        key: "email",
        msg: '<span class="msg">Please enter a valid email address</span>',
      });
      // return;
    }

    // Validation for passwords
    if (pwd.val().trim() === "" || pwd.val().trim().length <= 7) {
      $(pwd).css("border-color", "red");
      errors.push({
        key: "pwd",
        msg: '<span class="msg">Minimum 8 chatacters required</span>',
      });
      // return;
    }
    if (pwd2.val().trim() === "" || pwd2.val().trim().length <= 7) {
      pwd2.css("border-color", "red");
      errors.push({
        key: "pwd2",
        msg: '<span class="msg">Minimum 8 chatacters required</span>',
      });
    } else {
      if (pwd.val() !== pwd2.val()) {
        pwd.css("border-color", "red");
        pwd2.css("border-color", "red");
        errors.push({
          key: "pwd2",
          msg: '<span class="msg">Passwords don\'t match</span>',
        });
        // return;
      }
    }
    if (errors.length > 0) {
      $.each(errors, (key, value) => {
        $(value.msg).insertAfter("#" + value.key);
      });
      return;
    }

    // Submit the form if all validations pass
    $("#LoginForm").submit();
  });
});
