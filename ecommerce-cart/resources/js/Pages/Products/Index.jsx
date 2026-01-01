{products.map(product => (
  <div key={product.id}>
    <h2>{product.name}</h2>
    <p>${product.price}</p>
    <button onClick={() => post(route('cart.add', product.id))}>
      Add to Cart
    </button>
  </div>
))}
