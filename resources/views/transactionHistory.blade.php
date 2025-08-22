<x-app-layout>
    <section>
        <div class="pt-4 pb-12">
            <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8"> <!-- full width container -->
                <x-breadcrumbs :links="[['label' => 'Home', 'url' => route('home')], ['label' => 'Transactions', 'url' => '']]" />
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="py-8">
    
                            <header class="mb-6 px-4 sm:px-6 lg:px-8">
                                <h2 class="text-xl font-bold text-gray-900 sm:text-3xl">Transaction History</h2>
                                <p class="mt-2 text-gray-500 max-w-md">Your recent transactions and payment statuses.</p>
                            </header>
    
                            <!-- Search Bar -->
                            <div class="flex justify-end mb-6 px-4 sm:px-6 lg:px-8">
                                <form action="#" method="GET" class="flex items-center w-full sm:w-1/3">
                                    <input type="text" name="search" placeholder="Search by product, status..."
                                        class="w-full rounded-md border-gray-300 text-sm px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <button type="submit"
                                        class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                                        Search
                                    </button>
                                </form>
                            </div>
    
                            <!-- Full-width Transaction Table -->
                            <div class="overflow-x-auto px-4 sm:px-6 lg:px-8">
                                @php
                                    $transactions = [
                                        [
                                            'product' => 'Apartment A',
                                            'date' => '2025-08-01',
                                            'total' => 1200,
                                            'status' => 'Paid',
                                        ],
                                        [
                                            'product' => 'Villa B',
                                            'date' => '2025-08-05',
                                            'total' => 3500,
                                            'status' => 'Pending',
                                        ],
                                        [
                                            'product' => 'Condo C',
                                            'date' => '2025-08-10',
                                            'total' => 2200,
                                            'status' => 'Paid',
                                        ],
                                        [
                                            'product' => 'House D',
                                            'date' => '2025-08-12',
                                            'total' => 1800,
                                            'status' => 'Canceled',
                                        ],
                                    ];
                                @endphp
    
                                <table class="w-full border-collapse border border-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Product</th>
                                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Date</th>
                                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Total Payment
                                            </th>
                                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Status</th>
                                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($transactions as $transaction)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $transaction['product'] }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ \Carbon\Carbon::parse($transaction['date'])->format('d M Y') }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    ${{ number_format($transaction['total'], 2) }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span
                                                        class="@if ($transaction['status'] == 'Paid') text-green-600 @elseif($transaction['status'] == 'Pending') text-yellow-600 @else text-red-600 @endif font-semibold">
                                                        {{ $transaction['status'] }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap flex gap-2">
                                                    <button
                                                        class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</button>
                                                    <button
                                                        class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Cancel</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
    
    
    
                            <!-- Dummy Pagination -->
                            <div class="mt-6 flex justify-end space-x-2 px-4 sm:px-6 lg:px-8">
                                <button class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">1</button>
                                <button class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">2</button>
                                <button class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">3</button>
                                <button class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">Next</button>
                            </div>
    
                        </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
