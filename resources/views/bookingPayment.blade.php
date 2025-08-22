<x-app-layout>
    <div class="max-w-3xl mx-auto my-6 bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden">
        {{-- Header --}}
        <header class="flex flex-wrap justify-between items-center gap-2 p-4 border-b border-gray-200">
            <h1 class="text-lg font-semibold">Booking Payment</h1>
            <span class="inline-block px-3 py-1 text-xs font-semibold text-gray-700 bg-gray-100 rounded-full">
                #{{ $booking->id }}
            </span>
        </header>

        <main class="p-6 space-y-6">
            {{-- Flash & errors --}}
            @if (session('success'))
                <div class="p-3 rounded-lg bg-green-50 border border-green-300 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="p-3 rounded-lg bg-red-50 border border-red-300 text-red-800">
                    <ul class="list-disc list-inside m-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Payment Info --}}
            <section class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
                <h2 class="text-md font-semibold mb-3">Payment Info</h2>
                <div class="grid md:grid-cols-2 gap-4">
                    {{-- Left Column --}}
                    <div class="space-y-3">
                        <div class="border border-gray-200 rounded-xl p-3">
                            <div class="flex items-center justify-between gap-3">
                                <div>
                                    <div class="text-xs text-gray-500">Account Number</div>
                                    <div id="acctNumber" class="text-lg font-bold tracking-wide">872450823745</div>
                                </div>
                                <button type="button" class="btn-secondary btn-sm" data-copy="#acctNumber">Copy</button>
                            </div>
                        </div>
                        <div class="border border-gray-200 rounded-xl p-3">
                            <div class="text-xs text-gray-500">Bank</div>
                            <div class="font-bold">BCA</div>
                        </div>
                    </div>

                    {{-- Right Column --}}
                    <div class="space-y-3">
                        <div class="border border-gray-200 rounded-xl p-3">
                            <div class="text-xs text-gray-500">Account Name</div>
                            <div class="font-bold">Mr. diy</div>
                        </div>
                        <div class="border border-gray-200 rounded-xl p-3">
                            <div class="flex items-center justify-between gap-3">
                                <div>
                                    <div class="text-xs text-gray-500">Price to pay</div>
                                    <div id="amountToPay" class="text-lg font-bold">Rp. 2.000.000</div>
                                </div>
                                <button type="button" class="btn-secondary btn-sm" data-copy="#amountToPay">Copy</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Booking Summary & Proof --}}
            <div class="grid md:grid-cols-2 gap-4">
                {{-- Booking Summary --}}
                <section class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
                    <h2 class="text-md font-semibold mb-3">Booking Summary</h2>
                    <div class="grid grid-cols-[160px_1fr] gap-x-3 gap-y-2 text-sm">
                        <strong>Total</strong>
                        <div>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</div>

                        <strong>Status</strong>
                        <div>{{ $payment->payment_status }}</div>

                        <strong>Due</strong>
                        <div>{{ $payment->payment_due_date->format('Y-m-d H:i') }}</div>

                        <strong>Period</strong>
                        <div>{{ $booking->start_date->format('Y-m-d') }} → {{ $booking->end_date->format('Y-m-d') }}</div>
                    </div>
                </section>

                {{-- Payment Proof --}}
                <section class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
                    <h2 class="text-md font-semibold mb-3">Payment Proof</h2>

                    @if($payment->proof_image)
                        <p class="text-gray-500 mb-2">Your uploaded proof:</p>
                        <img src="{{ asset('storage/'.$payment->proof_image) }}" alt="Payment proof" class="w-full rounded-lg border border-gray-200 object-contain max-h-64">
                    @else
                        <p class="text-gray-500 mb-3">Upload a clear photo/screenshot of your bank transfer receipt. Accepted: JPG, PNG, WEBP (max 5MB).</p>
                        <button id="openProofModal" type="button" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold">Verify bank transfer proof</button>
                    @endif
                </section>
            </div>
        </main>
    </div>

    {{-- Modal --}}
    <div id="proofModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-start justify-center p-4 overflow-auto">
        <div class="bg-white rounded-xl w-full max-w-lg shadow-xl flex flex-col overflow-hidden">
            <header class="flex justify-between items-center p-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold">Upload Payment Proof</h3>
                <button id="closeProofModal" type="button" class="btn-secondary btn-sm">Close</button>
            </header>

            <form id="proofForm" action="{{ route('booking.payment.proof', $booking) }}" method="POST" enctype="multipart/form-data" class="flex flex-col flex-1">
                @csrf
                <div class="p-4 flex flex-col gap-3 overflow-auto">
                    <input id="proofInput" type="file" name="proof_image" accept="image/*" hidden>

                    <div class="flex items-center gap-3">
                        <button id="browseBtn" type="button" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold">Browse image…</button>
                        <span id="fileName" class="text-gray-500 text-sm"></span>
                    </div>

                    <div id="previewWrap" class="hidden flex flex-col gap-1">
                        <p class="text-gray-500 text-sm m-0">Preview:</p>
                        <img id="previewImg" src="" alt="Preview" class="w-full rounded-lg border border-gray-200 object-contain max-h-64">
                    </div>
                </div>

                <div class="flex justify-end gap-3 p-4 border-t border-gray-200">
                    <button type="button" id="cancelBtn" class="btn-secondary btn-sm">Cancel</button>
                    <button id="sendProofBtn" type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg font-semibold" disabled>Send proof</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Scripts --}}
    @push('scripts')
    <script>
        // Copy-to-clipboard
        document.querySelectorAll('[data-copy]').forEach(btn => {
            btn.addEventListener('click', () => {
                const target = document.querySelector(btn.getAttribute('data-copy'));
                if (!target) return;
                navigator.clipboard.writeText(target.textContent.trim())
                    .then(() => {
                        const prev = btn.textContent;
                        btn.textContent = 'Copied!';
                        setTimeout(() => btn.textContent = prev, 1400);
                    });
            });
        });

        // Modal logic
        const openBtn   = document.getElementById('openProofModal');
        const modal     = document.getElementById('proofModal');
        const closeBtn  = document.getElementById('closeProofModal');
        const cancelBtn = document.getElementById('cancelBtn');
        const browseBtn = document.getElementById('browseBtn');
        const input     = document.getElementById('proofInput');
        const preview   = document.getElementById('previewWrap');
        const previewImg= document.getElementById('previewImg');
        const fileName  = document.getElementById('fileName');
        const sendBtn   = document.getElementById('sendProofBtn');

        if (openBtn) {
            function openModal(){
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
            function closeModal(){
                modal.classList.add('hidden');
                document.body.style.overflow = '';
                if (input) input.value='';
                if (preview) preview.classList.add('hidden');
                if (sendBtn) sendBtn.disabled = true;
                if (fileName) fileName.textContent = '';
            }

            openBtn.addEventListener('click', openModal);
            closeBtn.addEventListener('click', closeModal);
            cancelBtn.addEventListener('click', closeModal);
            browseBtn.addEventListener('click', () => input.click());

            input.addEventListener('change', () => {
                if (!input.files || !input.files[0]) {
                    preview.classList.add('hidden');
                    sendBtn.disabled = true;
                    fileName.textContent = '';
                    return;
                }
                const file = input.files[0];
                fileName.textContent = `${file.name} (${Math.round(file.size/1024)} KB)`;
                const reader = new FileReader();
                reader.onload = e => {
                    previewImg.src = e.target.result;
                    preview.classList.remove('hidden');
                    sendBtn.disabled = false;
                };
                reader.readAsDataURL(file);
            });

            modal.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });
            window.addEventListener('keydown', (e) => { if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal(); });
        }
    </script>
    @endpush
</x-app-layout>
