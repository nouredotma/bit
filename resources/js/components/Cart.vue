<template>
  <div v-if="isOpen" class="fixed inset-0 z-[100] flex justify-end">
    <!-- Backdrop -->
    <div @click="closeCart" class="absolute inset-0 bg-black/40 backdrop-blur-sm transition-opacity"></div>
    
    <!-- Drawer -->
    <div class="relative w-full max-w-md bg-white h-full shadow-2xl flex flex-col transform transition-transform duration-300 ease-out translate-x-0">
      <div class="p-8 border-b border-gray-100 flex justify-between items-center">
          <div>
              <h2 class="text-2xl font-bold text-[#0a0a0a]">Your Bag</h2>
              <p class="text-gray-500 text-sm mt-1">{{ cartItems.length }} items selected</p>
          </div>
          <button @click="closeCart" class="p-2 hover:bg-[#f5f5f7] rounded-full text-gray-400 hover:text-[#0a0a0a] transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
          </button>
      </div>

      <div class="flex-1 overflow-y-auto p-8">
          <div v-if="cartItems.length === 0" class="h-full flex flex-col items-center justify-center text-center">
              <div class="w-16 h-16 bg-[#f5f5f7] rounded-full flex items-center justify-center mb-6 text-gray-400">
                  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
              </div>
              <p class="text-gray-500 font-semibold mb-6">Your bag is empty</p>
              <button @click="closeCart" class="btn-primary">Start Shopping</button>
          </div>
          
          <div v-else class="space-y-6">
              <div v-for="item in cartItems" :key="item.id" class="flex gap-5 p-4 bg-[#f5f5f7] rounded-xl">
                  <div class="w-20 h-24 bg-white rounded-lg overflow-hidden shrink-0">
                      <img :src="item.image" class="w-full h-full object-cover" />
                  </div>
                  <div class="flex-1 flex flex-col">
                      <div class="flex justify-between items-start mb-1">
                          <h3 class="font-semibold text-sm">{{ item.name }}</h3>
                          <button @click="removeItem(item.id)" class="text-gray-400 hover:text-red-500 transition-colors p-1 -mt-1 -mr-1">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                          </button>
                      </div>
                      <p class="text-gray-500 text-sm flex-1">Qty: {{ item.quantity }}</p>
                      <p class="font-bold mt-auto">${{ (item.price * item.quantity).toFixed(2) }}</p>
                  </div>
              </div>
          </div>
      </div>

      <div v-if="cartItems.length > 0" class="p-8 border-t border-gray-100 bg-white">
          <div class="flex justify-between items-end mb-6">
              <span class="text-gray-500 font-semibold text-sm">Subtotal</span>
              <span class="text-3xl font-bold">${{ subtotal.toFixed(2) }}</span>
          </div>
          <a href="/checkout" class="block w-full text-center btn-primary">Proceed to Checkout</a>
          <p class="text-xs text-center text-gray-400 mt-4">Shipping & taxes calculated at checkout</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';

const isOpen = ref(false);
const cartItems = ref([]);

const subtotal = computed(() => {
  return cartItems.value.reduce((total, item) => total + (item.price * item.quantity), 0);
});

const closeCart = () => {
  isOpen.value = false;
};

const removeItem = (id) => {
  cartItems.value = cartItems.value.filter(item => item.id !== id);
  localStorage.setItem('wer_cart', JSON.stringify(cartItems.value));
  window.dispatchEvent(new CustomEvent('cart-updated', { detail: cartItems.value }));
};

onMounted(() => {
  const savedCart = localStorage.getItem('wer_cart');
  if (savedCart) {
    cartItems.value = JSON.parse(savedCart);
    window.dispatchEvent(new CustomEvent('cart-updated', { detail: cartItems.value }));
  }

  window.addEventListener('toggle-cart', () => {
    isOpen.value = !isOpen.value;
  });

  window.addEventListener('add-to-cart', (e) => {
    const item = e.detail;
    const existing = cartItems.value.find(i => i.id === item.id);
    if (existing) {
      existing.quantity += item.quantity || 1;
    } else {
      cartItems.value.push({ ...item, quantity: item.quantity || 1 });
    }
    localStorage.setItem('wer_cart', JSON.stringify(cartItems.value));
    window.dispatchEvent(new CustomEvent('cart-updated', { detail: cartItems.value }));
    isOpen.value = true;
  });
});
</script>
