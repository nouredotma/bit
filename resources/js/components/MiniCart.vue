<template>
  <div class="relative">
    <button @click="toggleCart" class="relative group p-2 -mr-2 hover:bg-gray-50 rounded-full transition-colors">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
      <span v-if="itemCount > 0" class="absolute top-0 right-0 bg-black text-white text-[10px] font-bold h-5 w-5 flex items-center justify-center rounded-full border-2 border-white">{{ itemCount }}</span>
    </button>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const itemCount = ref(0);

const toggleCart = () => {
  window.dispatchEvent(new CustomEvent('toggle-cart'));
};

onMounted(() => {
  // Listen for cart updates
  window.addEventListener('cart-updated', (e) => {
    itemCount.value = e.detail.length;
  });
});
</script>
