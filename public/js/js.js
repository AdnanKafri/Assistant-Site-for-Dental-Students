document.addEventListener('DOMContentLoaded', function () {
    console.log("JavaScript is working successfully");

    var cards = document.querySelectorAll('.card');
    var modal = document.getElementById('modal');
    var emailSpan = document.getElementById('email-span');
    var closeButtons = document.querySelectorAll('.close');
    var submitButton = document.getElementById('submit-button');
    var passwordInput = document.getElementById('password-input');

    cards.forEach(function (card) {
        card.addEventListener('click', function () {
            var email = card.getAttribute('data-email');
            var name = card.getAttribute('data-name');
            var state = card.getAttribute('data-state');

            if (state == 0) {
                Swal.fire({
                    title: 'تأكيد التسجيل',
                    text: 'هل أنت متأكد أنك تريد التسجيل باسم ' + name + '؟ سيتم إرسال كلمة المرور إلى بريدك التالي الذي يبدأ ب ' + email.substring(0, 3) + '...',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'نعم، سجلني',
                    cancelButtonText: 'إلغاء'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // إرسال طلب لتغيير حالة المستخدم
                        fetch('/update-registration-status', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ email: email })
                        }).then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // تم تحديث الحالة بنجاح، قم بفتح نافذة إدخال كلمة المرور
                                    emailSpan.textContent = email;
                                    modal.style.display = 'block';
                                } else {
                                    console.error('Error updating registration status:', data.message);
                                    Swal.fire('خطأ', 'حدث خطأ أثناء محاولة التسجيل. حاول مرة أخرى.', 'error');
                                }
                            }).catch(error => {
                            console.error('Fetch error:', error);
                        });
                    }
                });
            } else if (state == 2) {
                // إذا كانت الحالة معلق، افتح نافذة إدخال كلمة المرور مباشرة
                openPasswordModal(email);
            }
        });
    });

    closeButtons.forEach(function (closeButton) {
        closeButton.addEventListener('click', function () {
            modal.style.display = 'none';
        });
    });

    window.addEventListener('click', function (event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    });

    submitButton.addEventListener('click', function () {
        var email = emailSpan.textContent;
        var password = passwordInput.value;

        fetch('/verify-password', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ email: email, password: password })
        }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('نجاح', 'تم التحقق من كلمة المرور بنجاح.', 'success')
                        .then(() => {
                            modal.style.display = 'none';
                            location.href="http://127.0.0.1:8000/login"; // إعادة تحميل الصفحة بعد نجاح التحقق
                        });
                } else {
                    Swal.fire('خطأ', 'كلمة المرور غير صحيحة. حاول مرة أخرى.', 'error');
                }
            }).catch(error => {
            console.error('Fetch error:', error);
        });
    });

    function openPasswordModal(email) {
        emailSpan.textContent = email;
        modal.style.display = 'block';
    }

    cards.forEach(function (card) {
        var state = card.getAttribute('data-state');
        if (state == 2) {
            setTimeout(function () {
                var email = card.getAttribute('data-email');
                fetch('/reset-pending-status', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ email: email })
                }).then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            updateRegistrationStatus(card, 0);
                        }
                    }).catch(error => {
                    console.error('Fetch error:', error);
                });
            }, 30000); // تأخير 30 ثانية للمعلقين
        }
    });

    function updateRegistrationStatus(card, status) {
        if (status == 1) {
            card.classList.add('registered');
            card.classList.remove('not-registered');
            card.classList.remove('pending');
            card.querySelector('.status').textContent = 'مسجل';
        } else if (status == 0) {
            card.classList.add('not-registered');
            card.classList.remove('registered');
            card.classList.remove('pending');
            card.querySelector('.status').textContent = 'غير مسجل';
        } else {
            card.classList.add('pending');
            card.classList.remove('registered');
            card.classList.remove('not-registered');
            card.querySelector('.status').textContent = 'معلق';
        }
    }

});
