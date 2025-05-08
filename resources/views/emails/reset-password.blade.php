@component('mail::message')
# Hai richiesto di resettare la password

Clicca qui per impostare una nuova password:

@component('mail::button', ['url' => $url])
Reimposta la password
@endcomponent

Se non hai fatto tu questa richiesta, ignora questa email.

Grazie,<br>
{{ config('app.name') }}
@endcomponent
