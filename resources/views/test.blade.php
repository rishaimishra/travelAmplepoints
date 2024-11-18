@if(Auth::check())
    {{-- User is authenticated --}}
    <p>User ID: {{ Auth::user()->id }}</p>
@else
    {{-- User is not authenticated --}}
    <p>User is not logged in.</p>
@endif
 {{ cookie('user_id') }}