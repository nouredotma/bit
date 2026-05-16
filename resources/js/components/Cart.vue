<template>
  <Transition name="fade">
    <div v-if="isOpen" class="fixed inset-0 z-[200] bg-white overflow-y-auto">
      <!-- Back Button -->
      <button @click="closeCart" class="fixed top-4 left-4 md:top-8 md:left-8 z-[210] p-2 hover:opacity-50 transition-opacity cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <path d="m15 18-6-6 6-6"/>
        </svg>
      </button>

      <div class="w-full px-3 md:px-12 py-24">
        <div v-if="isSuccess" class="min-h-[60svh] flex flex-col items-center justify-center text-center animate-fade-in-slow max-w-lg mx-auto">
            <div class="mb-8 flex items-center justify-center">
               <div class="w-20 h-20 rounded-full bg-emerald-50 flex items-center justify-center">
                 <svg class="w-10 h-10 text-emerald-500 animate-success-check" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                 </svg>
               </div>
            </div>
            <h2 class="text-3xl md:text-4xl tracking-tighter mb-3 font-bold">Order received</h2>
            <p class="text-neutral-500 text-sm md:text-base mb-10 leading-relaxed">Your order #{{ orderId }} is being prepared with care. We'll notify you as soon as it's on the way.</p>
            <button @click="closeCart" class="px-8 py-3.5 bg-black text-white text-xs font-bold rounded-full hover:bg-neutral-800 transition-all duration-300 cursor-pointer">
              Continue shopping
            </button>
        </div>

        <div v-else-if="cartItems.length === 0" class="min-h-[80svh] flex flex-col items-center justify-center text-center">
            <h2 class="text-2xl md:text-4xl tracking-tighter mb-3">Your bag is empty</h2>
            <button @click="closeCart" class="px-4 py-2 md:px-5 md:py-2.5 border-2 border-body hover:bg-black hover:text-white transition-all duration-300 text-[10px] md:text-xs font-bold rounded-full cursor-pointer ">
                Discover
            </button>
        </div>

        <div v-else class="grid grid-cols-1 lg:grid-cols-2 gap-3 md:gap-8 items-start">
          <!-- Left Column: Bag Items -->
          <div class="space-y-3 md:space-y-6">
            <div>
              <h2 class="text-3xl md:text-4xl tracking-tighter mb-1">Bag</h2>
              <p class="text-neutral-500 text-xs">Total of {{ cartItems.length }} item{{ cartItems.length > 1 ? 's' : '' }}</p>
            </div>

            <div class="divide-y divide-neutral-100">
              <div v-for="item in cartItems" :key="item.id + '-' + (item.size || '') + '-' + (item.color || '')" class="py-6 flex gap-6">
                <div class="w-20 md:w-24 aspect-square bg-neutral-100 rounded-xl overflow-hidden shrink-0">
                  <img :src="item.image" class="w-full h-full object-cover" />
                </div>
                <div class="flex-1 flex flex-col">
                  <div class="flex justify-between items-start">
                    <div>
                      <h3 class="text-lg md:text-xl tracking-tight">{{ item.name }}</h3>
                      <div class="flex gap-4 mt-1">
                        <p v-if="item.size" class="text-xs text-neutral-500">Size: {{ item.size }}</p>
                        <p v-if="item.color" class="text-xs text-neutral-500">Color: {{ item.color }}</p>
                      </div>
                    </div>
                    <button @click="removeItem(item.id, item.size, item.color)" class="p-1 text-red-300 hover:text-red-500 transition-colors cursor-pointer">
                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                    </button>
                  </div>
                  
                  <div class="flex items-center gap-4 mt-auto">
                    <div class="flex items-center border-2 border-neutral-200 rounded-full px-3 py-1 bg-white">
                      <button @click="updateItemQty(item, -1)" class="px-2 hover:text-neutral-400 transition-colors cursor-pointer">-</button>
                      <span class="w-8 text-center text-xs font-bold">{{ item.quantity }}</span>
                      <button @click="updateItemQty(item, 1)" class="px-2 hover:text-neutral-400 transition-colors cursor-pointer">+</button>
                    </div>
                    <p class="font-bold text-lg ml-auto">{{ (item.price * item.quantity).toLocaleString() }} MAD</p>
                  </div>
                </div>
              </div>
            </div>

            <div class="pt-4 border-t border-neutral-100 flex justify-between items-end">
              <p class="text-neutral-500 text-sm">Subtotal</p>
              <p class="text-2xl md:text-3xl font-bold tracking-tighter">{{ subtotal.toLocaleString() }} MAD</p>
            </div>
          </div>

          <!-- Right Column: Checkout Form -->
          <div class="lg:sticky lg:top-8  mt-8">
            <div class="mb-12">
              <h2 class="text-2xl md:text-3xl tracking-tighter mb-2">Shipping Information</h2>
              <div class="h-1 w-12 bg-black"></div>
            </div>
            
            <form @submit.prevent="submitOrder" class="space-y-10">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                <div class="relative group border-b border-neutral-200 focus-within:border-black transition-colors duration-300 pb-2">
                  <label class="block text-[10px] uppercase tracking-[0.2em] text-neutral-400 mb-1 group-focus-within:text-black transition-colors">First Name</label>
                  <input v-model="form.first_name" type="text" required class="w-full bg-transparent border-none outline-none py-1 text-sm font-medium placeholder:text-neutral-300" placeholder="John">
                </div>
                <div class="relative group border-b border-neutral-200 focus-within:border-black transition-colors duration-300 pb-2">
                  <label class="block text-[10px] uppercase tracking-[0.2em] text-neutral-400 mb-1 group-focus-within:text-black transition-colors">Last Name</label>
                  <input v-model="form.last_name" type="text" required class="w-full bg-transparent border-none outline-none py-1 text-sm font-medium placeholder:text-neutral-300" placeholder="Doe">
                </div>
              </div>

              <div class="relative group border-b border-neutral-200 focus-within:border-black transition-colors duration-300 pb-2">
                <label class="block text-[10px] uppercase tracking-[0.2em] text-neutral-400 mb-1 group-focus-within:text-black transition-colors">Email Address</label>
                <input v-model="form.email" type="email" required class="w-full bg-transparent border-none outline-none py-1 text-sm font-medium placeholder:text-neutral-300" placeholder="john@example.com">
              </div>

              <div class="relative group border-b border-neutral-200 focus-within:border-black transition-colors duration-300 pb-2">
                <label class="block text-[10px] uppercase tracking-[0.2em] text-neutral-400 mb-1 group-focus-within:text-black transition-colors">Phone Number</label>
                <input v-model="form.phone" type="tel" required class="w-full bg-transparent border-none outline-none py-1 text-sm font-medium placeholder:text-neutral-300" placeholder="+212 ...">
              </div>

              <div class="relative group border-b border-neutral-200 focus-within:border-black transition-colors duration-300 pb-2">
                <label class="block text-[10px] uppercase tracking-[0.2em] text-neutral-400 mb-1 group-focus-within:text-black transition-colors">Shipping Address</label>
                <input v-model="form.address" type="text" required class="w-full bg-transparent border-none outline-none py-1 text-sm font-medium placeholder:text-neutral-300" placeholder="Street name and number">
              </div>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                <div class="relative group border-b border-neutral-200 focus-within:border-black transition-colors duration-300 pb-2">
                  <label class="block text-[10px] uppercase tracking-[0.2em] text-neutral-400 mb-1 group-focus-within:text-black transition-colors">City</label>
                  <input v-model="form.city" type="text" required class="w-full bg-transparent border-none outline-none py-1 text-sm font-medium placeholder:text-neutral-300" placeholder="Casablanca">
                </div>
                <div class="relative group border-b border-neutral-200 focus-within:border-black transition-colors duration-300 pb-2">
                  <label class="block text-[10px] uppercase tracking-[0.2em] text-neutral-400 mb-1 group-focus-within:text-black transition-colors">Postal Code</label>
                  <input v-model="form.zip" type="text" class="w-full bg-transparent border-none outline-none py-1 text-sm font-medium placeholder:text-neutral-300" placeholder="20000">
                </div>
              </div>

              <div class="pt-12 space-y-6">
                <div class="flex justify-between items-center">
                  <span class="text-[10px] uppercase tracking-[0.2em] text-neutral-400">Shipping</span>
                  <span class="text-[10px] uppercase tracking-[0.2em] font-bold text-emerald-600">Free of charge</span>
                </div>
                <div class="flex justify-between items-end pt-6 border-t border-neutral-100">
                  <span class="text-xs uppercase tracking-[0.3em] font-black">Final Total</span>
                  <span class="text-3xl md:text-4xl font-black tracking-tighter">{{ subtotal.toLocaleString() }} MAD</span>
                </div>

                <button type="submit" :disabled="isLoading" class="w-full bg-black text-white py-6 mt-8 rounded-none font-bold text-[10px] uppercase border-2 border-black hover:bg-white hover:text-black transition-all duration-500 disabled:opacity-50 cursor-pointer">
                  <span v-if="!isLoading">Finalize Order</span>
                  <span v-else>Processing...</span>
                </button>
                
                <p v-if="errorMessage" class="text-red-500 text-[10px] font-bold text-center mt-4 uppercase tracking-widest">{{ errorMessage }}</p>
                
                <div class="pt-12 flex items-center justify-center gap-6">
                  <div class="h-px flex-1 bg-neutral-100"></div>
                  <div class="flex items-center gap-3 opacity-30">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    <p class="text-[8px] uppercase tracking-[0.3em]">End-to-End Encryption</p>
                  </div>
                  <div class="h-px flex-1 bg-neutral-100"></div>
                </div>
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
import axios from 'axios';

