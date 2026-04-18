<header class="sticky top-0 z-10 bg-white/80 shadow-sm backdrop-blur-lg dark:bg-gray-800/80 py-1">
  <div class="flex h-16 items-center justify-between px-4 sm:px-6">
    <div class="flex items-center space-x-4">
      <button
        class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700 lg:hidden dark:text-gray-400 dark:hover:bg-gray-700"
        id="openSidebarBtn">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path d="M4 6h16M4 12h16M4 18h16" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="2"></path>
        </svg>
      </button>
      <div>
        <h1
          class="from-primary to-accent bg-gradient-to-r bg-clip-text text-2xl font-bold text-transparent">
          Dashboard</h1>
        <p class="text-xs text-gray-500 dark:text-gray-400">Welcome back, Admin</p>
      </div>
    </div>

    <div class="flex items-center space-x-3">
      <!-- Search -->
      <button
        class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-gray-700">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-linecap="round"
            stroke-linejoin="round" stroke-width="2"></path>
        </svg>
      </button>

      <!-- Notifications -->
      <button
        class="relative rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-gray-700">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path
            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
        </svg>
        <span class="absolute right-1 top-1 h-2 w-2 rounded-full bg-red-500"></span>
      </button>

      <!-- Theme Toggle -->
      <button
        class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-gray-700"
        id="themeToggle">
        <svg class="hidden h-5 w-5 dark:block" fill="none" stroke="currentColor"
          viewBox="0 0 24 24">
          <path
            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"
            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
        </svg>
        <svg class="block h-5 w-5 dark:hidden" fill="none" stroke="currentColor"
          viewBox="0 0 24 24">
          <path
            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"
            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
        </svg>
      </button>

      <!-- User Menu -->
      <div class="relative" x-cloak x-data="{ open: false }">
        <button @click="open = !open"
          class="flex items-center space-x-2 rounded-lg p-1.5 hover:bg-gray-100 dark:hover:bg-gray-700">
          <div class="relative">
            <div
              class="from-primary to-accent flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-r">
              <span class="text-sm font-medium text-white">AD</span>
            </div>
            <div
              class="absolute -bottom-0.5 -right-0.5 h-3 w-3 rounded-full border-2 border-white bg-green-500 dark:border-gray-800">
            </div>
          </div>
          <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round"
              stroke-width="2"></path>
          </svg>
        </button>
        <div @click.away="open = false"
          class="absolute right-0 mt-2 w-56 rounded-xl bg-white shadow-lg ring-1 ring-black ring-opacity-5 dark:bg-gray-800"
          style="display: none;" x-show="open">
          <div class="p-2">
            <div class="border-b border-gray-200 px-3 py-2 dark:border-gray-700">
              <p class="text-sm font-medium text-gray-900 dark:text-white">Admin User</p>
              <p class="text-xs text-gray-500 dark:text-gray-400">admin@mimshach.com</p>
            </div>
            <a class="flex items-center space-x-2 rounded-lg px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700"
              href="#">
              <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
              </svg>
              <span>Profile</span>
            </a>
            <a class="flex items-center space-x-2 rounded-lg px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700"
              href="#">
              <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path
                  d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
              </svg>
              <span>Settings</span>
            </a>
            <div class="border-t border-gray-200 dark:border-gray-700"></div>
            <form action="{{ route('admin.logout') }}" method="POST">
              @csrf
              <button
                class="flex w-full items-center space-x-2 rounded-lg px-3 py-2 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20"
                type="submit">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                  </path>
                </svg>
                <span>Logout</span>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
