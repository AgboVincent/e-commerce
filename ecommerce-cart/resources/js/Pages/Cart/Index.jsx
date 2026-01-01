{cart.items.map(item => (
  <div key={item.id}>
    <span>{item.product.name}</span>
    <input
      type="number"
      value={item.quantity}
      onChange={e =>
        put(route('cart.update', item.id), { quantity: e.target.value })
      }
    />
    <button onClick={() => delete(route('cart.remove', item.id))}>
      Remove
    </button>
  </div>
))}
