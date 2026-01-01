import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { router } from '@inertiajs/react';

export default function Products({ products }) {
    const addToCart = (productId) => {
        router.post('/cart/add', {
            product_id: productId,
            quantity: 1,
        });
    };

    return (
        <AuthenticatedLayout header="Products">
            <h1 className="text-2xl font-bold mb-6">Products</h1>

            <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                {products.map((product) => (
                    <div
                        key={product.id}
                        className="bg-white rounded-lg shadow p-4"
                    >
                        <h2 className="font-semibold text-lg">{product.name}</h2>

                        <p className="text-gray-600">₦{product.price}</p>
                        <p className="text-sm text-gray-500">
                            Stock: {product.stock_quantity}
                        </p>

                        <button
                            onClick={() => addToCart(product.id)}
                            disabled={product.stock_quantity === 0}
                            className="mt-4 w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 disabled:opacity-50"
                        >
                            Add to Cart
                        </button>
                    </div>
                ))}
            </div>
        </AuthenticatedLayout>
    );
}
