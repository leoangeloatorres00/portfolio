<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div id="contact" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden flex items-center justify-center z-50">
    <div class="bg-white w-[90%] max-w-lg rounded-2xl p-8 relative overflow-hidden">
        <button id="button-close" class="absolute top-5 right-5 text-3xl">
            &times;
        </button>
        <div id="toast"
            class="hidden bg-green-500 text-white px-6 py-3 my-6 rounded-lg shadow-lg opacity-0 transition-all duration-300">
        </div>
        <h2 class="text-3xl md:text-4xl font-black my-4">
            Get In Touch
        </h2>
        <p class="text-sm md:text-base text-slate-600 leading-relaxed mb-8">
            Interested in working together, collaborating, or just saying hello? Feel free to reach out anytime.
        </p>
        <form>
            <div class="mb-4">
                <input type="text" id="name" placeholder="Your Name"
                    class="input w-full border rounded-2xl px-5 py-4 outline-none focus:border-slate-900 border-slate-200"
                    oninput="checkName(this)" />
                <p id="name-error" class="m-2 text-xs text-red-500 hidden"></p>
            </div>
            <div class="mb-4">
                <input type="email" id="email" placeholder="Your Email"
                    class="input w-full border rounded-2xl px-5 py-4 outline-none focus:border-slate-900 border-slate-200" />
                <p id="email-error" class="m-2 text-xs text-red-500 hidden"></p>
            </div>
            <div class="mb-4">
                <input type="text" id="subject" placeholder="Your Email Subject"
                    class="input w-full border rounded-2xl px-5 py-4 outline-none focus:border-slate-900 border-slate-200" />
                <p id="subject-error" class="m-2 text-xs text-red-500 hidden"></p>
            </div>
            <div class="mb-4">
                <textarea rows="5" id="message" placeholder="Your Message"
                    class="input w-full border rounded-2xl px-5 py-4 outline-none focus:border-slate-900 resize-none border-slate-200"
                    maxlength="500" onkeyup="checkMessage()"></textarea>
                <div class="grid grid-cols-2">
                    <div>
                        <p id="message-error" class="m-2 text-xs text-red-500 hidden"></p>
                    </div>
                    <div class="m-2 text-xs text-right">
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
        const inputs = document.querySelectorAll('.input');
        const buttonClose = document.getElementById('button-close');
        const buttonContactUs = document.getElementById('button-contact');

        const contact = document.getElementById('contact');

        buttonContactUs.addEventListener('click', () => {
            handleBackdrop(contact)
        });

        buttonClose.addEventListener('click', () => {
            handleBackdrop(contact);
        });

        window.submitForm = async function() {
            clearErrors();

            const formData = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                subject: document.getElementById('subject').value,
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

            inputs.forEach(input => {
                input.classList.remove('border-red-200')
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
            
                    document
                        .getElementById(`${field}`)
                        .classList.toggle('border', data.errors.hasOwnProperty(field))
                    
                    document
                        .getElementById(`${field}`)
                        .classList.toggle('border-red-200', data.errors.hasOwnProperty(field))
                });
                return;
            }

            window.showToast('Message sent successfully');
        }

        window.addEventListener('click', function (e) {
            if (e.target === contact) {
                handleBackdrop(contact);
            }
        });

        window.checkMessage = function() {
            let count = document.getElementById('message').value.length
            let current = document.getElementById('current')
           
            current.innerText = count;
        }

        window.showToast = function(message) {
            clearForm();

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

        window.checkName = function(input) {
            input.value = input.value
            .toLowerCase()
            .replace(/\b\w/g, char => char.toUpperCase());
        }

        function clearErrors() {
            document.getElementById('name-error').innerText = '';
            document.getElementById('email-error').innerText = '';
            document.getElementById('subject-error').innerText = '';
            document.getElementById('message-error').innerText = '';

            document.getElementById('name-error').classList.add('hidden');
            document.getElementById('email-error').classList.add('hidden');
            document.getElementById('subject-error').classList.add('hidden');
            document.getElementById('message-error').classList.add('hidden');
        }

        function clearForm() {
            document.getElementById('name').value = '';
            document.getElementById('email').value = '';
            document.getElementById('subject').value = '';
            document.getElementById('message').value = '';
        }
    </script>
    @endscript
</div>