const isOpen = ref(false);
const isSuccess = ref(false);
const orderId = ref(null);
const cartItems = ref([]);
const isLoading = ref(false);
const errorMessage = ref('');

const form = ref({
  first_name: '',
  last_name: '',
  email: '',
  phone: '',
  address: '',
  city: '',
  zip: ''
});

const subtotal = computed(() => {
  return cartItems.value.reduce((total, item) => total + (item.price * item.quantity), 0);
});

const closeCart = () => {
  isOpen.value = false;
  isSuccess.value = false; // Reset success state when closing
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

const submitOrder = async () => {
  if (cartItems.value.length === 0) {
      errorMessage.value = "Your cart is empty.";
      return;
  }
  
  isLoading.value = true;
  errorMessage.value = '';

  try {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    const fullAddress = `${form.value.address}, ${form.value.city}, ${form.value.zip}`;
    
    const payload = {
      customer_name: `${form.value.first_name} ${form.value.last_name}`.trim(),
      customer_email: form.value.email,
      customer_phone: form.value.phone,
      address: fullAddress,
      items: cartItems.value.map(item => ({ id: item.id, quantity: item.quantity })),
    };

    const { data } = await axios.post('/checkout', payload, {
      headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
    });

    if (data.success) {
        orderId.value = data.order_id;
        
        // Brief delay to let the processing state be visible
        setTimeout(() => {
          isSuccess.value = true;
          cartItems.value = [];
          saveCart();
          // Clear form
          form.value = { first_name: '', last_name: '', email: '', phone: '', address: '', city: '', zip: '' };
        }, 1000);
    } else {
        errorMessage.value = data.message || 'Something went wrong.';
    }
  } catch (err) {
      errorMessage.value = err.response?.data?.message || 'Unable to process your order. Please try again.';
  } finally {
      isLoading.value = false;
  }
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
  transition: opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

/* Minimalist scrollbar */
.fixed::-webkit-scrollbar {
  width: 2px;
}

.fixed::-webkit-scrollbar-track {
  background: white;
}

.fixed::-webkit-scrollbar-thumb {
  background: black;
}

@keyframes success-check {
  0% { stroke-dashoffset: 100; opacity: 0; }
  100% { stroke-dashoffset: 0; opacity: 1; }
}

@keyframes fade-in-slow {
  0% { opacity: 0; transform: translateY(10px); }
  100% { opacity: 1; transform: translateY(0); }
}

.animate-success-check {
  stroke-dasharray: 100;
  animation: success-check 0.8s cubic-bezier(0.65, 0, 0.45, 1) forwards 0.3s;
}

.animate-fade-in-slow {
  animation: fade-in-slow 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}
</style>
