<header class="sticky top-0 z-10 bg-white/80 py-1 shadow-sm backdrop-blur-lg dark:bg-gray-800/80">
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
          class="from-accent to-accent bg-linear-to-r bg-clip-text text-2xl font-bold text-transparent">
          Dashboard</h1>
        <p class="text-xs text-gray-500 dark:text-gray-400">Welcome back, {{ Auth::user()->name }}
        </p>
      </div>
    </div>

    <div class="flex items-center space-x-3">
      <div class="relative">
        <div
          class="from-accent to-accent bg-linear-to-r flex h-10 w-10 items-center justify-center rounded-full">
          <span class="text-lg font-medium text-white">{{ Auth::user()->name[0] }}</span>
        </div>
        <div
          class="absolute -bottom-0.5 -right-0.5 h-3 w-3 rounded-full border-2 border-white bg-green-500 dark:border-gray-800">
        </div>
      </div>
    </div>
  </div>
</header>
