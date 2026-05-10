import './bootstrap';
import { createApp } from 'vue';

// Import only the components we actually use
import Cart from './components/Cart.vue';
import MiniCart from './components/MiniCart.vue';
import CheckoutForm from './components/CheckoutForm.vue';
import ContactForm from './components/ContactForm.vue';

const app = createApp({});

app.component('cart', Cart);
app.component('mini-cart', MiniCart);
app.component('checkout-form', CheckoutForm);
app.component('contact-form', ContactForm);

app.mount('#app');
