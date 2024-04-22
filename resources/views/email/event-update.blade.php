@component('mail::message')
    # Event Update Notification

    Dear {{ $user_name }},

    The event "{{ $event_name }}" you have purchased tickets for has been updated. Please check the information about the
    ticket.

    @component('mail::button', ['url' => url('/PurchasedTicket/' . $event_id)])
        View Event
    @endcomponent

    Thank you for using our application!
@endcomponent
