<x-app-layout>
    <section>
        <div class="pt-4 pb-12">
            <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
                <x-breadcrumbs :links="[['label' => 'Home', 'url' => route('home')], ['label' => 'Transactions']]" />

                <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                    <div class="py-8">
                        <header class="mb-6 px-6">
                            <h2 class="text-2xl font-bold text-gray-900">Transaction History</h2>
                            <p class="mt-2 text-gray-500">Your recent transactions and payment statuses.</p>
                        </header>

                        <!-- Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Property</th>
                                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Rental Period
                                        </th>
                                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Total Payment
                                        </th>
                                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Status</th>
                                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($transactions as $transaction)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-800 font-medium">
                                                {{ $transaction['property'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                                                {{ $transaction['rental_period'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap font-semibold text-gray-900">
                                                Rp{{ number_format($transaction['total'], 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @php
                                                    $statusClasses = [
                                                        'pending_payment' => 'bg-yellow-100 text-yellow-800',
                                                        'confirmed' => 'bg-blue-100 text-blue-800',
                                                        'cancelled' => 'bg-red-100 text-red-800',
                                                        'completed' => 'bg-green-100 text-green-800',
                                                    ];
                                                @endphp
                                                <span
                                                    class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClasses[$transaction['status']] ?? 'bg-gray-100 text-gray-800' }}">
                                                    {{ ucfirst(str_replace('_', ' ', $transaction['status'])) }}
                                                </span>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap flex gap-2 items-center">
                                                {{-- Actions sesuai status --}}
                                                @if ($transaction['status'] === 'completed')
                                                    <button onclick="showReceipt('{{ $transaction['id'] }}')"
                                                        class="px-3 py-1 text-sm bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                                                        Lihat Nota
                                                    </button>
                                                @elseif ($transaction['status'] === 'pending_payment')
                                                    <a href="{{ route('booking.payment', $transaction['id']) }}"
                                                        class="px-3 py-1 text-sm bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition">
                                                        Edit
                                                    </a>

                                                    <form method="POST"
                                                        action="{{ route('transactions.destroy', $transaction['id']) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="px-3 py-1 text-sm bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                                                            Cancel
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="text-gray-400 text-sm italic">No actions</span>
                                                @endif

                                                {{-- Tampilkan icon note + modal jika ada remark --}}
                                                @if (in_array($transaction['payment_status'], ['rejected', 'cancelled']) && !empty($transaction['remark']))
                                                    <button type="button"
                                                        onclick="openRemarkModal('{{ $transaction['id'] }}')"
                                                        class="ml-1 text-blue-500 hover:text-blue-700"
                                                        title="View Remark">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M9 12h6m-6 4h6m2 4H7a2 2 0
                                                                01-2-2V6a2 2 0 012-2h7l5 5v11a2 2 0 01-2 2z" />
                                                        </svg>
                                                    </button>

                                                    <!-- Modal Remark -->
                                                    <div id="remarkModal-{{ $transaction['id'] }}"
                                                        class="hidden fixed inset-0 z-50 flex items-center justify-center">
                                                        <div class="absolute inset-0 bg-black bg-opacity-50"
                                                            onclick="closeRemarkModal('{{ $transaction['id'] }}')">
                                                        </div>
                                                        <div
                                                            class="relative bg-white rounded-xl shadow-lg p-6 w-full max-w-sm animate-zoomIn">
                                                            <div class="flex justify-between items-center mb-4">
                                                                <h3 class="text-lg font-semibold text-gray-900">
                                                                    Remark - {{ $transaction['property'] }}
                                                                </h3>
                                                                <button
                                                                    onclick="closeRemarkModal('{{ $transaction['id'] }}')"
                                                                    class="text-gray-400 hover:text-gray-600">✕</button>
                                                            </div>
                                                            <div
                                                                class="bg-gray-50 p-3 rounded-md text-gray-700 text-sm leading-relaxed">
                                                                {{ $transaction['remark'] }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                                No transactions found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Nota -->
    <div id="receiptModal" class="hidden fixed inset-0 z-50 flex items-center justify-center">
        <div class="absolute inset-0 bg-black bg-opacity-50" onclick="closeModal()"></div>
        <div class="relative bg-white rounded-xl shadow-lg p-6 w-full max-w-md animate-zoomIn">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Nota Transaksi</h2>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">✕</button>
            </div>
            <div id="receiptContent" class="space-y-2 text-sm text-gray-700">
                <!-- Data nota akan diisi via JS -->
            </div>
            <div class="mt-4 text-right">
                <button onclick="closeModal()"
                    class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Tutup</button>
            </div>
        </div>
    </div>

    <script>
        function openRemarkModal(id) {
            document.getElementById('remarkModal-' + id).classList.remove('hidden');
        }

        function closeRemarkModal(id) {
            document.getElementById('remarkModal-' + id).classList.add('hidden');
        }

      async function showReceipt(id) {
    try {
        console.log("Booking code yang dikirim:", id); // cek apakah benar booking_code

        const res = await fetch(`/transactions/${id}/receipt`);
        if (!res.ok) {
            throw new Error(`HTTP error! status: ${res.status}`);
        }

        const data = await res.json();
        console.log("Data nota:", data); // cek isi response

        let html = `
            <p><strong>ID Booking:</strong> ${data.id}</p>
            <p><strong>Property:</strong> ${data.property_name}</p>
            <p><strong>Customer:</strong> ${data.customer}</p>
            <p><strong>Rental Period:</strong> ${data.start_date} - ${data.end_date} (${data.days} malam)</p>
            <p><strong>Total Payment:</strong> Rp${data.total_payment}</p>
            <p><strong>Status:</strong> ${data.status}</p>
        `;

        document.getElementById('receiptContent').innerHTML = html;
        document.getElementById('receiptModal').classList.remove('hidden');
    } catch (error) {
        console.error("Error fetch nota:", error);
        alert('Gagal memuat nota!');
    }
}


        function closeModal() {
            document.getElementById('receiptModal').classList.add('hidden');
        }
    </script>

    <style>
        @keyframes zoomIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .animate-zoomIn {
            animation: zoomIn 0.25s ease-out;
        }
    </style>
</x-app-layout>
