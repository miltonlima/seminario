$(document).ready(function () {
  $("#cpf").mask("999.999.999-99");
});
$(document).ready(function () {
  $("#cep").mask("99.999-999");
});

function validarEmail() {
  email = document.getElementById('email').value;
  email2 = document.getElementById('confirma_email').value;
  if (email != email2) {
    alert('O e-mail de confirmação é diferente.');
    document.getElementById('confirma_email').value = '';
  }
}

function mask(o, f) {
  setTimeout(function () {
    var v = mphone(o.value);
    if (v != o.value) {
      o.value = v;
    }
  }, 1);
}

function mphone(v) {
  var r = v.replace(/\D/g, "");
  r = r.replace(/^0/, "");
  if (r.length > 10) {
    r = r.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
  } else if (r.length > 5) {
    r = r.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
  } else if (r.length > 2) {
    r = r.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
  } else {
    r = r.replace(/^(\d*)/, "($1");
  }
  return r;
}