<template>
    <div v-if="cartItems.length === 0" class="text-center py-20">
        <p class="text-gray-400 uppercase tracking-widest text-xs font-bold mb-6">Your bag is empty</p>
        <a href="/products" class="bg-black text-white px-8 py-4 uppercase tracking-widest text-xs font-bold hover:bg-gray-800 transition-colors">Continue Shopping</a>
    </div>

    <div v-else class="grid grid-cols-1 lg:grid-cols-2 gap-16">
        <!-- Order Summary -->
        <div>
            <h2 class="text-xs uppercase tracking-widest font-bold text-gray-400 mb-8 border-b pb-4">Order Summary ({{ totalItems }} items)</h2>
            <div class="space-y-6">
                <div v-for="item in cartItems" :key="item.id" class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                    <div class="w-20 h-20 bg-white rounded-lg overflow-hidden shrink-0">
                        <img :src="item.image" :alt="item.name" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1">
                        <p class="font-bold text-sm uppercase tracking-tight">{{ item.name }}</p>
                        <p class="text-gray-400 text-xs mt-1">Qty: {{ item.quantity }} × ${{ Number(item.price).toFixed(2) }}</p>
                    </div>
                    <p class="font-bold text-sm">${{ (item.price * item.quantity).toFixed(2) }}</p>
                </div>
            </div>
            <div class="flex justify-between items-center mt-8 pt-6 border-t border-gray-200">
                <span class="text-xs uppercase tracking-widest font-bold text-gray-400">Total</span>
                <span class="text-3xl font-bold tracking-tighter">${{ totalPrice.toFixed(2) }}</span>
            </div>
        </div>

        <!-- Checkout Form -->
        <div>
            <h2 class="text-xs uppercase tracking-widest font-bold text-gray-400 mb-8 border-b pb-4">Shipping Details</h2>
            <form @submit.prevent="submitOrder" class="space-y-6">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Full Name</label>
                    <input v-model="form.customer_name" type="text" class="checkout-input" placeholder="John Doe" required>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Email Address</label>
                    <input v-model="form.customer_email" type="email" class="checkout-input" placeholder="john@example.com" required>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Phone (Optional)</label>
                    <input v-model="form.customer_phone" type="tel" class="checkout-input" placeholder="+1 (555) 000-0000">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Shipping Address</label>
                    <textarea v-model="form.address" rows="3" class="checkout-input" placeholder="Street address, city, state, zip" required></textarea>
                </div>

                <div v-if="errorMsg" class="bg-red-50 text-red-600 px-5 py-3 rounded-xl text-sm font-medium">{{ errorMsg }}</div>

                <button type="submit" :disabled="loading" class="w-full bg-black text-white py-5 rounded-xl font-bold uppercase tracking-widest hover:bg-gray-800 transition-all disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-3">
                    <svg v-if="loading" class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                    <span>{{ loading ? 'Processing...' : 'Place Order' }}</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Success Modal -->
    <div v-if="success" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm">
        <div class="bg-white rounded-2xl p-12 max-w-md text-center shadow-2xl">
            <div class="w-20 h-20 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg>
            </div>
            <h3 class="text-2xl font-bold tracking-tighter uppercase mb-2">Order Confirmed!</h3>
            <p class="text-gray-500 mb-2">Order #{{ orderId }}</p>
            <p class="text-gray-400 text-sm mb-8">Thank you for your purchase. You will receive a confirmation email shortly.</p>
            <a href="/products" class="bg-black text-white px-8 py-4 rounded-xl uppercase tracking-widest text-xs font-bold hover:bg-gray-800 transition-colors inline-block">Continue Shopping</a>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';

const cartItems = ref([]);
const loading = ref(false);
const errorMsg = ref('');
const success = ref(false);
const orderId = ref(null);

const form = ref({
    customer_name: '',
    customer_email: '',
    customer_phone: '',
    address: '',
});

const totalItems = computed(() => cartItems.value.reduce((sum, item) => sum + item.quantity, 0));
const totalPrice = computed(() => cartItems.value.reduce((sum, item) => sum + (item.price * item.quantity), 0));

onMounted(() => {
    loadCart();
});

function loadCart() {
    const stored = localStorage.getItem('wer_cart');
    if (stored) {
        cartItems.value = JSON.parse(stored);
    }
}

async function submitOrder() {
    loading.value = true;
    errorMsg.value = '';

    try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        const { data } = await axios.post('/checkout', {
            ...form.value,
            items: cartItems.value.map(item => ({ id: item.id, quantity: item.quantity })),
        }, {
            headers: { 'X-CSRF-TOKEN': csrfToken }
        });

        if (data.success) {
            orderId.value = data.order_id;
            success.value = true;
            localStorage.removeItem('wer_cart');
            window.dispatchEvent(new CustomEvent('cart-updated'));
        } else {
            errorMsg.value = data.message || 'Something went wrong.';
        }
    } catch (err) {
        if (err.response?.data?.message) {
            errorMsg.value = err.response.data.message;
        } else if (err.response?.data?.errors) {
            errorMsg.value = Object.values(err.response.data.errors).flat()[0];
        } else {
            errorMsg.value = 'Unable to process your order. Please try again.';
        }
    } finally {
        loading.value = false;
    }
}
</script>
