import Validador from '../validar_frm.js';

describe('Testing Validador', () => {
  const validador = new Validador(9999);
  let msj;

  test('Anuncia valor vacío', () => {
    msj = validador.alertEsVacio('a');
    expect(msj).toBe('El valor de a no puede estar vacío');
  });

  test('Anuncia caracteres inválidos', () => {
    msj = validador.alertCaracteresInvalidos('a');
    expect(msj).toBe('a contiene caracteres inválidos');
  });

  test('Anuncia valor mayor al permitido', () => {
    msj = validador.alertMayorAlPermitido('a');
    expect(msj).toBe(`El valor de a no puede ser mayor a ${validador.maximo}`);
  });

  test('Verifica campo vacio', () => {
    const campoVacio = '';
    expect(validador.esVacio(campoVacio)).toBeTruthy();
  });

  test('Verifica campo no vacio', () => {
    const campoNoVacio = 'a';
    expect(validador.esVacio(campoNoVacio)).toBeFalsy();
  });

  test('Verifica valor mayor al permitido', () => {
    expect(validador.mayorAlPermitido(validador.maximo + 1)).toBeTruthy();
  });

  test('Verifica valor no mayor al permitido', () => {
    expect(validador.mayorAlPermitido(validador.maximo - 1)).toBeFalsy();
  });

  test('Verifica que un campo contiene caracteres no numericos', () => {
    expect(validador.contieneNoNumeros('a')).toBeTruthy();
  });

  test('Verifica que un campo no contiene caracteres no numericos', () => {
    expect(validador.contieneNoNumeros('3')).toBeFalsy();
  });
});
