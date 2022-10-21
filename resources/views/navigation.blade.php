<nav id="header" class="bg-gray-900 fixed w-full z-10 top-0 shadow">
    <div class="w-full container mx-auto flex flex-wrap items-center mt-0 pt-3 pb-3 md:pb-0">

        <div class="w-1/2 pl-2 md:pl-0">
            <div class="shrink-0 flex items-center">

            </div>
        </div>
        <div class="w-1/2 pr-0">
            <div class="flex relative inline-block float-right">
                <div>
                    HELLO
                </div>
                <div class="block lg:hidden pr-4">
                <button id="nav-toggle" class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-gray-100 hover:border-teal-500 appearance-none focus:outline-none">
                    <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
                </button>
            </div>
            </div>

        </div>


        <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-0 bg-gray-900 z-20" id="nav-content">
            <ul class="list-reset lg:flex flex-1 items-center px-4 md:px-0">
                <li class="mr-6 my-2 md:my-0">
                    <x-translation-manager::responsive-nav-link :href="route(config('translation-manager.route.prefix').'.index')" :active="request()->routeIs(config('translation-manager.route.prefix').'.index')">
                        <i class="fas fa-tasks fa-fw mr-3"></i>traslations
                    </x-translation-manager::responsive-nav-link>
                </li>
             
                <li class="mr-6 my-2 md:my-0">
                    <x-translation-manager::responsive-nav-link :href="route(config('translation-manager.route.prefix').'.modeltranslations')" :active="request()->routeIs(config('translation-manager.route.prefix').'.modeltranslations')">
                        <i class="fas fa-tasks fa-fw mr-3"></i>Model traslations
                    </x-translation-manager::responsive-nav-link>
                </li>
                <li class="mr-6 my-2 md:my-0">
                    <x-translation-manager::responsive-nav-link :href="route(config('translation-manager.route.prefix').'.group.index')" :active="request()->routeIs(config('translation-manager.route.prefix').'.group.index')">
                        <i class="fas fa-tasks fa-fw mr-3"></i>Groups
                    </x-translation-manager::responsive-nav-link>
                </li>
            </ul>
        </div>
    </div>
</nav>
