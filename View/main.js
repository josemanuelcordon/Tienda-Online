const productLinksBtns = document.querySelectorAll(".product-link");

async function fetchProducts(start) {
  const response = await fetch(`index.php?c=api&start=${start}`);
  const data = response.json();
  return data;
}

async function loadProducts(start) {
  const fetch = await fetchProducts(start);
  const products = fetch.map((product) => JSON.parse(product));
  const container = document.querySelector(".product-wrapper");
  container.innerHTML = "";
  let elementos = "";
  products.forEach((product) => {
    elementos += `<article class="product">
                    <img src="${product.img}" alt="" width ="200px" height="200px">
                    <section class="product-info">
                    <p>${product.name}</p>
                    <p class="description">${product.description}</p>`;
    if (product.stock) {
      elementos += `<form class="add-cart" method="POST" action="index.php?c=order">
                        <select name="amount">`;
      for (let i = 1; i <= product.stock; i++) {
        elementos += `<option value="${i}">${i}</option>`;
      }
      elementos += `</select>
                        <input type="hidden" name="id" value="${product.id}">
                        <input type="submit" value="Añadir al carrito">
                        </form>`;
    }
    elementos += `</section>
                    </article>`;
  });
  container.innerHTML = elementos;
}

function changeColor(btn) {
  productLinksBtns.forEach((btn) => {
    btn.classList.remove("active");
  });
  btn.classList.add("active");
}

productLinksBtns.forEach((btn) => {
  btn.addEventListener("click", (e) => {
    const startFetching = btn.value;
    loadProducts(startFetching);
    changeColor(btn);
  });
});
