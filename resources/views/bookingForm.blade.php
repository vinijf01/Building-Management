<!DOCTYPE html>
<html lang="en">
<head>
  <title>Booking Form</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  {{-- Flatpickr CSS --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <style>
    :root { --border:#e5e7eb; --muted:#6b7280; --accent:#2563eb; --ink:#111827; --ok:#10b981; }
    html, body { height:100%; }
    body { font-family: system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, Cantarell, Arial; line-height:1.5; color:#111827; margin:0; background:#fafafa; }

    .wrap { max-width: 960px; margin: 24px auto; background:#fff; border:1px solid var(--border); border-radius:14px; overflow:hidden; box-shadow:0 8px 24px rgba(0,0,0,.06); }
    header { padding:16px 20px; border-bottom:1px solid var(--border); display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:8px; }
    h1 { font-size:18px; margin:0; }
    .pill { display:inline-block; padding:2px 8px; border-radius:999px; font-size:12px; border:1px solid var(--border); color:#374151; background:#f9fafb; }

    main { padding:20px; }
    .grid {
        display: grid;
        gap: 14px;
        grid-template-columns: 0.8fr 1.2fr; /* or 30% vs 70% */
    }
    @media (max-width: 840px) { .grid { grid-template-columns: 1fr; } }

    .card { border:1px solid var(--border); border-radius:12px; padding:14px; background:#fff; }
    .muted { color:var(--muted); }

    .field { margin: 10px 0 14px; }
    label { font-weight: 600; display: block; margin-bottom: 6px; }
    .input, .btn { width: 100%; max-width: 100%; box-sizing: border-box; }
    .input {
      padding: 10px 12px; border: 1px solid var(--border);
      border-radius: 10px; outline: none; font-size: 14px; background: #fff;
      transition: border-color .15s, box-shadow .15s;
    }
    .input:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(37,99,235,.12); }
    .readonly { background: #f9fafb; }
    .days-info { font-style: italic; color: #374151; margin-top: 4px; }

    .btn { background: var(--ink); color:#fff; border:none; padding:10px 14px; border-radius:10px; cursor:pointer; font-weight:600; }
    .btn.ok { background: var(--ok); }
    .btn:disabled { opacity:.6; cursor:not-allowed; }

    .card form { display:flex; flex-direction:column; gap: 12px; }
    .actions { display:flex; justify-content:flex-end; }
    .actions .btn { width:auto; min-width: 160px; }
    @media (max-width: 480px) { .actions { justify-content:stretch; } .actions .btn { width:100%; } }

    .media { display:flex; gap:14px; align-items:flex-start; }
    .media img { max-width:180px; border-radius:12px; border:1px solid var(--border); height:auto; }
    @media (max-width: 600px) { .media { flex-direction: column; } .media img { width:100%; max-width:100%; } }
  </style>
</head>
<body>
  <div class="wrap">
    <header>
      <h1>Booking Form</h1>
      <span class="pill">{{ $product->category }}</span>
    </header>

    <main>
      @if ($errors->any())
        <div style="padding:10px;background:#fef2f2;border:1px solid #fecaca;color:#991b1b;border-radius:10px;margin-bottom:12px;">
          <ul style="margin:0 0 0 18px;">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="grid">
        {{-- LEFT: Product Summary --}}
        <section class="card">
          <h2 style="margin:0 0 8px 0;">{{ $product->name }}</h2>
          <div class="media">
            @if($product->cover_image)
              <img src="{{ asset('storage/' . $product->cover_image) }}" alt="{{ $product->name }}">
            @endif
            <div>
              <p style="margin:0 0 8px 0;"><strong>Price (per day):</strong> Rp {{ number_format($product->price, 0, ',', '.') }}</p>
              <p class="muted" style="margin:0;">{{ $product->description }}</p>
            </div>
          </div>
        </section>

        {{-- RIGHT: Form --}}
        <section class="card">
          <h2 style="margin:0 0 8px 0;">Your Booking</h2>

          <form action="{{ route('booking.save', $product->slug) }}" method="POST" id="bookingForm">
            @csrf

            <div class="field">
              <label for="name">Your Name</label>
              <input class="input readonly" type="text" name="name" id="name" value="{{ Auth::user()->name }}" readonly>
            </div>

            {{-- Single input date RANGE via Flatpickr --}}
            <div class="field">
              <label for="date_range">Date Range</label>
              <input class="input readonly" type="text" id="date_range" placeholder="Pick start → end" readonly>
              <div class="muted">Pick a start date, then an end date (no past dates / no overlaps).</div>

              {{-- hidden fields for submission --}}
              <input type="date" name="start_date" id="start_date" hidden required>
              <input type="date" name="end_date" id="end_date" hidden required>
              <input type="hidden" name="days" id="days">

              <p class="days-info" id="days_info"></p>

            <div class="field">
              <label for="total_price">Total Price</label>
              <input class="input readonly" type="text" id="total_price" disabled>
              <input type="hidden" name="calculated_total" id="calculated_total">
            </div>

            <div class="actions">
              <button class="btn ok" type="submit">Confirm Booking</button>
            </div>
          </form>
        </section>
      </div>
    </main>
  </div>

  {{-- Flatpickr JS --}}
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script>
    const pricePerDay = @json((float) $product->price);
    const blocked     = @json($blockedRanges ?? []); // [{start:'YYYY-MM-DD', end:'YYYY-MM-DD'}]
    const startHidden = document.getElementById('start_date');
    const endHidden   = document.getElementById('end_date');
    const daysInfo    = document.getElementById('days_info');
    const totalDisp   = document.getElementById('total_price');
    const daysHidden  = document.getElementById('days');
    const totalHidden = document.getElementById('calculated_total');

    // Build disabled date ranges for Flatpickr
    const disabledRanges = blocked.map(r => ({ from: r.start, to: r.end }));

    // Helpers
    const MS_PER_DAY = 24 * 60 * 60 * 1000;
    const pad2 = n => String(n).padStart(2,'0');
    const ymd  = d => `${d.getFullYear()}-${pad2(d.getMonth()+1)}-${pad2(d.getDate())}`;

    function nightsBetween(a, b) {
      const diff = Math.round((b - a) / MS_PER_DAY);
      return Math.max(1, diff); // enforce at least 1 night
    }
    function updateUIFromDates(startDate, endDate) {
      if (!startDate || !endDate) {
        startHidden.value = '';
        endHidden.value   = '';
        daysInfo.textContent = '';
        totalDisp.value = '';
        daysHidden.value = '';
        totalHidden.value = '';
        return;
      }
      const n = nightsBetween(startDate, endDate);
      const total = n * pricePerDay;

      startHidden.value = ymd(startDate);
      endHidden.value   = ymd(endDate);
      daysInfo.textContent = `${n} day${n>1?'s':''} selected`;
      totalDisp.value = 'Rp ' + Number(total).toLocaleString('id-ID');
      daysHidden.value = n;
      totalHidden.value = Math.round(total);
    }

    // Init flatpickr range
    const fp = flatpickr('#date_range', {
      mode: 'range',
      dateFormat: 'Y-m-d',     // backend friendly
      altInput: true,
      altFormat: 'd M Y',      // pretty display like your screenshot
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
          const end   = new Date(start.getTime() + MS_PER_DAY);
          this.setDate([start, end], true);
          updateUIFromDates(start, end);
        }
      }
    });

    // If you want to prefill dates from old input (validation back), set fp.setDate([...]) here.
  </script>
</body>
</html>