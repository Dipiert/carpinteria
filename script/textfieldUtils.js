/* eslint-env browser */

function toggleTextfield(checkbox, idTextfield, placeholder) {
  const txtField = window.document.getElementById(idTextfield);
  txtField.style.display = checkbox.checked ? 'inline' : 'none';
  txtField.placeholder = placeholder;
  txtField.value = '';
}

module.exports = toggleTextfield;
