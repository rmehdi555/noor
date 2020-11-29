@component('mail::message')
    {{__('web/public.activation_email_title')}}
    @component('mail::button',['url'=>route('activation.account.by.email',$code)])
        {{__('web/public.activation_email_button')}}
    @endcomponent

@endcomponent