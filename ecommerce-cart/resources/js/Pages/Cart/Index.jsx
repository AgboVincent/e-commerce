import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { router } from '@inertiajs/react';

export default function Cart({ cart }) {
    if (!cart || cart.items.length === 0) {
        return (
            <AuthenticatedLayout header="Cart">
                <p>Your cart is empty.</p>
            </AuthenticatedLayout>
        );
    }

    return (
        <AuthenticatedLayout header="Cart">
            <h1 className="text-2xl font-bold mb-6">Your Cart</h1>

            <div className="bg-white rounded shadow divide-y">
                {cart.items.map((item) => (
                    <div
                        key={item.id}
                        className="flex items-center justify-between p-4"
                    >
                        <div>
                            <p className="font-semibold">
                                {item.product.name}
                            </p>
                            <p className="text-gray-600">
                                ₦{item.product.price}
                            </p>
                        </div>

                        <input
                            type="number"
                            min="1"
                            value={item.quantity}
                            onChange={(e) =>
                                router.patch(`/cart/${item.id}`, {
                                    quantity: e.target.value,
                                })
                            }
                            className="w-20 border rounded px-2"
                        />

                        <button
                            onClick={() =>
                                router.delete(`/cart/${item.id}`)
                            }
                            className="text-red-600 hover:underline"
                        >
                            Remove
                        </button>
                    </div>
                ))}
            </div>
        </AuthenticatedLayout>
    );
}
