/* eslint-env browser */

function Validador(maximaMedida) {
  this.maximo = maximaMedida;
}

const validador = new Validador(9999);

Validador.prototype.alertEsVacio = function (campo) {
  return (`El valor de ${campo} no puede estar vacío`);
};

Validador.prototype.alertCaracteresInvalidos = function (campo) {
  return (`${campo} contiene caracteres inválidos`);
};

Validador.prototype.alertMayorAlPermitido = function (campo) {
  return (`El valor de ${campo} no puede ser mayor a ${this.maximo}`);
};

Validador.prototype.esVacio = function (campo) {
  return campo === null || campo.length === 0;
};

Validador.prototype.mayorAlPermitido = function (campo) {
  return campo > this.maximo;
};

Validador.prototype.contieneNoNumeros = function (campo) {
  return /[^0-9]/.test(campo);
};

Validador.prototype.sonCamposValidos = function () {
  let sonValidos = true;
  const map = new Map([
     ['Ancho', window.document.getElementById('in_ancho').value],
     ['Alto', window.document.getElementById('in_alto').value],
  ]);
  map.forEach((value, key) => {
    if (this.esVacio(value)) {
      alert(this.alertEsVacio(key));
      sonValidos = false;
    } else if (this.contieneNoNumeros(value)) {
      alert(this.alertCaracteresInvalidos(key));
      sonValidos = false;
    } else if (this.mayorAlPermitido(value, validador.maximo)) {
      alert(this.alertMayorAlPermitido(key, this.maximo));
      sonValidos = false;
    }
  });
  return sonValidos;
};

module.exports = Validador;
