<x-app-layout>
    <section class="my-12 py-20 bg-gray-100 bg-opacity-50 min-h-screen">
        <div class="mx-auto container max-w-2xl md:w-3/4 shadow-md rounded-md">
            <div class="bg-gray-900 p-4 rounded-t text-white">
                <h1 class="text-lg font-semibold">Booking Form</h1>
            </div>

            <div class="bg-white space-y-6 p-6">
                <!-- User Info -->
                <div>
                    <h2 class="text-gray-600 font-semibold mb-4">Data Pemesan</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm text-gray-400">Full Name</label>
                            <input type="text"
                                class="w-full border p-2 rounded-md focus:outline-none focus:border-indigo-400"
                                placeholder="Masukkan nama lengkap" value="Charly Olivas" />
                        </div>
                        <div>
                            <label class="text-sm text-gray-400">Email</label>
                            <input type="email"
                                class="w-full border p-2 rounded-md focus:outline-none focus:border-indigo-400"
                                placeholder="email@example.com" value="charly@example.com" />
                        </div>
                        <div>
                            <label class="text-sm text-gray-400">Nomor HP</label>
                            <input type="text"
                                class="w-full border p-2 rounded-md focus:outline-none focus:border-indigo-400"
                                placeholder="08xxxxxxxxxx" value="08123456789" />
                        </div>
                    </div>
                </div>

                <hr />

                <!-- Date Picker -->
                <div>
                    <h2 class="text-gray-600 font-semibold mb-4">Tanggal Booking</h2>
                    <input type="date"
                        class="w-full border p-2 rounded-md focus:outline-none focus:border-indigo-400" />
                </div>
                <div>
                    <h2 class="text-gray-600 font-semibold mb-4">Tanggal Booking</h2>
                    <input type="date"
                        class="w-full border p-2 rounded-md focus:outline-none focus:border-indigo-400" />
                </div>

                <hr />

                <!-- Room Preview -->
                <div>
                    <h2 class="text-gray-600 font-semibold mb-4">Preview Ruangan</h2>
                    <div class="p-4 border rounded-md bg-gray-50">
                        <h3 class="text-lg font-semibold text-blue-600">Ruang Meeting Premium</h3>
                        <p class="text-sm text-gray-600 mt-2">
                            Ruang meeting eksklusif dengan kapasitas 10 orang, dilengkapi proyektor dan AC.
                        </p>
                        <p class="mt-2 font-bold text-gray-700">Harga: Rp 1.000.000 / hari</p>
                    </div>
                </div>

                <hr />

                <!-- Payment Method -->
                <div>
                    <h2 class="text-gray-600 font-semibold mb-4">Metode Pembayaran</h2>
                    <div class="space-y-2">
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="radio" name="payment" value="dp" class="text-blue-400" />
                            <span>DP (50%)</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="radio" name="payment" value="full" class="text-blue-400" checked />
                            <span>Full Payment</span>
                        </label>
                    </div>
                </div>

                <hr />

                <!-- Payment Details -->
                <div>
                    <h2 class="text-gray-600 font-semibold mb-4">Rincian Pembayaran</h2>
                    <div class="space-y-2 text-gray-600">
                        <div class="flex justify-between">
                            <span>Harga</span>
                            <span>Rp 1.000.000</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Tax (10%)</span>
                            <span>Rp 100.000</span>
                        </div>
                        <div class="flex justify-between font-bold text-lg border-t pt-2">
                            <span>Total</span>
                            <span>Rp 1.100.000</span>
                        </div>
                    </div>
                </div>

                <hr />

                <!-- Terms & Conditions -->
                <div class="bg-gray-50 p-4 rounded-md border">
                    <h2 class="text-gray-600 font-semibold mb-2">Syarat & Ketentuan</h2>
                    <ul class="list-disc list-inside text-sm text-gray-600 space-y-1">
                        <li>Pembayaran DP tidak dapat dikembalikan.</li>
                        <li>Reschedule dapat dilakukan maksimal H-3 sebelum tanggal booking.</li>
                        <li>Harga belum termasuk biaya tambahan jika ada permintaan khusus.</li>
                    </ul>
                </div>

                <!-- Submit Button -->
                <div class="text-right">
                    <button class="w-full bg-blue-600 text-white my-4 py-2 px-4 rounded-lg hover:bg-blue-700">
                        Bayar
                    </button>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
