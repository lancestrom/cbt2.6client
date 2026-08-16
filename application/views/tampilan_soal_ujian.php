<?php $totalSoal = count($soal); ?>
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center bg-primary text-white rounded-top">
                    <h3 class="text-uppercase font-weight-bolder mb-1">Halo, <?= $siswa['nama_siswa'] ?></h3>
                    <p class="mb-1 small opacity-85"><?= $siswa['kelas'] ?> · <?= $siswa['nama_mapel'] ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container pb-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white border-0 px-4 py-3">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                        <div>
                            <h4 class="text-uppercase font-weight-bolder mb-1">Soal</h4>
                            <p class="text-muted mb-1 small">Sisa waktu</p>
                            <h5 class="text-uppercase font-weight-bolder mb-0"><span id="countdownTimer"><?= $siswa['selisih_menit'] ?>:00</span></h5>
                            <p class="text-muted mb-0" id="questionCounter">Soal 1 dari <?= $totalSoal ?></p>
                        </div>
                        <div class="d-flex flex-wrap gap-2 mt-3 mt-md-0" id="questionDots"></div>
                    </div>
                </div>
                <div class="card-body px-4 py-4">
                    <form method="post" action="<?= base_url('dashboard/kirim_jawaban') ?>" id="quizForm">
                        <?php foreach ($soal as $index => $s): ?>
                            <div class="question-slide <?= $index === 0 ? 'active' : '' ?>" data-index="<?= $index ?>">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="badge badge-secondary py-2 px-3">No. <?= $index + 1 ?></span>
                                    <span class="text-muted small">Pertanyaan <?= $index + 1 ?></span>
                                </div>
                                <?php if (!empty($s['gambar'])): ?>
                                    <div class="mb-4 text-center">
                                        <img src="<?= base_url('uploads/soal/' . $s['gambar']) ?>" class="img-fluid rounded shadow-sm" alt="Gambar soal">
                                    </div>
                                <?php endif; ?>

                                <input type="hidden" name="id_mapel[]" value="<?= $s['id_mapel'] ?>">
                                <input type="hidden" name="username[]" value="<?= $s['username'] ?>">
                                <input type="hidden" name="id_soal[]" value="<?= $s['id_soal'] ?>">

                                <h5 class="font-weight-bold mb-4" style="line-height:1.4;"><?= $s['soal'] ?></h5>
                                <div class="list-group list-group-flush">
                                    <?php foreach (['A' => 'pilA', 'B' => 'pilB', 'C' => 'pilC', 'D' => 'pilD', 'E' => 'pilE'] as $choice => $field): ?>
                                        <label class="list-group-item list-group-item-action d-flex align-items-start rounded mb-2 px-3 py-3 choice-card">
                                            <div class="form-check me-3 mt-1">
                                                <input class="form-check-input" type="radio" name="jawaban[<?= $s['id_soal'] ?>]" id="<?= $field . '-' . $s['id_soal'] ?>" value="<?= $choice ?>">
                                            </div>
                                            <div>
                                                <div class="text-primary font-weight-bold mb-1">Pilihan <?= $choice ?></div>
                                                <div class="small mb-0"><?= $s[$field] ?></div>
                                            </div>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <div class="d-flex justify-content-between align-items-center mt-4 gap-3 button-row">
                            <button type="button" class="btn btn-outline-primary flex-fill" id="prevBtn" disabled>Kembali</button>
                            <button type="button" class="btn btn-primary flex-fill" id="nextBtn">Selanjutnya</button>
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-success btn-lg w-100" id="submitBtn" disabled>Kirim Jawaban</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .question-slide {
        display: none;
    }

    .question-slide.active {
        display: block;
    }

    .choice-card {
        border: 1px solid #e9ecef;
        border-radius: 16px;
        transition: border-color .2s ease, background .2s ease, transform .2s ease;
        background: #ffffff;
        box-shadow: 0 4px 16px rgba(15, 23, 42, 0.04);
    }

    .choice-card:hover {
        border-color: #6c757d;
        background: #f8f9fa;
        transform: translateY(-2px);
    }

    .choice-card .form-check-input {
        transform: scale(1.2);
        margin-top: .2rem;
    }

    .choice-card .form-check-input:checked {
        border-color: #4e73df;
        background-color: #4e73df;
    }

    #questionDots {
        min-height: 2rem;
    }

    .question-dot {
        width: 14px;
        height: 14px;
        border-radius: 50%;
        border: 1px solid rgba(255, 255, 255, .65);
        background: rgba(255, 255, 255, .15);
        cursor: pointer;
        transition: background-color .2s ease, border-color .2s ease, transform .2s ease;
    }

    .question-dot.active {
        background-color: rgba(255, 255, 255, .95);
        border-color: rgba(255, 255, 255, .95);
        transform: scale(1.1);
    }

    .question-dot:hover {
        border-color: rgba(255, 255, 255, .95);
    }

    .card-header {
        background: linear-gradient(135deg, #4e73df 0%, #6f42c1 100%);
        color: #ffffff;
    }

    .card-header h4,
    .card-header p {
        color: #f8f9fa;
    }

    .badge-secondary {
        background: rgba(255, 255, 255, .16);
        color: #ffffff;
        backdrop-filter: blur(8px);
    }

    .button-row button {
        min-height: 50px;
    }

    .button-row .btn {
        border-radius: 999px;
        font-weight: 600;
    }

    .btn-primary {
        background: linear-gradient(135deg, #4e73df 0%, #5a2dd9 100%);
        border-color: transparent;
        box-shadow: 0 12px 24px rgba(78, 115, 223, 0.18);
    }

    .btn-primary:hover,
    .btn-primary:focus {
        background: linear-gradient(135deg, #3b66d4 0%, #451fb4 100%);
    }

    .btn-outline-primary {
        border-color: rgba(78, 115, 223, .35);
        color: #4e73df;
        background: rgba(78, 115, 223, .06);
    }

    .btn-outline-primary:hover {
        background: rgba(78, 115, 223, .12);
    }

    .btn-success {
        background: linear-gradient(135deg, #20c997 0%, #0ec07f 100%);
        border-color: transparent;
    }

    .btn-success:hover,
    .btn-success:focus {
        background: linear-gradient(135deg, #1fa97f 0%, #0ea46e 100%);
    }

    .card {
        border: none;
        overflow: hidden;
        border-radius: 24px;
    }

    .card.shadow-sm {
        box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
    }

    .card-body {
        background: #ffffff;
    }

    .bg-primary {
        background: linear-gradient(135deg, #4e73df 0%, #6f42c1 100%) !important;
    }

    @media (max-width: 767.98px) {
        .card-body {
            padding: 1.25rem;
        }

        .question-slide {
            padding-bottom: 0;
        }

        .choice-card {
            font-size: .95rem;
        }

        .card-header {
            border-radius: 0;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slides = Array.from(document.querySelectorAll('.question-slide'));
        const total = slides.length;
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const submitBtn = document.getElementById('submitBtn');
        const counter = document.getElementById('questionCounter');
        const dotsWrap = document.getElementById('questionDots');
        const countdownEl = document.getElementById('countdownTimer');
        const quizForm = document.getElementById('quizForm');
        const storageKey = 'tampilanSoalUjianState';
        const timerKey = 'tampilanSoalUjianTimer';
        let activeIndex = 0;

        const endTime = new Date("<?= $siswa['tanggal_mulai'] ?>T<?= $siswa['waktu_selesai'] ?>");
        const serverNow = new Date("<?= date('Y-m-d\TH:i:s') ?>");
        let currentTime = serverNow;
        let countdownInterval;
        let nextBtnCountdownInterval;
        let formSubmitted = false;

        function getSavedState() {
            const saved = localStorage.getItem(storageKey);
            if (!saved) {
                return null;
            }
            try {
                return JSON.parse(saved);
            } catch (error) {
                return null;
            }
        }

        function getSavedTimerState() {
            const saved = localStorage.getItem(timerKey);
            if (!saved) {
                return null;
            }
            try {
                return JSON.parse(saved);
            } catch (error) {
                return null;
            }
        }

        function saveTimerState(questionIndex, expiresAt) {
            const timerState = {
                questionIndex: questionIndex,
                expiresAt: expiresAt
            };
            localStorage.setItem(timerKey, JSON.stringify(timerState));
        }

        function clearTimerState() {
            localStorage.removeItem(timerKey);
        }

        function stopNextDelay() {
            if (nextBtnCountdownInterval) {
                clearInterval(nextBtnCountdownInterval);
                nextBtnCountdownInterval = null;
            }
        }

        function getRemainingTimerSeconds(expiresAt) {
            if (!expiresAt) {
                return 0;
            }
            const diffMs = new Date(expiresAt).getTime() - Date.now();
            return Math.max(0, Math.ceil(diffMs / 1000));
        }

        function saveState() {
            const answers = {};
            document.querySelectorAll('input[type="radio"][name^="jawaban"]').forEach(function(input) {
                if (input.checked) {
                    answers[input.name] = input.value;
                }
            });
            const state = {
                activeIndex: activeIndex,
                answers: answers,
                savedAt: new Date().toISOString()
            };
            localStorage.setItem(storageKey, JSON.stringify(state));
        }

        function restoreState() {
            const state = getSavedState();
            if (!state) {
                return;
            }

            if (typeof state.activeIndex === 'number' && state.activeIndex >= 0 && state.activeIndex < total) {
                activeIndex = state.activeIndex;
            }

            if (state.answers) {
                Object.entries(state.answers).forEach(function([name, value]) {
                    const input = document.querySelector('input[name="' + name + '"][value="' + value + '"]');
                    if (input) {
                        input.checked = true;
                    }
                });
            }
        }

        function restoreTimerState() {
            const timerState = getSavedTimerState();
            if (!timerState || !timerState.expiresAt) {
                return;
            }

            const remainingTime = getRemainingTimerSeconds(timerState.expiresAt);
            const questionIndex = Number(timerState.questionIndex || 0);

            if (remainingTime <= 0) {
                clearTimerState();
                if (questionIndex < total - 1) {
                    activeIndex = questionIndex + 1;
                }
                updateSlide();
                return;
            }

            nextBtn.disabled = true;
            nextBtn.textContent = 'Tunggu ' + remainingTime + 's';

            stopNextDelay();
            nextBtnCountdownInterval = setInterval(function() {
                const remaining = getRemainingTimerSeconds(timerState.expiresAt);
                nextBtn.textContent = 'Tunggu ' + remaining + 's';

                if (remaining <= 0) {
                    stopNextDelay();
                    clearTimerState();
                    if (questionIndex < total - 1) {
                        activeIndex = questionIndex + 1;
                    }
                    updateSlide();
                }
            }, 1000);
        }

        function clearState() {
            localStorage.removeItem(storageKey);
            clearTimerState();
        }

        quizForm.addEventListener('submit', function() {
            formSubmitted = true;
            clearState();
            stopNextDelay();
        });

        quizForm.addEventListener('change', function(event) {
            if (event.target.matches('input[type="radio"][name^="jawaban"]')) {
                saveState();
            }
        });

        function formatDuration(seconds) {
            const minutes = Math.floor(seconds / 60);
            const secs = seconds % 60;
            return minutes + ':' + secs.toString().padStart(2, '0');
        }

        function updateCountdown() {
            const diffSeconds = Math.max(0, Math.floor((endTime - currentTime) / 1000));
            countdownEl.textContent = formatDuration(diffSeconds);

            if (diffSeconds <= 0) {
                clearInterval(countdownInterval);
                if (!formSubmitted) {
                    quizForm.submit();
                }
            }
        }

        updateCountdown();
        countdownInterval = setInterval(function() {
            currentTime = new Date(currentTime.getTime() + 1000);
            updateCountdown();
        }, 1000);

        slides.forEach(function(slide, index) {
            const dot = document.createElement('span');
            dot.className = 'question-dot';
            dot.setAttribute('data-index', index);
            dot.addEventListener('click', function() {
                activeIndex = index;
                updateSlide();
            });
            dotsWrap.appendChild(dot);
        });

        restoreState();
        restoreTimerState();
        updateSlide();

        function updateSlide() {
            slides.forEach(function(slide, index) {
                slide.classList.toggle('active', index === activeIndex);
            });
            document.querySelectorAll('.question-dot').forEach(function(dot, index) {
                dot.classList.toggle('active', index === activeIndex);
            });
            counter.textContent = 'Soal ' + (activeIndex + 1) + ' dari ' + total;
            prevBtn.disabled = activeIndex === 0;
            nextBtn.disabled = activeIndex === total - 1;
            nextBtn.textContent = 'Selanjutnya';
            submitBtn.disabled = activeIndex !== total - 1;
            saveState();
        }

        prevBtn.addEventListener('click', function() {
            if (activeIndex > 0) {
                stopNextDelay();
                clearTimerState();
                activeIndex -= 1;
                updateSlide();
            }
        });

        nextBtn.addEventListener('click', function() {
            if (activeIndex < total - 1) {
                stopNextDelay();
                nextBtn.disabled = true;
                const expiresAt = new Date(Date.now() + 60000).toISOString();

                saveTimerState(activeIndex, expiresAt);

                const doCountdownTick = function() {
                    const remainingTime = getRemainingTimerSeconds(expiresAt);
                    nextBtn.textContent = 'Tunggu ' + remainingTime + 's';

                    if (remainingTime <= 0) {
                        stopNextDelay();
                        clearTimerState();
                        activeIndex += 1;
                        updateSlide();
                    }
                };

                doCountdownTick();
                nextBtnCountdownInterval = setInterval(doCountdownTick, 1000);
            }
        });
    });
</script>