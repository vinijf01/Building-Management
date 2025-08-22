<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Booking Payment</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <style>
    :root { --border:#e5e7eb; --muted:#6b7280; --accent:#2563eb; --ok:#10b981; --ink:#111827; }
    html, body { height: 100%; }
    body { font-family: system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, Cantarell, Arial; line-height:1.5; color:#111827; margin:0; background:#fafafa; }
    .wrap { max-width: 880px; margin: 24px auto; background:#fff; border:1px solid var(--border); border-radius:14px; overflow:hidden; box-shadow:0 8px 24px rgba(0,0,0,.06); }
    header { padding:16px 20px; border-bottom:1px solid var(--border); display:flex; justify-content:space-between; align-items:center; flex-wrap: wrap; gap:8px; }
    h1 { font-size:18px; margin:0; }
    main { padding:20px; }
    .alert { padding:10px 12px; border-radius:10px; margin-bottom:12px; }
    .success { background:#ecfdf5; border:1px solid #34d399; color:#065f46; }
    .error { background:#fef2f2; border:1px solid #fecaca; color:#991b1b; }
    .grid { display:grid; gap:14px; grid-template-columns: 1fr 1fr; }
    @media (max-width: 820px) { .grid { grid-template-columns: 1fr; } }
    .card { border:1px solid var(--border); border-radius:12px; padding:14px; background:#fff; }
    .muted { color:var(--muted); }
    .btn { background: var(--ink); color:#fff; border:none; padding:10px 14px; border-radius:10px; cursor:pointer; font-weight:600; }
    .btn.secondary { background:#f3f4f6; color:#111827; border:1px solid var(--border); }
    .btn.ok { background: var(--ok); }
    .btn:disabled { opacity:.6; cursor:not-allowed; }
    .img { max-width: 100%; border:1px solid var(--border); border-radius:12px; }
    .row { display:flex; gap:8px; align-items:center; flex-wrap: wrap; justify-content:space-between; }
    .kv { display:grid; grid-template-columns: 160px 1fr; gap:6px 12px; }
    .kv strong { font-weight:600; }
    .pill { display:inline-block; padding:2px 8px; border-radius:999px; font-size:12px; border:1px solid var(--border); color:#374151; background:#f9fafb; }

    /* Modal */
    .modal-backdrop { display:none; position:fixed; inset:0; background:rgba(0,0,0,.45); z-index:50; }
    .modal {
      max-width:520px; width:92vw; margin:6vh auto; background:#fff;
      border-radius:14px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,.25);
      max-height:88vh; display:flex; flex-direction:column;
    }
    .modal header { border-bottom:1px solid var(--border); padding:14px 16px; display:flex; justify-content:space-between; align-items:center; gap:8px; }
    .modal .body { padding:16px; overflow:auto; }
    .modal .footer { padding:12px 16px; border-top:1px solid var(--border); display:flex; gap:8px; justify-content:flex-end; background:#fff; }

    /* Preview responsiveness */
    #previewImg { width:100%; height:auto; max-height:50vh; object-fit:contain; border:1px solid var(--border); border-radius:8px; }

    /* Improve touch targets on mobile */
    .btn { touch-action: manipulation; }

    /* Small button variant for copy buttons */
    .btn.sm { padding:6px 10px; border-radius:8px; font-size:12px; font-weight:600; }
  </style>
</head>
<body>
  <div class="wrap">
    <header>
      <h1>Booking Payment</h1>
      <span class="pill">#{{ $booking->id }}</span>
    </header>

    <main>
      {{-- Flash & errors --}}
      @if (session('success'))
        <div class="alert success">{{ session('success') }}</div>
      @endif
      @if ($errors->any())
        <div class="alert error">
          <ul style="margin:0 0 0 18px;">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <!-- ========== NEW: Payment Info (two columns) ========== -->
      <section class="card" style="margin-bottom:14px;">
        <h2 style="margin:0 0 10px 0;">Payment Info</h2>
        <div class="grid">
          <!-- Left column -->
          <div>
            <div class="card" style="padding:10px; margin:0 0 10px 0;">
              <div class="row">
                <div>
                  <div class="muted" style="font-size:12px;">Account Number</div>
                  <div id="acctNumber" style="font-size:20px; font-weight:700; letter-spacing:.3px;">872450823745</div>
                </div>
                <button type="button" class="btn secondary sm" data-copy="#acctNumber">Copy</button>
              </div>
            </div>
            <div class="card" style="padding:10px;">
              <div class="muted" style="font-size:12px;">Bank</div>
              <div style="font-weight:700;">BCA</div>
            </div>
          </div>

          <!-- Right column -->
          <div>
            <div class="card" style="padding:10px; margin:0 0 10px 0;">
              <div class="muted" style="font-size:12px;">Account Name</div>
              <div style="font-weight:700;">Mr. diy</div>
            </div>
            <div class="card" style="padding:10px;">
              <div class="row">
                <div>
                  <div class="muted" style="font-size:12px;">Price to pay</div>
                  <div id="amountToPay" style="font-size:20px; font-weight:700;">Rp. 2.000.000</div>
                </div>
                <button type="button" class="btn secondary sm" data-copy="#amountToPay">Copy</button>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- ========== /Payment Info ========== -->

      <div class="grid">
        {{-- Summary --}}
        <section class="card">
          <h2 style="margin:0 0 8px 0;">Booking Summary</h2>
          <div class="kv">
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

        {{-- Proof upload / view --}}
        <section class="card">
          <h2 style="margin:0 0 8px 0;">Payment Proof</h2>

          @if($payment->proof_image)
            <p class="muted" style="margin:0 0 8px 0;">Your uploaded proof:</p>
            <img class="img" src="{{ asset('storage/'.$payment->proof_image) }}" alt="Payment proof">
            {{-- Button hidden because proof exists --}}
          @else
            <p class="muted" style="margin:0 0 12px 0;">Upload a clear photo/screenshot of your bank transfer receipt. Accepted: JPG, PNG, WEBP (max 5MB).</p>
            <button id="openProofModal" type="button" class="btn">Verify bank transfer proof</button>
          @endif
        </section>
      </div>
    </main>
  </div>

  {{-- Modal (only used if no proof yet) --}}
  <div id="proofModal" class="modal-backdrop" aria-hidden="true">
    <div class="modal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
      <header>
        <h3 id="modalTitle" style="margin:0;">Upload Payment Proof</h3>
        <button id="closeProofModal" type="button" class="btn secondary" style="padding:6px 10px; border-radius:8px;">Close</button>
      </header>

      <form id="proofForm" action="{{ route('booking.payment.proof', $booking) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="body">
          <input id="proofInput" type="file" name="proof_image" accept="image/*" hidden>

          <div class="row">
            <button id="browseBtn" type="button" class="btn" style="background:var(--accent);">Browse image…</button>
            <span id="fileName" class="muted"></span>
          </div>

          <div id="previewWrap" style="display:none; margin-top:12px;">
            <p class="muted" style="margin:0 0 6px;">Preview:</p>
            <img id="previewImg" src="" alt="Preview">
          </div>
        </div>

        <div class="footer">
          <button type="button" id="cancelBtn" class="btn secondary">Cancel</button>
          <button id="sendProofBtn" type="submit" class="btn ok" disabled>Send proof</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    // Copy-to-clipboard for Payment Info
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

    // Only wire up modal if upload button exists (i.e., no proof yet)
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
        modal.style.display='block';
        modal.setAttribute('aria-hidden','false');
        document.body.style.overflow = 'hidden';
      }
      function closeModal(){
        modal.style.display='none';
        modal.setAttribute('aria-hidden','true');
        document.body.style.overflow = '';

        if (input) input.value='';
        if (preview) preview.style.display='none';
        if (sendBtn) sendBtn.disabled = true;
        if (fileName) fileName.textContent = '';
      }

      openBtn.addEventListener('click', openModal);
      closeBtn.addEventListener('click', closeModal);
      cancelBtn.addEventListener('click', closeModal);

      browseBtn.addEventListener('click', () => input.click());

      input.addEventListener('change', () => {
        if (!input.files || !input.files[0]) {
          preview.style.display = 'none';
          sendBtn.disabled = true;
          fileName.textContent = '';
          return;
        }
        const file = input.files[0];
        fileName.textContent = `${file.name} (${Math.round(file.size/1024)} KB)`;

        const reader = new FileReader();
        reader.onload = e => {
          previewImg.src = e.target.result;
          preview.style.display = 'block';
          sendBtn.disabled = false;
        };
        reader.readAsDataURL(file);
      });

      // Close when clicking backdrop
      modal.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });

      // ESC to close
      window.addEventListener('keydown', (e) => { if (e.key === 'Escape' && modal.getAttribute('aria-hidden') === 'false') closeModal(); });
    }
  </script>
</body>
</html>
