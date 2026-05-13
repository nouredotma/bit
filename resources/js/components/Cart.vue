<template>
  <Transition name="fade">
    <div v-if="isOpen" class="fixed inset-0 z-[200] bg-white overflow-y-auto">
      <!-- Top Left Back Button -->
      <button @click="closeCart" class="fixed top-6 left-6 md:top-12 md:left-12 z-[210] p-3 md:p-4 hover:bg-surface rounded-full transition-colors group">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <path d="m15 18-6-6 6-6"/>
        </svg>
      </button>

      <div class="max-w-[1400px] mx-auto px-6 md:px-12 py-24 md:py-32">
        <div v-if="cartItems.length === 0" class="min-h-[60vh] flex flex-col items-center justify-center text-center">
            <h2 class="text-4xl font-light tracking-tight mb-6">Your bag is empty</h2>
            <button @click="closeCart" class="px-12 py-4 bg-black text-white rounded-full font-bold hover:bg-neutral-800 transition-all">
                Continue Shopping
            </button>
        </div>

        <div v-else class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-32 items-start">
          <!-- Left Column: Bag Items -->
          <div class="space-y-12">
            <div class="border-b border-neutral-100 pb-8">
              <h2 class="text-4xl md:text-5xl font-light tracking-tight mb-2">Your Bag</h2>
              <p class="text-neutral-400 font-light">{{ cartItems.length }} items selected</p>
            </div>

            <div class="divide-y divide-neutral-100">
              <div v-for="item in cartItems" :key="item.id + '-' + (item.size || '') + '-' + (item.color || '')" class="py-8 flex gap-6 md:gap-8 group">
                <div class="w-24 md:w-32 aspect-square bg-surface rounded-2xl overflow-hidden shrink-0">
                  <img :src="item.image" class="w-full h-full object-cover" />
                </div>
                <div class="flex-1 flex flex-col">
                  <div class="flex justify-between items-start mb-2">
                    <div>
                      <h3 class="text-lg md:text-xl font-medium tracking-tight">{{ item.name }}</h3>
                      <div class="flex flex-wrap gap-x-4 gap-y-1 mt-1">
                        <p v-if="item.size" class="text-xs text-neutral-400 font-medium">Size: {{ item.size }}</p>
                        <p v-if="item.color" class="text-xs text-neutral-400 font-medium">Color: {{ item.color }}</p>
                      </div>
                    </div>
                    <button @click="removeItem(item.id, item.size, item.color)" class="p-2 text-neutral-300 hover:text-red-500 hover:bg-red-50 rounded-full transition-all">
                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                    </button>
                  </div>
                  
                  <div class="flex items-center gap-4 mt-auto">
                    <div class="flex items-center border border-neutral-100 rounded-full px-3 py-1 bg-white">
                      <button @click="updateItemQty(item, -1)" class="px-2 hover:text-neutral-400 transition-colors">-</button>
                      <span class="w-8 text-center text-xs font-bold">{{ item.quantity }}</span>
                      <button @click="updateItemQty(item, 1)" class="px-2 hover:text-neutral-400 transition-colors">+</button>
                    </div>
                    <p class="font-bold text-lg ml-auto">{{ (item.price * item.quantity).toLocaleString() }} MAD</p>
                  </div>
                </div>
              </div>
            </div>

            <div class="pt-8 border-t-2 border-black flex justify-between items-end">
              <p class="text-neutral-400 font-light">Subtotal</p>
              <p class="text-4xl font-bold tracking-tighter">{{ subtotal.toLocaleString() }} MAD</p>
            </div>
          </div>

          <!-- Right Column: Checkout Form -->
          <div class="bg-surface rounded-[40px] p-8 md:p-12 border border-neutral-100">
            <h2 class="text-3xl font-light tracking-tight mb-8">Shipping Details</h2>
            
            <form @submit.prevent="submitOrder" class="space-y-6">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                  <label class="text-[10px] font-bold text-neutral-400 ml-1">First Name</label>
                  <input type="text" required class="w-full px-6 py-4 rounded-2xl bg-white border border-neutral-100 outline-none focus:border-black transition-colors" placeholder="John">
                </div>
                <div class="space-y-2">
                  <label class="text-[10px] font-bold text-neutral-400 ml-1">Last Name</label>
                  <input type="text" required class="w-full px-6 py-4 rounded-2xl bg-white border border-neutral-100 outline-none focus:border-black transition-colors" placeholder="Doe">
                </div>
              </div>

              <div class="space-y-2">
                <label class="text-[10px] font-bold text-neutral-400 ml-1">Email Address</label>
                <input type="email" required class="w-full px-6 py-4 rounded-2xl bg-white border border-neutral-100 outline-none focus:border-black transition-colors" placeholder="john@example.com">
              </div>

              <div class="space-y-2">
                <label class="text-[10px] font-bold text-neutral-400 ml-1">Phone Number</label>
                <input type="tel" required class="w-full px-6 py-4 rounded-2xl bg-white border border-neutral-100 outline-none focus:border-black transition-colors" placeholder="+212 600 000 000">
              </div>

              <div class="space-y-2">
                <label class="text-[10px] font-bold text-neutral-400 ml-1">Shipping Address</label>
                <input type="text" required class="w-full px-6 py-4 rounded-2xl bg-white border border-neutral-100 outline-none focus:border-black transition-colors" placeholder="Street name and number">
              </div>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                  <label class="text-[10px] font-bold text-neutral-400 ml-1">City</label>
                  <input type="text" required class="w-full px-6 py-4 rounded-2xl bg-white border border-neutral-100 outline-none focus:border-black transition-colors" placeholder="Casablanca">
                </div>
                <div class="space-y-2">
                  <label class="text-[10px] font-bold text-neutral-400 ml-1">Postal Code</label>
                  <input type="text" class="w-full px-6 py-4 rounded-2xl bg-white border border-neutral-100 outline-none focus:border-black transition-colors" placeholder="20000">
                </div>
              </div>

              <div class="pt-8 border-t border-neutral-100">
                <div class="flex justify-between items-center mb-6">
                  <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-emerald-100/50 flex items-center justify-center">
                      <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <p class="text-sm font-bold">Free Local Shipping</p>
                  </div>
                  <p class="text-sm font-bold text-emerald-600">Included</p>
                </div>

                <button type="submit" class="w-full bg-black text-white py-6 rounded-full font-bold text-lg hover:bg-neutral-800 transition-all duration-300">
                  Complete Purchase — {{ total.toLocaleString() }} MAD
                </button>
                <p class="text-center text-[10px] text-neutral-400 mt-6 flex items-center justify-center gap-2">
                  <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                  Secure SSL Encrypted Payment
                </p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </Transition>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';

