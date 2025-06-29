const roles = document.getElementsByName("role");
const input = document.getElementById("secret-discret");

function showSecretInput() {
  // // TESTING
  // input.style.display = "none";
  
  // ORIGINAL
  if (roles[1].checked || roles[2].checked) {
    input.style.display = "flex";
  } else {
    input.style.display = "none";
  }
}

roles.forEach(radio => {
  radio.addEventListener("change", showSecretInput);
});

showSecretInput();
