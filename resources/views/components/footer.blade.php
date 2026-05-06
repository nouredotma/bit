<footer class="bg-white border-t border-gray-100 py-20 px-10">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12">
        <div class="col-span-1 md:col-span-2">
            <h2 class="text-2xl font-bold tracking-tighter mb-6 italic">WER STORE</h2>
            <p class="text-gray-400 text-sm max-w-xs leading-relaxed uppercase tracking-widest">Minimalist approach to modern essentials. Designed for the future, crafted for the now.</p>
        </div>
        <div>
            <h3 class="text-xs font-bold uppercase tracking-[0.3em] mb-6">Navigation</h3>
            <ul class="space-y-4 text-xs uppercase tracking-widest font-medium">
                <li><a href="{{ route('home') }}" class="hover:opacity-50">Home</a></li>
                <li><a href="{{ route('products') }}" class="hover:opacity-50">Products</a></li>
                <li><a href="{{ route('about') }}" class="hover:opacity-50">About</a></li>
                <li><a href="{{ route('contact') }}" class="hover:opacity-50">Contact</a></li>
            </ul>
        </div>
        <div>
            <h3 class="text-xs font-bold uppercase tracking-[0.3em] mb-6">Social</h3>
            <ul class="space-y-4 text-xs uppercase tracking-widest font-medium">
                <li><a href="#" class="hover:opacity-50">Instagram</a></li>
                <li><a href="#" class="hover:opacity-50">Twitter</a></li>
                <li><a href="#" class="hover:opacity-50">Facebook</a></li>
            </ul>
        </div>
    </div>
    <div class="max-w-7xl mx-auto mt-20 pt-10 border-t border-gray-50 flex justify-between items-center text-[10px] uppercase tracking-widest text-gray-400">
        <p>&copy; 2025 WER STORE. All rights reserved.</p>
        <p>Built for the digital age</p>
    </div>
</footer>
