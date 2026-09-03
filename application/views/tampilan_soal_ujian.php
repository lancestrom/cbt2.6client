<?php
$totalSoal = count($soal);
$waktuMulai = new DateTime($siswa['waktu_mulai']);
$waktuSelesai = new DateTime($siswa['waktu_selesai']);

if ($waktuSelesai < $waktuMulai) {
    $waktuSelesai->modify('+1 day');
}

$selisihWaktu = $waktuMulai->diff($waktuSelesai)->format('%H:%I:%S');
?>
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
                            <h4 class="text-uppercase font-weight-bolder mb-1">Waktu</h4>
                            <h5 class="text-uppercase font-weight-bolder mb-0" id="countdownTimer"><?= $siswa['selisih_menit'] ?>:00</h5>
                            <p class="text-white mb-0" id="questionCounter">Soal 1 dari <?= $totalSoal ?></p>
                        </div>
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
                                        <img src="<?= base_url('assets/images/gambar/' . $s['gambar']) ?>" class="img-fluid rounded shadow-sm" alt="Gambar soal">
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

    .question-slide img {
        max-width: 100%;
        height: auto;
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

        .question-slide img {
            max-width: 70%;
        }

        .card-header {
            border-radius: 0;
        }
    }

    #countdownTimer {
        font-size: 1.5rem;
        font-weight: 700;
        transition: color 0.3s ease;
    }

    #countdownTimer.warning {
        color: #ff6b6b;
        animation: pulse 1s infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.7;
        }
    }
</style>

<script>
    (function() {
        var countdownTimer = document.getElementById('countdownTimer');
        var quizForm = document.getElementById('quizForm');
        var slides = Array.prototype.slice.call(document.querySelectorAll('.question-slide'));
        var nextBtn = document.getElementById('nextBtn');
        var prevBtn = document.getElementById('prevBtn');
        var submitBtn = document.getElementById('submitBtn');
        var questionCounter = document.getElementById('questionCounter');
        var serverNow = <?= time() ?> * 1000;
        var clientNow = Date.now();
        var serverOffset = serverNow - clientNow;
        var examKey = 'cbt_exam_' + <?= json_encode((string) $siswa['id_jadwal'] . '_' . (string) $siswa['username']) ?>;
        var delayDuration = 120 * 1000;
        var currentIndex = parseInt(localStorage.getItem(examKey + '_question'), 10);
        var countdownInterval;

        if (isNaN(currentIndex) || currentIndex < 0 || currentIndex >= slides.length) {
            currentIndex = 0;
        }

        var examDate = <?= json_encode($siswa['tanggal_mulai']) ?>;
        var examStart = <?= json_encode($siswa['waktu_mulai']) ?>.split(':');
        var examEnd = <?= json_encode($siswa['waktu_selesai']) ?>.split(':');
        var dateParts = examDate.split('-');
        var startTime = Date.UTC(
            parseInt(dateParts[0], 10),
            parseInt(dateParts[1], 10) - 1,
            parseInt(dateParts[2], 10),
            parseInt(examStart[0], 10) - 7,
            parseInt(examStart[1], 10),
            parseInt(examStart[2] || 0, 10)
        );
        var endTime = Date.UTC(
            parseInt(dateParts[0], 10),
            parseInt(dateParts[1], 10) - 1,
            parseInt(dateParts[2], 10),
            parseInt(examEnd[0], 10) - 7,
            parseInt(examEnd[1], 10),
            parseInt(examEnd[2] || 0, 10)
        );

        if (endTime <= startTime) {
            endTime += 24 * 60 * 60 * 1000;
        }

        function serverTime() {
            return Date.now() + serverOffset;
        }

        function getDelayEnd(index) {
            var key = examKey + '_delay_v2_' + index;
            var delayEnd = parseInt(localStorage.getItem(key), 10);

            if (isNaN(delayEnd)) {
                delayEnd = serverTime() + delayDuration;
                localStorage.setItem(key, String(delayEnd));
            }

            return delayEnd;
        }

        function updateNavigation() {
            var delayRemaining = Math.max(0, getDelayEnd(currentIndex) - serverTime());
            var isLastQuestion = currentIndex === slides.length - 1;

            prevBtn.disabled = currentIndex === 0;
            nextBtn.disabled = delayRemaining > 0 || isLastQuestion;
            submitBtn.disabled = !isLastQuestion;
            questionCounter.textContent = 'Soal ' + (currentIndex + 1) + ' dari ' + slides.length;

            if (delayRemaining > 0) {
                nextBtn.textContent = 'Tunggu ' + Math.ceil(delayRemaining / 1000) + ' detik';
            } else {
                nextBtn.textContent = 'Selanjutnya';
            }
        }

        function showQuestion(index) {
            if (index < 0 || index >= slides.length) {
                return;
            }

            currentIndex = index;
            slides.forEach(function(slide, slideIndex) {
                slide.classList.toggle('active', slideIndex === currentIndex);
            });
            localStorage.setItem(examKey + '_question', String(currentIndex));
            getDelayEnd(currentIndex);
            updateNavigation();
        }

        function restoreAnswers() {
            Array.prototype.forEach.call(quizForm.querySelectorAll('input[type="radio"]'), function(input) {
                var answerKey = examKey + '_answer_' + input.name;
                if (localStorage.getItem(answerKey) === input.value) {
                    input.checked = true;
                }
            });
        }

        quizForm.addEventListener('change', function(event) {
            if (event.target.matches('input[type="radio"]')) {
                localStorage.setItem(examKey + '_answer_' + event.target.name, event.target.value);
            }
        });

        quizForm.addEventListener('submit', function() {
            Object.keys(localStorage).forEach(function(key) {
                if (key.indexOf(examKey + '_') === 0) {
                    localStorage.removeItem(key);
                }
            });
        });

        nextBtn.addEventListener('click', function() {
            if (!nextBtn.disabled) {
                showQuestion(currentIndex + 1);
            }
        });

        prevBtn.addEventListener('click', function() {
            if (!prevBtn.disabled) {
                showQuestion(currentIndex - 1);
            }
        });

        function updateCountdown() {
            var remaining = Math.max(0, endTime - serverTime());
            var totalSeconds = Math.floor(remaining / 1000);
            var hours = Math.floor(totalSeconds / 3600);
            var minutes = Math.floor((totalSeconds % 3600) / 60);
            var seconds = totalSeconds % 60;

            countdownTimer.textContent = [hours, minutes, seconds]
                .map(function(value) {
                    return String(value).padStart(2, '0');
                })
                .join(':');

            if (remaining <= 5 * 60 * 1000) {
                countdownTimer.classList.add('warning');
                showQuestion(slides.length - 1);
            }

            if (remaining === 0) {
                clearInterval(countdownInterval);
                quizForm.submit();
            }

            updateNavigation();
        }

        restoreAnswers();
        showQuestion(currentIndex);
        updateCountdown();
        countdownInterval = setInterval(updateCountdown, 1000);
    })();
</script>