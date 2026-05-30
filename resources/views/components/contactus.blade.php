<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div id="contact" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden flex items-center justify-center z-50">
     <div id="toast"
        class="hidden w-[90%] max-w-md absolute top-2 left-1/2 -translate-x-1/2 bg-green-500 opacity-0 text-white px-6 py-3 my-6 rounded-lg shadow-lg transition-all duration-300 z-[100]">
    </div>
    
    <div class="bg-white w-[90%] max-w-lg rounded-2xl p-6 md:p-8 relative overflow-hidden">
        <button id="button-close" class="absolute top-3 right-5 text-3xl">
            &times;
        </button>
        <h2 class="text-3xl md:text-4xl font-black my-3">
            Get In Touch
        </h2>
        <p class="text-sm md:text-base text-slate-600 leading-relaxed mb-4">
            Interested in working together, collaborating, or just saying hello? Feel free to reach out anytime.
        </p>
        <div class="mb-3">
            <input type="text" id="name" placeholder="Your Name"
                class="input w-full border rounded-lg p-3 outline-none border-slate-200 text-sm md:text-base"
                oninput="checkName(this)" />
            <p id="name-error" class="m-2 text-xs text-red-500 hidden"></p>
        </div>
        <div class="mb-3">
            <input type="email" id="email" placeholder="Your Email"
                class="input w-full border rounded-lg p-3 outline-none border-slate-200 text-sm md:text-base" />
            <p id="email-error" class="m-2 text-xs text-red-500 hidden"></p>
        </div>
        <div class="mb-3">
            <input type="text" id="subject" placeholder="Your Email Subject"
                class="input w-full border rounded-lg p-3 outline-none border-slate-200 text-sm md:text-base"  />
            <p id="subject-error" class="m-2 text-xs text-red-500 hidden"></p>
        </div>
        <div class="mb-3">
            <textarea rows="4" id="message" placeholder="Your Message"
                class="input w-full border rounded-lg p-3 outline-none resize-none border-slate-200 text-sm md:text-base" 
                maxlength="500" onkeyup="checkMessage()"></textarea>
            <div class="flex justify-between">
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
                input.classList.remove('border-red-500')
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
                        .classList.toggle('border-red-500', data.errors.hasOwnProperty(field))
                });
                return;
            }

            window.showToast('Message sent successfully');
        }

        contact.addEventListener('click', function (e) {
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