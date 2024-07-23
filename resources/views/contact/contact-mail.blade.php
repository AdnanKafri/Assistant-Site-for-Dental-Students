{{-- resources/views/emails/contact/contact-mail.blade.php --}}

@component('mail::message')
    # New Contact Form Submission

    Name: {{ $contactData['name'] }}

    Email: {{ $contactData['email'] }}

    Message:
    {{ $contactData['message'] }}

@endcomponent
