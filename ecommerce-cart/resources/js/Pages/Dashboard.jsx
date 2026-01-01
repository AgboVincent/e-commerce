import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {router, Head, usePage } from '@inertiajs/react';
import { useState } from 'react';
import CartDrawer from '@/Components/CartDrawer';
export default function Dashboard({ products }) {
    const { cartCount } = usePage().props;
    const [open, setOpen] = useState(false);
    const addToCart = (productId) => {
        router.post('/cart/add', {
            product_id: productId,
            quantity: 1,
        });
    };
    return (
        <AuthenticatedLayout
            header={
                <div className="flex items-center justify-between">
                    <h2 className="text-xl font-semibold leading-tight text-gray-800">
                        Dashboard
                    </h2>

                     <button
                        onClick={() => setOpen(true)}
                        className="relative"
                    >
                        🛒
                        {cartCount >= 0 && (
                            <span className="absolute -top-2 -right-2 bg-red-600 text-white text-xs w-5 h-5 flex items-center justify-center rounded-full">
                                {cartCount}
                            </span>
                        )}
                    </button>
                </div>
            }
        >
            <Head title="Dashboard" />
            <CartDrawer open={open} onClose={() => setOpen(false)} />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                        {products.map((product) => (
                            <div
                                key={product.id}
                                className="bg-white shadow-sm rounded-lg p-6"
                            >
                                <h2 className="font-semibold text-lg">
                                    {product.name}
                                </h2>

                                <p className="text-gray-600">
                                    ₦{product.price}
                                </p>

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
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
