// const dropdowns = document.querySelectorAll('.dropdown');
// dropdowns.forEach(function(dropdown) {
//     dropdown.addEventListener('click', () => {
//         const dropdownContent = dropdown.querySelector('.dropdown-content');
//         dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
//         const icon = dropdown.querySelector('.toggle');
//         icon.style.transform = icon.style.transform === 'rotate(0deg)' ? 'rotate(180deg)' : 'rotate(0deg)';
//     });
// });
// document.addEventListener('DOMContentLoaded', function() {
//     const dropdowns = document.querySelectorAll('.dropdown');
//     dropdowns.forEach(function(dropdown) {
//         dropdown.addEventListener('click', function() {
//             const dropdownContent = dropdown.querySelector('.dropdown-content');
//             dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
//             const icon = dropdown.querySelector('.toggle');
//             icon.style.transform = icon.style.transform === 'rotate(0deg)' ? 'rotate(180deg)' : 'rotate(0deg)';
//         });
//         document.addEventListener('click', function() {
//             const dropdownContent = dropdown.querySelector('.dropdown-content');
//             const target = event.target;
//             if (!dropdownContent.contains(target)) {
//                 dropdownContent.style.display = 'none';
//                 const icon = dropdown.querySelector('.toggle');
//                 icon.style.transform = 'rotate(0deg)';

//             }
//         })
//     });
// });

document.addEventListener("DOMContentLoaded", function () {
  const dropdowns = document.querySelectorAll(".dropdown");
  dropdowns.forEach(function (dropdown) {
    dropdown.addEventListener("click", function (event) {
      event.stopPropagation(); // Prevent the click event from bubbling up
      const dropdownContent = dropdown.querySelector(".dropdown-content");
      toggleDropdown(dropdownContent);
    });

    // Click event listener for document to hide dropdown when clicked outside
    document.addEventListener("click", function (event) {
      const dropdownContent = dropdown.querySelector(".dropdown-content");
      const target = event.target;
      if (!dropdownContent.contains(target)) {
        dropdownContent.style.display = "none";
        const icon = dropdown.querySelector(".toggle");
        icon.style.transform = "rotate(0deg)";
      }
    });
  });

  // const pwd = document.querySelectorAll('.toggle-password');
  // // const teye = document.querySelectorAll('.eye');
  // pwd.forEach(function(tpwd) {
  //     tpwd.addEventListener('click', function() {
  //         const changeType = tpwd.querySelector('.pw');
  //         changeType.style.type = changeType.style.type === 'password' ? 'text' : 'password';
  //         const eye = tpwd.querySelector('.eye');
  //         eye.innerHTML = eye.innerHTML === 'visibility' ? 'off visibility' : 'visibility';
  //     })
  // });

  const togglePasswordBtns = document.querySelectorAll(".toggle-password");

  togglePasswordBtns.forEach(function (togglePasswordBtn) {
    togglePasswordBtn.addEventListener("click", function () {
      const inputField = togglePasswordBtn.querySelector(".pw");
      const eyeIcon = togglePasswordBtn.querySelector(".eye");

      if (inputField.type === "password") {
        inputField.type = "text";
        eyeIcon.innerHTML = "visibility_off"; // Change to your eye-off icon HTML
      } else {
        inputField.type = "password";
        eyeIcon.innerHTML = "visibility"; // Change to your eye icon HTML
      }
    });
  });

  function toggleDropdown(dropdownContent) {
    dropdownContent.style.display =
      dropdownContent.style.display === "block" ? "none" : "block";
    const icon =
      dropdownContent.previousElementSibling.querySelector(".toggle");
    icon.style.transform =
      dropdownContent.style.display === "block"
        ? "rotate(180deg)"
        : "rotate(0deg)";
  }
});
