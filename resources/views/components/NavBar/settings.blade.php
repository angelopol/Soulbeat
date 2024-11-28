<header class="header">
    <nav class="set">
        <span class="title">Settings</span>
    </nav>
    @if(auth()->user()->type == 1)
        <nav class="pi">
            <a href="{{route('company.settings.view')}}" class="botones-header">Company</a>
        </nav>
    @endif
</header>