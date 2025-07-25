function validateLogin() {
  let email = document.getElementById('loginEmail').value;
  let pass = document.getElementById('loginPassword').value;
  if (email.length < 5 || pass.length < 5) {
    alert('Please enter valid credentials.');
    return false;
  }
  return true;
}

function validateRegister() {
  let name = document.getElementById('regName').value;
  let email = document.getElementById('regEmail').value;
  let pass = document.getElementById('regPassword').value;
  if (name.length < 3 || email.length < 5 || pass.length < 6) {
    alert('Please fill all fields correctly.');
    return false;
  }
  return true;
}
