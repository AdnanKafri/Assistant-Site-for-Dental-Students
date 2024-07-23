// post.js

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.edit-post').forEach(button => {
        button.addEventListener('click', (e) => {
            const postId = e.target.closest('.post').dataset.postId;
            window.location.href = `/posts/${postId}/edit`;
        });
    });

    document.querySelectorAll('.delete-post').forEach(button => {
        button.addEventListener('click', (e) => {
            const postId = e.target.closest('.post').dataset.postId;
            if (confirm('Are you sure you want to delete this post?')) {
                fetch(`/posts/${postId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }).then(response => {
                    if (response.ok) {
                        window.location.href = '/dashboard';
                    }
                });
            }
        });
    });

    document.querySelectorAll('.send-request').forEach(button => {
        button.addEventListener('click', (e) => {
            const postId = e.target.closest('.post').dataset.postId;
            window.location.href = `/request-treatment?post_id=${postId}`;
        });
    });
    document.querySelectorAll('.send-request2').forEach(button => {
        button.addEventListener('click', (e) => {
            const postId = e.target.closest('.post').dataset.postId;
            window.location.href = `/request-treatment2?post_id=${postId}`;
        });
    });

    document.getElementById('images').addEventListener('change', (e) => {
        if (e.target.files.length > 7) {
            alert('You can upload a maximum of 7 images.');
            e.target.value = ''; // Clear the input
        }
    });

    document.querySelectorAll('.settings-button').forEach(button => {
        button.addEventListener('click', (e) => {
            const menu = e.target.nextElementSibling;
            menu.classList.toggle('hidden');
        });
    });

    const modal = document.createElement('div');
    modal.className = 'image-modal';
    document.body.appendChild(modal);

    const modalContent = document.createElement('img');
    modalContent.className = 'image-modal-content';
    modal.appendChild(modalContent);

    const closeModal = document.createElement('span');
    closeModal.className = 'close';
    closeModal.innerHTML = '&times;';
    modal.appendChild(closeModal);

    const prevBtn = document.createElement('button');
    prevBtn.className = 'prev-image';
    prevBtn.innerHTML = '&laquo;';
    modal.appendChild(prevBtn);

    const nextBtn = document.createElement('button');
    nextBtn.className = 'next-image';
    nextBtn.innerHTML = '&raquo;';
    modal.appendChild(nextBtn);

    let images = [];
    let currentImageIndex = 0;

    document.querySelectorAll('.post-image').forEach(img => {
        img.addEventListener('click', (e) => {
            images = Array.from(e.target.closest('.images').querySelectorAll('img'));
            currentImageIndex = images.indexOf(e.target);
            modal.style.display = 'block';
            modalContent.src = images[currentImageIndex].src;
        });
    });

    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    prevBtn.addEventListener('click', () => {
        currentImageIndex = (currentImageIndex > 0) ? currentImageIndex - 1 : images.length - 1;
        modalContent.src = images[currentImageIndex].src;
    });

    nextBtn.addEventListener('click', () => {
        currentImageIndex = (currentImageIndex < images.length - 1) ? currentImageIndex + 1 : 0;
        modalContent.src = images[currentImageIndex].src;
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal.style.display === 'block') {
            modal.style.display = 'none';
        } else if ((e.key === 'ArrowLeft' || e.key === 'ArrowRight') && modal.style.display === 'block') {
            if (e.key === 'ArrowLeft') {
                currentImageIndex = (currentImageIndex > 0) ? currentImageIndex - 1 : images.length - 1;
            } else {
                currentImageIndex = (currentImageIndex < images.length - 1) ? currentImageIndex + 1 : 0;
            }
            modalContent.src = images[currentImageIndex].src;
        }
    });
});
