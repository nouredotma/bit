<template>
    <div class="max-w-2xl mx-auto">
        <form v-if="!success" @submit.prevent="submitForm" class="space-y-6">
            <div>
                <label class="block text-sm font-semibold text-gray-500 mb-2">Your Name</label>
                <input v-model="form.name" type="text" class="checkout-input" placeholder="John Doe" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-500 mb-2">Email Address</label>
                <input v-model="form.email" type="email" class="checkout-input" placeholder="john@example.com" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-500 mb-2">Message</label>
                <textarea v-model="form.message" rows="6" class="checkout-input" placeholder="How can we help you?" required></textarea>
            </div>

            <div v-if="errorMsg" class="bg-red-50 text-red-600 px-5 py-3 rounded-lg text-sm font-medium">{{ errorMsg }}</div>

            <button type="submit" :disabled="loading" class="btn-primary w-full flex items-center justify-center gap-3 disabled:opacity-50 disabled:cursor-not-allowed">
                <svg v-if="loading" class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                <span>{{ loading ? 'Sending...' : 'Send Message' }}</span>
            </button>
        </form>

        <div v-else class="text-center py-20">
            <div class="w-20 h-20 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-6 text-green-500">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg>
            </div>
            <h3 class="text-2xl font-bold mb-3">Message Sent!</h3>
            <p class="text-gray-500 text-sm mb-8">We'll get back to you as soon as possible.</p>
            <a href="/" class="btn-primary inline-block">Back to Home</a>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';

const loading = ref(false);
const errorMsg = ref('');
const success = ref(false);

const form = ref({
    name: '',
    email: '',
    message: '',
});

async function submitForm() {
    loading.value = true;
    errorMsg.value = '';

    try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        const { data } = await axios.post('/contact', form.value, {
            headers: { 'X-CSRF-TOKEN': csrfToken }
        });

        if (data.success) {
            success.value = true;
        } else {
            errorMsg.value = data.message || 'Something went wrong.';
        }
    } catch (err) {
        if (err.response?.data?.errors) {
            errorMsg.value = Object.values(err.response.data.errors).flat()[0];
        } else {
            errorMsg.value = 'Unable to send your message. Please try again.';
        }
    } finally {
        loading.value = false;
    }
}
</script>
