<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('/') }}">{{ __('PHP INTERVIEW TASK') }}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="">
                <a class="nav-link " href="{{ route('/') }}">
                    <i class="fas fa-chart-pie"></i> <span>{{ __('Store Report') }}</span>
                </a>
            </li>
            <li class="">
                <a class="nav-link " href="{{ route('workspace.index') }}">
                    <i class="fa fa-bars"></i> <span>{{ __('Trello Workspace') }}</span>
                </a>
            </li>
            <li class="">
                <a class="nav-link " href="{{ route('trello.setting') }}">
                    <i class="fas fa-cogs"></i> <span>{{ __('Trello Setting') }}</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
