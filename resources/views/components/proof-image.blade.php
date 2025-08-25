@if ($getRecord() && $getRecord()->payment?->proof_image)
    <img src="{{ asset('storage/' . $getRecord()->payment->proof_image) }}" alt="Proof Image">
@else
    <p class="text-gray-500 italic">No proof image uploaded.</p>
@endif
