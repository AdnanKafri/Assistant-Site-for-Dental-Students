// public/js/admin.js
document.addEventListener('DOMContentLoaded', function() {
    // Toggle submenu visibility
    const toggleMenuLinks = document.querySelectorAll('.toggle-menu');
    toggleMenuLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const submenu = this.nextElementSibling;
            if (submenu && submenu.classList.contains('submenu')) {
                submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
                this.querySelector('i').classList.toggle('fa-caret-down');
                this.querySelector('i').classList.toggle('fa-caret-up');
            }
        });
    });

    const addUserButton = document.getElementById('addUserButton');
    if (addUserButton) {
        addUserButton.addEventListener('click', function() {
            Swal.fire({
                title: 'Select User Type',
                html: `
                    <button id="addStudentButton" class="swal2-confirm swal2-styled">Student</button>
                    <button id="addPatientButton" class="swal2-confirm swal2-styled">Patient</button>
                    <button id="addSupervisorButton" class="swal2-confirm swal2-styled">Supervisor</button>
                `,
                showCancelButton: true,
                showConfirmButton: false
            });

            document.getElementById('addStudentButton').addEventListener('click', function() {
                window.location.href = '/admin/users/create/student';
            });

            document.getElementById('addPatientButton').addEventListener('click', function() {
                window.location.href = '/admin/users/create/patient';
            });

            document.getElementById('addSupervisorButton').addEventListener('click', function() {
                window.location.href = '/admin/users/create/supervisor';
            });
        });
    }

    // Handling delete for users
    const deleteUserButtons = document.querySelectorAll('.delete-user-button');
    deleteUserButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const form = this.closest('form');
            const userName = form.closest('tr').querySelector('td:nth-child(2)').textContent;
            Swal.fire({
                title: 'Are you sure?',
                text: `Do you really want to delete user ${userName}? This process cannot be undone.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // Handling delete for subjects
    const deleteSubjectButtons = document.querySelectorAll('.delete-subject-button');
    deleteSubjectButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const form = this.closest('form');
            const subjectName = form.closest('tr').querySelector('td:nth-child(1)').textContent;
            Swal.fire({
                title: 'Are you sure?',
                text: `Do you really want to delete subject ${subjectName}? This process cannot be undone.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // Handling delete for marks
    const deleteMarkButtons = document.querySelectorAll('.delete-mark-button');
    deleteMarkButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const form = this.closest('form');
            const studentName = form.closest('tr').querySelector('td:nth-child(1)').textContent;
            const subjectName = form.closest('tr').querySelector('td:nth-child(2)').textContent;
            Swal.fire({
                title: 'Are you sure?',
                text: `Do you really want to delete the mark of ${studentName} (${subjectName})? This process cannot be undone.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // Add SweetAlert for delete confirmation
    const deleteButtons = document.querySelectorAll('.delete-button');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('form');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
