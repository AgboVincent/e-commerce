import { router, usePage } from '@inertiajs/react';

export default function CartDrawer({ open, onClose }) {
    const { cart } = usePage().props;
    const updateQuantity = (item, newQty) => {
        if (newQty < 1) return;

        router.patch(`/cart/${item.id}`, {
            quantity: newQty,
        }, {
            preserveScroll: true,
        });
    };

    const checkout = () => {
        router.post('/checkout', {}, {
            preserveScroll: true,
            onSuccess: () => {
                onClose();
            }
        });
    };

    return (
        <div
            className={`fixed inset-0 z-50 transition ${
                open ? 'visible' : 'invisible'
            }`}
        >
            {/* Overlay */}
            <div
                onClick={onClose}
                className={`absolute inset-0 bg-black transition-opacity ${
                    open ? 'opacity-40' : 'opacity-0'
                }`}
            />

            {/* Drawer */}
            <div
                className={`absolute right-0 top-0 h-full w-96 bg-white shadow-lg transform transition-transform ${
                    open ? 'translate-x-0' : 'translate-x-full'
                }`}
            >
                <div className="p-4 border-b flex justify-between">
                    <h2 className="font-semibold text-lg">Your Cart</h2>
                    <button onClick={onClose}>✕</button>
                </div>

                <div className="p-4 space-y-4">
                    {!cart || cart.items.length === 0 && (
                        <p className="text-gray-500">Cart is empty</p>
                    )}

                    {cart?.items.map((item) => (
                        <div
                            key={item.id}
                            className="flex justify-between items-center"
                        >
                            <div>
                                <p className="font-medium">
                                    {item.product.name}
                                </p>
                                <p className="text-sm text-gray-600">
                                    ₦{item.product.price}
                                </p>
                            </div>

                             <div className="flex items-center space-x-2">
                                <button
                                    onClick={() =>
                                        updateQuantity(item, item.quantity - 1)
                                    }
                                    className="w-7 h-7 flex items-center justify-center border rounded hover:bg-gray-100"
                                >
                                    −
                                </button>

                                <span className="w-6 text-center">
                                    {item.quantity}
                                </span>

                                <button
                                    onClick={() =>
                                        updateQuantity(item, item.quantity + 1)
                                    }
                                    className="w-7 h-7 flex items-center justify-center border rounded hover:bg-gray-100"
                                >
                                    +
                                </button>
                            </div>

                            <button
                                onClick={() =>
                                    router.delete(`/cart/${item.id}`)
                                }
                                className="text-red-600 text-sm"
                            >
                                Remove
                            </button>
                        </div>
                    ))}
                </div>

                <div className="p-4 border-t">
                <button
                    onClick={checkout}
                    disabled={cart?.items.length === 0}
                    className="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 disabled:opacity-50"
                >
                    Checkout
                </button>
            </div>
            </div>
        </div>
    );
}
