            <!-- BEGIN: Side Menu -->
            <nav class="side-nav">
                <a href="" class="intro-x flex items-center pl-5 pt-4">
                    <img alt="Agnai SEED" class="w-6" src="{{ asset('images/logo.svg') }}">
                    <span class="hidden xl:block text-white text-lg ml-3"> SEED </span> 
                </a>
                <div class="side-nav__devider my-6"></div>
                <ul>
                    <li>
                        <a href="{{ url('dashboard') }}" class="{{ (request()->is('dashboard*')) ? 'side-menu side-menu--active' : 'side-menu' }}">
                            <div class="side-menu__icon"> <i data-lucide="home"></i> </div>
                            <div class="side-menu__title">
                                Hospital Settings 
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('branches') }}" class="{{ (request()->is('branches*')) ? 'side-menu side-menu--active' : 'side-menu' }}">
                            <div class="side-menu__icon"> <i data-lucide="box"></i> </div>
                            <div class="side-menu__title">
                                Branches
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;" class="{{ (request()->is('doctors*')) ? 'side-menu side-menu--active' : 'side-menu' }}">
                            <div class="side-menu__icon"> <i data-lucide="shopping-bag"></i> </div>
                            <div class="side-menu__title">
                                Doctors 
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="side-menu-light-inbox.html" class="{{ (request()->is('patients*')) ? 'side-menu side-menu--active' : 'side-menu' }}">
                            <div class="side-menu__icon"> <i data-lucide="inbox"></i> </div>
                            <div class="side-menu__title"> Patients </div>
                        </a>
                    </li>
                    <li>
                        <a href="side-menu-light-file-manager.html" class="{{ (request()->is('reportSettings*')) ? 'side-menu side-menu--active' : 'side-menu' }}">
                            <div class="side-menu__icon"> <i data-lucide="hard-drive"></i> </div>
                            <div class="side-menu__title"> Report Settings </div>
                        </a>
                    </li>
                    <li>
                        <a href="side-menu-light-point-of-sale.html" class="{{ (request()->is('generateForm*')) ? 'side-menu side-menu--active' : 'side-menu' }}">
                            <div class="side-menu__icon"> <i data-lucide="credit-card"></i> </div>
                            <div class="side-menu__title"> Generate Consent Form </div>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- END: Side Menu -->
       