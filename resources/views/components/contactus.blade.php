<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>
<div id="contactModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50">
    <div class="bg-white w-[90%] max-w-lg rounded-2xl p-8 relative">
        <button onclick="closeModal()" class="absolute top-5 right-5 text-3xl text-slate-400 hover:text-black">
            &times;
        </button>

        <h2 class="text-4xl font-black my-6">
            Get In Touch
        </h2>

        <p class="text-slate-600 leading-relaxed mb-8">
            Interested in working together, collaborating, or just saying hello? Feel free to reach out anytime.
        </p>

        <form class="space-y-5">
            <input type="text" placeholder="Your Name"
            class="w-full border border-slate-200 rounded-2xl px-5 py-4 outline-none focus:border-slate-900" />

            <input type="email" placeholder="Your Email"
            class="w-full border border-slate-200 rounded-2xl px-5 py-4 outline-none focus:border-slate-900" />

            <textarea rows="5" placeholder="Your Message"
            class="w-full border border-slate-200 rounded-2xl px-5 py-4 outline-none focus:border-slate-900 resize-none"></textarea>

            <button type="submit"
            class="w-full bg-slate-900 text-white py-4 rounded-2xl font-medium hover:opacity-90 transition">
            Send Message
            </button>
        </form>
    </div>
    
    @script
    <script>
        window.openModal = function() {
            const modal = document.getElementById('contactModal');

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            document.body.style.overflow = 'hidden';
        }

        window.closeModal = function() {
            const modal = document.getElementById('contactModal');

            modal.classList.remove('flex');
            modal.classList.add('hidden');

            document.body.style.overflow = 'auto';
        }

        window.addEventListener('click', function (e) {
            const modal = document.getElementById('contactModal');

            if (e.target === modal) {
                window.closeModal();
            }
        });
    </script>
    @endscript
</div>