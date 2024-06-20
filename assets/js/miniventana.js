window.addEventListener('load', function() {
  var btnAbrir = document.getElementById('btnAbrir');
  var btnCerrar = document.getElementById('btnCerrar');
  var miniVentana = document.getElementById('miniVentana');
  var formularioContainer = document.getElementById('formularioContainer');
  var formulario1 = document.getElementById('formulario1');
  var formulario2 = document.getElementById('formulario2');
  var formulario3 = document.getElementById('formulario3');
  var formulario4 = document.getElementById('formulario4');
  var btnSiguiente1 = document.getElementById('btnSiguiente1');
  var btnAnterior2 = document.getElementById('btnAnterior2');
  var btnSiguiente2 = document.getElementById('btnSiguiente2');
  var btnAnterior2 = document.getElementById('btnAnterior2');
  var btnSiguiente3 = document.getElementById('btnSiguiente3');
  var btnAnterior3 = document.getElementById('btnAnterior3');
  var btnAnterior4 = document.getElementById('btnAnterior4');

  btnAbrir.addEventListener('click', function() {
    miniVentana.style.display= 'inline-block'
    formulario1.style.display = 'block';
  });

  btnCerrar.addEventListener('click', function() {
    formulario1.style.display = 'none';
  });
  btnCerrar1.addEventListener('click', function() {
    formulario2.style.display = 'none';
  });
  btnCerrar2.addEventListener('click', function() {
    formulario3.style.display = 'none';
  });
  btnCerrar3.addEventListener('click', function() {
    formulario4.style.display = 'none';
  });
  btnSiguiente1.addEventListener('click', function() {
    formulario1.style.display = 'none';
    formulario2.style.display = 'block';
  });

  btnAnterior2.addEventListener('click', function() {
    formulario2.style.display = 'none';
    formulario1.style.display = 'block';
  });

  btnSiguiente2.addEventListener('click', function() {
    formulario2.style.display = 'none';
    formulario3.style.display = 'block';
  });


  btnAnterior3.addEventListener('click', function() {
    formulario3.style.display = 'none';
    formulario2.style.display = 'block';
  });

  btnSiguiente3.addEventListener('click', function() {
    formulario3.style.display = 'none';
    formulario4.style.display = 'block';
  });

  btnAnterior4.addEventListener('click', function() {
    formulario4.style.display = 'none';
    formulario3.style.display = 'block';
  });
});