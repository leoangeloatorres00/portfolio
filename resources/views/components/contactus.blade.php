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

        <div
            id="toast"
            class="hidden bg-green-500 text-white px-6 py-3 my-6 rounded-lg shadow-lg opacity-0 transition-all duration-300"
        >
        </div>

        <h2 class="text-4xl font-black my-6">
            Get In Touch
        </h2>

        <p class="text-slate-600 leading-relaxed mb-8">
            Interested in working together, collaborating, or just saying hello? Feel free to reach out anytime.
        </p>

        <form>
            <div class="mb-5">
                <input type="text" id="name" placeholder="Your Name"
                class="w-full border rounded-2xl px-5 py-4 outline-none focus:border-slate-900 border-slate-200" oninput="checkName(this)"/>

                <p id="name-error" class="m-2 text-xs text-red-500 hidden"></p>
            </div>

            <div class="mb-5">
                <input type="email" id="email" placeholder="Your Email"
                class="w-full border rounded-2xl px-5 py-4 outline-none focus:border-slate-900 border-slate-200" />

                <p id="email-error" class="m-2 text-xs text-red-500 hidden"></p>
            </div>

            <div class="mb-5">
                <textarea rows="5" id="message" placeholder="Your Message"
                class="w-full border rounded-2xl px-5 py-4 outline-none focus:border-slate-900 resize-none border-slate-200" maxlength="500" onkeyup="checkMessage()"></textarea>
                
                <div class="grid grid-cols-2">
                    <div>
                        <p id="message-error" class="m-2 text-xs text-red-500 hidden"></p>
                    </div>
                    <div class="text-xs text-right">
                        <span id="current">0</span>
                        <span id="maximum">/ 500</span>
                    </div>
                </div>
            </div>

            <button onclick="submitForm()"
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
            e.preventDefault();
            const modal = document.getElementById('contactModal');
            
            if (e.target === modal) {
                window.closeModal();
            }
        });

        window.submitForm = async function() {
            clearErrors();

            const formData = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                message: document.getElementById('message').value,
            };

            const response = await fetch('/api/email', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document
                        .querySelector('meta[name="csrf-token"]')
                        .content
                },
                body: JSON.stringify(formData)
            });

            if (response.status === 422) {
                const data = await response.json();
                Object.keys(data.errors).forEach(field => {
                    document
                        .getElementById(`${field}-error`)
                        .innerText = data.errors[field][0];
                    
                    document
                        .getElementById(`${field}-error`)
                        .classList.remove('hidden')
                });
                return;
            }

            window.showToast('Message sent successfully');
        }

        window.checkMessage = function() {
            let count = document.getElementById('message').value.length
            let current = document.getElementById('current')
           
            current.innerText = count;
        }

        window.checkName = function(input) {
            input.value = input.value
            .toLowerCase()
            .replace(/\b\w/g, char => char.toUpperCase());
        }
        window.showToast = function(message) {
            document.getElementById('name').value = '';
            document.getElementById('email').value = '';
            document.getElementById('message').value = '';

            window.checkMessage();

            const toast = document.getElementById('toast');

            toast.innerText = message;

            toast.classList.remove('hidden');

            setTimeout(() => {
                toast.classList.remove('opacity-0');
                toast.classList.add('opacity-100');
            }, 10);

            setTimeout(() => {

                toast.classList.remove('opacity-100');
                toast.classList.add('opacity-0');

                setTimeout(() => {
                    toast.classList.add('hidden');
                }, 300);

            }, 3000);
        }

        function clearErrors() {
            document.getElementById('name-error').innerText = '';
            document.getElementById('email-error').innerText = '';
            document.getElementById('message-error').innerText = '';

            document.getElementById('name-error').classList.add('hidden');
            document.getElementById('email-error').classList.add('hidden');
            document.getElementById('message-error').classList.add('hidden');
        }

    </script>
    @endscript
</div>