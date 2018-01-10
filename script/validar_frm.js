/* eslint-env browser */

const maximo = 99999;

function alertCaracteresInvalidos(campo) {
  alert(`${campo} contiene caracteres inválidos`);
}

function alertEsVacio(campo) {
  alert(`El valor de ${campo} no puede estar vacío`);
}

function alertMayorAlPermitido(campo) {
  alert(`El valor de ${campo} no puede ser mayor a ${maximo}`);
}

function esVacio(campo) {
  return campo === null || campo.length === 0;
}

function mayorAlPermitido(campo) {
  return campo > maximo;
}

function contieneNoNumeros(campo) {
  return /[^0-9]/.test(campo);
}

function sonCamposValidos() {
  const map = new Map([
                       ['Ancho', window.document.getElementById('in_ancho').value],
                       ['Alto', window.document.getElementById('in_alto').value],
  ]);
  let sonValidos = true;
  function alertCamposInvalidos(value, key) {
    if (esVacio(value)) {
      alertEsVacio(key);
      sonValidos = false;
    } else if (contieneNoNumeros(value)) {
      alertCaracteresInvalidos(key);
      sonValidos = false;
    } else if (mayorAlPermitido(value, maximo)) {
      alertMayorAlPermitido(key, maximo);
      sonValidos = false;
    }
  }
  map.forEach(alertCamposInvalidos);
  return sonValidos;
}

module.exports = sonCamposValidos;
