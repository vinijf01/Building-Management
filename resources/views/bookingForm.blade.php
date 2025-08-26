{{-- resources/views/booking.blade.php --}}
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- header --}}
                    <header class="mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">Booking Form</h1>
                        <span
                            class="inline-block mt-2 px-3 py-1 text-sm font-medium rounded-full bg-blue-100 text-blue-600">
                            {{ $product->category }}
                        </span>
                    </header>

                    {{-- error message --}}
                    @if ($errors->any())
                        <div class="mb-4 p-3 bg-red-100 border border-red-200 text-red-700 rounded-lg">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- grid: product + form --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- product summary --}}
                        <section class="p-4 border rounded-xl shadow-sm">
                            <h2 class="text-lg font-semibold mb-3 text-gray-800">{{ $product->name }}</h2>
                            <div class="flex gap-4">
                                @if ($product->cover_image)
                                    <img src="{{ asset('storage/' . $product->cover_image) }}"
                                        alt="{{ $product->name }}" class="w-32 h-32 object-cover rounded-lg shadow">
                                @endif
                                <div>
                                    <p class="text-sm"><strong>Price (per day):</strong> Rp
                                        {{ number_format($product->price, 0, ',', '.') }}</p>
                                    <p class="text-sm text-gray-600 mt-1">{{ $product->description }}</p>
                                </div>
                            </div>
                            <!-- Terms & Conditions -->
                            <div class="bg-gray-50 my-4 p-4 rounded-md border">
                                <h2 class="text-gray-600 font-semibold mb-2">Syarat & Ketentuan</h2>
                                <ul class="list-disc list-inside text-sm text-gray-600 space-y-1">
                                    <li>Pembayaran DP tidak dapat dikembalikan.</li>
                                    <li>Reschedule dapat dilakukan maksimal H-3 sebelum tanggal booking.</li>
                                    <li>Harga belum termasuk biaya tambahan jika ada permintaan khusus.</li>
                                </ul>
                            </div>
                        </section>

                        {{-- booking form --}}
                        <section class="p-4 border rounded-xl shadow-sm">
                            <h2 class="text-lg font-semibold mb-3 text-gray-800">Your Booking</h2>
                            <form action="{{ route('booking.save', $product->slug) }}" method="POST" id="bookingForm"
                                class="space-y-4">
                                @csrf

                                {{-- name --}}
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Your
                                        Name</label>
                                    <input type="text" id="name" name="name" value="{{ Auth::user()->name }}"
                                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm bg-gray-100 cursor-not-allowed"
                                        readonly>
                                </div>

                                {{-- date range --}}
                                <div>
                                    <label for="date_range" class="block text-sm font-medium text-gray-700">Date
                                        Range</label>
                                    <input type="text" id="date_range" placeholder="Pick start → end"
                                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm bg-gray-100 cursor-pointer"
                                        readonly>
                                    <p class="mt-1 text-xs text-gray-500">Pick a start date, then an end date (no past
                                        dates / no overlaps).</p>

                                    <input type="date" name="start_date" id="start_date" hidden required>
                                    <input type="date" name="end_date" id="end_date" hidden required>
                                    <input type="hidden" name="days" id="days">
                                    <p id="days_info" class="mt-1 text-sm text-blue-600 font-medium"></p>
                                </div>

                                {{-- total price --}}
                                <div>
                                    <label for="total_price" class="block text-sm font-medium text-gray-700">Total
                                        Price</label>
                                    <input type="text" id="total_price"
                                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm bg-gray-100"
                                        disabled>
                                    <input type="hidden" name="calculated_total" id="calculated_total">
                                </div>

                                <div class="pt-2">
                                    <button type="submit"
                                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition duration-200">
                                        Confirm Booking
                                    </button>
                                </div>
                            </form>
                        </section>
                    </div>

                </div>
            </div>
        </div>
    </div>


    {{-- Flatpickr assets --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        const pricePerDay = @json((float) $product->price);
        const blocked = @json($blockedRanges ?? []); // [{start:'YYYY-MM-DD', end:'YYYY-MM-DD'}]
        const startHidden = document.getElementById('start_date');
        const endHidden = document.getElementById('end_date');
        const daysInfo = document.getElementById('days_info');
        const totalDisp = document.getElementById('total_price');
        const daysHidden = document.getElementById('days');
        const totalHidden = document.getElementById('calculated_total');

        // Build disabled date ranges for Flatpickr
        const disabledRanges = blocked.map(r => ({
            from: r.start,
            to: r.end
        }));

        // Helpers
        const MS_PER_DAY = 24 * 60 * 60 * 1000;
        const pad2 = n => String(n).padStart(2, '0');
        const ymd = d => `${d.getFullYear()}-${pad2(d.getMonth()+1)}-${pad2(d.getDate())}`;

        function nightsBetween(a, b) {
            const diff = Math.round((b - a) / MS_PER_DAY);
            return Math.max(1, diff); // enforce at least 1 night
        }

        function updateUIFromDates(startDate, endDate) {
            if (!startDate || !endDate) {
                startHidden.value = '';
                endHidden.value = '';
                daysInfo.textContent = '';
                totalDisp.value = '';
                daysHidden.value = '';
                totalHidden.value = '';
                return;
            }
            const n = nightsBetween(startDate, endDate);
            const total = n * pricePerDay;

            startHidden.value = ymd(startDate);
            endHidden.value = ymd(endDate);
            daysInfo.textContent = `${n} day${n>1?'s':''} selected`;
            totalDisp.value = 'Rp ' + Number(total).toLocaleString('id-ID');
            daysHidden.value = n;
            totalHidden.value = Math.round(total);
        }

        // Init flatpickr range
        const fp = flatpickr('#date_range', {
            mode: 'range',
            dateFormat: 'Y-m-d', // backend friendly
            altInput: true,
            altFormat: 'd M Y', // pretty display like your screenshot
            minDate: 'today',
            disable: disabledRanges, // blocks booked days/ranges
            // When user picks dates
            onChange: function(selectedDates) {
                if (selectedDates.length === 1) {
                    // User clicked a start date; do nothing yet
                    updateUIFromDates(null, null);
                }
                if (selectedDates.length === 2) {
                    let [start, end] = selectedDates;

                    // If same day was chosen, auto-extend to next day (checkout)
                    if (ymd(start) === ymd(end)) {
                        const next = new Date(start.getTime() + MS_PER_DAY);
                        // Respect disabled ranges: if next is disabled, keep as is and UI will still show 1 night
                        end = next;
                        // Update the picker visibly to show the 2-day range
                        this.setDate([start, end], true);
                    }

                    updateUIFromDates(start, end);
                }
            },
            // When calendar closes and only one date picked, auto-set end = +1 day
            onClose: function(selectedDates) {
                if (selectedDates.length === 1) {
                    const start = selectedDates[0];
                    const end = new Date(start.getTime() + MS_PER_DAY);
                    this.setDate([start, end], true);
                    updateUIFromDates(start, end);
                }
            }
        });
    </script>
</x-app-layout>
