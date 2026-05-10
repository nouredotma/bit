<template>
    <div v-if="cartItems.length === 0" class="text-center py-20">
        <p class="text-gray-500 text-sm font-semibold mb-6">Your bag is empty</p>
        <a href="/products" class="btn-primary inline-block">Continue Shopping</a>
    </div>

    <div v-else class="grid grid-cols-1 lg:grid-cols-2 gap-16">
        <!-- Order Summary -->
        <div>
            <h2 class="text-lg font-bold text-[#0a0a0a] mb-8 border-b border-gray-100 pb-4">Order Summary ({{ totalItems }} items)</h2>
            <div class="space-y-6">
                <div v-for="item in cartItems" :key="item.id" class="flex items-center gap-4 p-4 bg-[#f5f5f7] rounded-xl">
                    <div class="w-20 h-20 bg-white rounded-lg overflow-hidden shrink-0">
                        <img :src="item.image" :alt="item.name" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-sm">{{ item.name }}</p>
                        <p class="text-gray-500 text-sm mt-1">Qty: {{ item.quantity }} × ${{ Number(item.price).toFixed(2) }}</p>
                    </div>
                    <p class="font-semibold text-sm">${{ (item.price * item.quantity).toFixed(2) }}</p>
                </div>
            </div>
            <div class="flex justify-between items-center mt-8 pt-6 border-t border-gray-100">
                <span class="text-sm font-semibold text-gray-500">Total</span>
                <span class="text-3xl font-bold">${{ totalPrice.toFixed(2) }}</span>
            </div>
        </div>

        <!-- Checkout Form -->
        <div>
            <h2 class="text-lg font-bold text-[#0a0a0a] mb-8 border-b border-gray-100 pb-4">Shipping Details</h2>
            <form @submit.prevent="submitOrder" class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-500 mb-2">Full Name</label>
                    <input v-model="form.customer_name" type="text" class="checkout-input" placeholder="John Doe" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-500 mb-2">Email Address</label>
                    <input v-model="form.customer_email" type="email" class="checkout-input" placeholder="john@example.com" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-500 mb-2">Phone (Optional)</label>
                    <input v-model="form.customer_phone" type="tel" class="checkout-input" placeholder="+1 (555) 000-0000">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-500 mb-2">Shipping Address</label>
                    <textarea v-model="form.address" rows="3" class="checkout-input" placeholder="Street address, city, state, zip" required></textarea>
                </div>

                <div v-if="errorMsg" class="bg-red-50 text-red-600 px-5 py-3 rounded-lg text-sm font-medium">{{ errorMsg }}</div>

                <button type="submit" :disabled="loading" class="btn-primary w-full flex items-center justify-center gap-3 disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg v-if="loading" class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                    <span>{{ loading ? 'Processing...' : 'Place Order' }}</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Success Modal -->
    <div v-if="success" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm">
        <div class="bg-white rounded-2xl p-12 max-w-md text-center shadow-xl mx-4">
            <div class="w-20 h-20 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-6 text-green-500">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg>
            </div>
            <h3 class="text-2xl font-bold mb-3">Order Confirmed!</h3>
            <p class="text-gray-500 mb-2">Order #{{ orderId }}</p>
            <p class="text-gray-500 text-sm mb-8 leading-relaxed">Thank you for your purchase. You will receive a confirmation email shortly.</p>
            <a href="/products" class="btn-primary inline-block">Continue Shopping</a>
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
