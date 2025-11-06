$(document).ready(function () {

  // Mapea un input/textarea a una etiqueta legible (usa <label for="..."> si existe)
  function etiquetaCampo($form, $el) {
    const id = $el.attr("id");
    const name = $el.attr("name");
    let etiqueta = "";

    if (id) {
      etiqueta = $form.find(`label[for="${id}"]`).text().trim();
    }
    if (!etiqueta) etiqueta = name || id || "campo";
    return etiqueta;
  }

  // Valida que ningún campo esté vacío o con solo espacios
  function validarFormulario($form) {
    const vacios = [];

    $form.find("input, textarea").each(function () {
      const $el = $(this);
      const tipo = ($el.attr("type") || "").toLowerCase();
      const valor = String($el.val() ?? "").trim();

      // vacío o solo espacios
      if (valor === "") {
        vacios.push(etiquetaCampo($form, $el));
        return; // sigue al próximo campo
      }

      // chequeo mínimo para number inválido
      if (tipo === "number" && isNaN(Number(valor))) {
        vacios.push(`${etiquetaCampo($form, $el)} (valor no numérico)`);
      }
    });

    if (vacios.length > 0) {
      let msg = "Los siguientes campos están vacíos o contienen solo espacios:\n\n";
      msg += vacios.join("\n");
      msg += "\n\n— Fabrizio Lomello";
      alert(msg);
      return false; // inválido
    }

    return true; // ok
  }

$(document).ready(function () {

  console.log("validaciones.js cargado (categorías/productos)");

  $("#form-categorias").on("submit", function (e) {
    console.log("submit -> form-categorias");
    if (!validarFormulario($(this))) e.preventDefault();
  });

  $("#form-productos").on("submit", function (e) {
    console.log("submit -> form-productos");
    if (!validarFormulario($(this))) e.preventDefault();
  });
});

});