document.addEventListener("DOMContentLoaded", () => {
  const contenedor = document.getElementById("lista-productos");
  if (!contenedor || !Array.isArray(window.PRODUCTOS)) return;

  const BASE = window.BASE || ""; // "/miproyecto"
  const fmt = (n) =>
    new Intl.NumberFormat("es-AR", { style: "currency", currency: "ARS", maximumFractionDigits: 2 }).format(Number(n||0));

  window.PRODUCTOS.forEach(p => {
    const card = document.createElement("div");
    card.classList.add("product-card");

    const imgSrc = /^https?:\/\//i.test(p.imagen)
      ? p.imagen
      : `${BASE}/assets/img/${p.imagen || "LogoBitNova.png"}`;

    card.innerHTML = `
      <img src="${imgSrc}" alt="${p.nombre}"
           loading="lazy"
           onerror="this.onerror=null;this.src='${BASE}/assets/img/LogoBitNova.png';">
      <h3>${p.nombre}</h3>
      ${p.precio != null ? `<p class="price">${fmt(p.precio)}</p>` : ""}
      <p class="cat"><strong>Categoría:</strong> ${p.categoria}</p>
      <p class="desc">${p.descripcion || ""}</p>
    `;
    contenedor.appendChild(card);
  });
});