const isOpen = ref(false);
const cartItems = ref([]);

const subtotal = computed(() => {
  return cartItems.value.reduce((total, item) => total + (item.price * item.quantity), 0);
});

const total = computed(() => subtotal.value); // Currently no taxes/extras

const closeCart = () => {
  isOpen.value = false;
  document.body.style.overflow = '';
};

const openCart = () => {
  isOpen.value = true;
  document.body.style.overflow = 'hidden';
};

const removeItem = (id, size, color) => {
  cartItems.value = cartItems.value.filter(item => 
    !(item.id === id && item.size === size && item.color === color)
  );
  saveCart();
};

const updateItemQty = (item, delta) => {
  item.quantity = Math.max(1, item.quantity + delta);
  saveCart();
};

const saveCart = () => {
  localStorage.setItem('wer_cart', JSON.stringify(cartItems.value));
  window.dispatchEvent(new CustomEvent('cart-updated', { detail: cartItems.value }));
};

const submitOrder = () => {
  // Logic for order submission
  alert('Thank you for your order! This is a demo.');
  cartItems.value = [];
  saveCart();
  closeCart();
};

onMounted(() => {
  const savedCart = localStorage.getItem('wer_cart');
  if (savedCart) {
    cartItems.value = JSON.parse(savedCart);
    window.dispatchEvent(new CustomEvent('cart-updated', { detail: cartItems.value }));
  }

  window.addEventListener('toggle-cart', () => {
    if (isOpen.value) closeCart();
    else openCart();
  });

  window.addEventListener('add-to-cart', (e) => {
    const item = e.detail;
    const existing = cartItems.value.find(i => 
        i.id === item.id && i.size === item.size && i.color === item.color
    );
    
    if (existing) {
      existing.quantity += item.quantity || 1;
    } else {
      cartItems.value.push({ ...item, quantity: item.quantity || 1 });
    }
    
    saveCart();
    openCart();
  });
});
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease, transform 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
  transform: translateY(20px);
}

/* Custom scrollbar for better aesthetics */
.fixed::-webkit-scrollbar {
  width: 6px;
}

.fixed::-webkit-scrollbar-track {
  background: transparent;
}

.fixed::-webkit-scrollbar-thumb {
  background: #f0f0f0;
  border-radius: 10px;
}

.fixed::-webkit-scrollbar-thumb:hover {
  background: #e0e0e0;
}
</style>
