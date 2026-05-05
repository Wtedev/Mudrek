import { Html5Qrcode } from 'html5-qrcode';

const root = document.getElementById('attendance-scan-app');
if (!root) {
    throw new Error('attendance-scan-app root missing');
}

const checkUrl = root.dataset.checkUrl;
const csrf = root.dataset.csrf ?? '';

const startBtn = root.querySelector('[data-action="start"]');
const stopBtn = root.querySelector('[data-action="stop"]');
const resetBtn = root.querySelector('[data-action="reset"]');
const manualInput = root.querySelector('[data-manual-input]');
const manualSubmit = root.querySelector('[data-action="manual-check"]');
const readerEl = root.querySelector('[data-reader]');
const resultCard = root.querySelector('[data-result-card]');
const resultTitle = root.querySelector('[data-result-title]');
const resultBody = root.querySelector('[data-result-body]');
const resultParticipant = root.querySelector('[data-result-participant]');

if (!startBtn || !stopBtn || !resetBtn || !manualInput || !manualSubmit || !readerEl || !resultCard || !resultTitle || !resultBody || !resultParticipant) {
    throw new Error('attendance-scan DOM incomplete');
}

const readerId = `attendance-scan-reader-${Math.random().toString(36).slice(2, 9)}`;
readerEl.id = readerId;

/** @type {Html5Qrcode | null} */
let html5Qr = null;
let scanning = false;
let processing = false;
let awaitingReset = false;

function syncControls() {
    startBtn.disabled = processing || awaitingReset || scanning;
    stopBtn.disabled = !scanning || processing;
    manualSubmit.disabled = processing;
    manualInput.disabled = processing;
    resetBtn.disabled = !awaitingReset;
}

function clearResultUi() {
    resultCard.classList.add('hidden');
    resultCard.classList.remove('border-emerald-500/40', 'bg-emerald-950/50', 'border-amber-500/40', 'bg-amber-950/50', 'border-red-500/40', 'bg-red-950/50');
    resultTitle.textContent = '';
    resultBody.textContent = '';
    resultParticipant.classList.add('hidden');
    resultParticipant.innerHTML = '';
}

function showResult(status, message, participant) {
    resultCard.classList.remove('hidden');
    resultCard.classList.remove('border-emerald-500/40', 'bg-emerald-950/50', 'border-amber-500/40', 'bg-amber-950/50', 'border-red-500/40', 'bg-red-950/50');

    if (status === 'success') {
        resultCard.classList.add('border-emerald-500/40', 'bg-emerald-950/50');
    } else if (status === 'warning') {
        resultCard.classList.add('border-amber-500/40', 'bg-amber-950/50');
    } else {
        resultCard.classList.add('border-red-500/40', 'bg-red-950/50');
    }

    resultTitle.textContent = message;
    resultBody.textContent = '';

    if (participant && typeof participant === 'object') {
        resultParticipant.classList.remove('hidden');
        const name = /** @type {{ full_name?: string }} */ (participant).full_name ?? '';
        const mobile = /** @type {{ mobile?: string }} */ (participant).mobile ?? '';
        const at = /** @type {{ checked_in_at?: string }} */ (participant).checked_in_at ?? '';
        resultParticipant.innerHTML = `
            <div class="mt-3 space-y-1 border-t border-white/10 pt-3 text-sm text-zinc-200">
                <div><span class="font-semibold text-white">الاسم:</span> ${escapeHtml(name)}</div>
                <div><span class="font-semibold text-white">الجوال:</span> <span dir="ltr" class="font-mono">${escapeHtml(mobile)}</span></div>
                ${at ? `<div><span class="font-semibold text-white">وقت التحضير:</span> <span class="tabular-nums">${escapeHtml(at)}</span></div>` : ''}
            </div>`;
    } else {
        resultParticipant.classList.add('hidden');
        resultParticipant.innerHTML = '';
    }
}

/**
 * @param {string} s
 */
function escapeHtml(s) {
    const d = document.createElement('div');
    d.textContent = s;

    return d.innerHTML;
}

async function stopCamera() {
    if (html5Qr && scanning) {
        try {
            await html5Qr.stop();
        } catch {
            //
        }
        scanning = false;
    }
    syncControls();
}

/**
 * @param {string} rawToken
 */
async function submitToken(rawToken) {
    const token = rawToken.trim();
    if (!token) {
        showResult('error', 'الرجاء إدخال رمز أو مسح QR.', null);
        syncControls();

        return;
    }

    processing = true;
    syncControls();

    try {
        const res = await fetch(checkUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                Accept: 'application/json',
                'X-CSRF-TOKEN': csrf,
                'X-Requested-With': 'XMLHttpRequest',
            },
            credentials: 'same-origin',
            body: JSON.stringify({ token }),
        });

        const data = await res.json().catch(() => ({}));
        const status = typeof data?.status === 'string' ? data.status : 'error';
        const message = typeof data?.message === 'string' ? data.message : 'حدث خطأ';

        showResult(status, message, data?.participant ?? null);

        if (status === 'success' || status === 'warning') {
            awaitingReset = true;
        }
    } catch {
        showResult('error', 'تعذّر الاتصال بالخادم.', null);
    } finally {
        processing = false;
        syncControls();
    }
}

startBtn.addEventListener('click', async () => {
    if (processing || awaitingReset) {
        return;
    }

    clearResultUi();

    try {
        if (!html5Qr) {
            html5Qr = new Html5Qrcode(readerId);
        }

        await html5Qr.start(
            { facingMode: 'environment' },
            { fps: 8, qrbox: { width: 280, height: 280 } },
            async (decodedText) => {
                if (!decodedText?.trim() || processing || awaitingReset) {
                    return;
                }
                try {
                    await html5Qr.pause(true);
                } catch {
                    //
                }
                await stopCamera();
                await submitToken(decodedText);
            },
            () => {},
        );
        scanning = true;
        syncControls();
    } catch (e) {
        showResult('error', e instanceof Error ? e.message : 'تعذّر فتح الكاميرا.', null);
        scanning = false;
        syncControls();
    }
});

stopBtn.addEventListener('click', async () => {
    await stopCamera();
});

manualSubmit.addEventListener('click', async () => {
    clearResultUi();
    await submitToken(manualInput.value);
});

manualInput.addEventListener('keydown', (ev) => {
    if (ev.key === 'Enter') {
        ev.preventDefault();
        manualSubmit.click();
    }
});

resetBtn.addEventListener('click', async () => {
    await stopCamera();
    clearResultUi();
    manualInput.value = '';
    awaitingReset = false;
    syncControls();
});

syncControls();
