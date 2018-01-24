/* eslint-env browser */

function Validador(maximaMedida) {
  this.maximo = maximaMedida;
}

const validador = new Validador(99999);

Validador.prototype.alertEsVacio = function (campo) {
  return (`El valor de ${campo} no puede estar vacío`);
};

Validador.prototype.alertCaracteresInvalidos = function (campo) {
  return (`${campo} contiene caracteres inválidos`);
};

Validador.prototype.alertMayorAlPermitido = function (campo, maximo) {
  return (`El valor de ${campo} no puede ser mayor a ${maximo}`);
};

Validador.prototype.esVacio = function (campo) {
  return campo === null || campo.length === 0;
};

Validador.prototype.mayorAlPermitido = function (campo, maximo) {
  return campo > maximo;
};

Validador.prototype.contieneNoNumeros = function (campo) {
  return /[^0-9]/.test(campo);
};

Validador.prototype.sonCamposValidos = function () {
  let sonValidos = true;
  const medidas = new Map([
     ['Ancho', window.document.getElementById('in_ancho').value],
     ['Alto', window.document.getElementById('in_alto').value],
  ]);
  medidas.forEach((value, key) => {
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

  const codigo = window.document.getElementById('in_codigo').value;
  const es_manual = window.document.getElementById('is_manual').checked;
  if (es_manual && this.esVacio(codigo)) {
    alert(this.alertEsVacio('Código'));
    sonValidos = false;
  } else if (this.contieneNoNumeros(codigo)) {
    alert(this.alertCaracteresInvalidos('Código'));
    sonValidos = false;
  } else if (this.mayorAlPermitido(codigo, 999999)) {
      alert(this.alertMayorAlPermitido('Código', 999999));
      sonValidos = false;
  }
  
  return sonValidos;
};

module.exports = Validador;
