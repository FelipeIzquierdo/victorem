<div id="sidebar">
    <!-- Sidebar Brand -->
    <div id="sidebar-brand" class="themed-background">
        <a href="/" class="sidebar-title">
            <img src="/images/vinder200header.png">
        </a>
    </div>
    <!-- END Sidebar Brand -->

    <!-- Wrapper for scrolling functionality -->
    <div id="sidebar-scroll">
        <!-- Sidebar Content -->
        <div class="sidebar-content">
            <!-- Sidebar Navigation -->
            <ul class="sidebar-nav">
                <li>
                    <a href="/" class=" active"><i class="gi gi-compass sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Inicio</span></a>
                </li>

                <li class="sidebar-separator">
                    <i class="fa fa-ellipsis-h"></i>
                </li>

                @foreach($mainModules as $module)
                    <li>
                        <a href="/{{ $module->url }}"><i class="{{ $module->icon_class }} sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">{{ $module->description }}</span></a>
                    </li>
                @endforeach

                <li class="sidebar-separator">
                    <i class="fa fa-ellipsis-h"></i>
                </li>

                @foreach($extraModules as $module)
                    <li>
                        <a href="/{{ $module->url }}"><i class="{{ $module->icon_class }} sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">{{ $module->description }}</span></a>
                    </li>
                @endforeach

                <li class="sidebar-separator">
                    <i class="fa fa-ellipsis-h"></i>
                </li>

                <li>
                    <a href="/system"><i class="fa fa-asterisk sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Configuración Sistema</span></a>
                </li>
                
            </ul>
            <!-- END Sidebar Navigation -->
        </div>
        <!-- END Sidebar Content -->
    </div>
    <!-- END Wrapper for scrolling functionality -->

    <!-- Sidebar Extra Info -->
    <div id="sidebar-extra-info" class="sidebar-content sidebar-nav-mini-hide">
        <div class="text-center">
            <small><span id="year-copy"></span> &copy; <a href="#">VINDER 1.0</a></small>
        </div>
    </div>
    <!-- END Sidebar Extra Info -->
</div>