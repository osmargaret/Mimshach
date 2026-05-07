<div
  class="from-accent to-accent bg-linear-to-r relative overflow-hidden rounded-2xl p-6 text-white shadow-xl">
  <div
    class="absolute right-0 top-0 h-32 w-32 -translate-y-8 translate-x-8 transform rounded-full bg-white/20 blur-2xl">
  </div>
  <div
    class="absolute bottom-0 left-0 h-40 w-40 -translate-x-8 translate-y-8 transform rounded-full bg-white/10 blur-2xl">
  </div>
  <div class="relative">
    <h2 class="text-2xl font-bold">Welcome back, {{ auth()->user()->name }}! 👋</h2>
    <p class="mt-2 text-white/90">Here's what's happening with your platform today.</p>
    <div class="mt-4 flex flex-wrap gap-3">
      <span
        class="inline-flex items-center rounded-full bg-white/20 px-3 py-1 text-sm backdrop-blur-sm">
        <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round"
            stroke-linejoin="round" stroke-width="2"></path>
        </svg>
        Last updated: <span id="current-time"></span>
      </span>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const timeElement = document.getElementById('current-time');
    const now = new Date();
    const options = {
      year: 'numeric',
      month: 'long',
      day: 'numeric',
      hour: 'numeric',
      minute: '2-digit',
      hour12: true
    };
    timeElement.textContent = now.toLocaleString(undefined, options);
  });
</script>
