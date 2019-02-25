@component('mail::message')
# Introduction

Hi,

Thank you for subscribing for Express Notify. 

Your payment has been processed successfully and the invoice has been attached to this email.

As you already have an account with us, no further setup is required and you can login and manage your account.

@component('mail::button', ['url' => 'https://express.notify'])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent
