<div
  class="deadline-timer bg-linear-to-r relative mt-6 overflow-hidden rounded-2xl from-[#0A192F] via-[#1a2f4a] to-[#0A192F] p-6 shadow-xl transition-all duration-300 hover:shadow-2xl"
  data-deadline="{{ $target }}">
  <!-- Animated background effect -->
  <div
    class="bg-linear-to-r absolute inset-0 animate-pulse from-[#C6A43F]/0 via-[#C6A43F]/5 to-[#C6A43F]/0">
  </div>

  <div
    class="timer-label relative mb-4 text-center text-sm font-bold uppercase tracking-wider text-[#C6A43F]">
    ⏰ {{ $label ?? 'Time Remaining' }} ⏰
  </div>

  <div class="timer-numbers relative grid grid-cols-5 gap-4">
    <div class="timer-unit flex flex-col items-center">
      <div
        class="months number flex h-20 w-full items-center justify-center rounded-xl bg-white/5 px-6 text-3xl font-bold text-white shadow-inner backdrop-blur-sm transition-all duration-200 hover:scale-105 hover:bg-white/10 md:h-24 md:text-4xl"
        id="months">
        00
      </div>
      <div class="label mt-2 text-xs font-semibold uppercase tracking-wider text-gray-400">Months
      </div>
    </div>

    <div class="timer-unit flex flex-col items-center">
      <div
        class="days number flex h-20 w-full items-center justify-center rounded-xl bg-white/5 px-6 text-3xl font-bold text-white shadow-inner backdrop-blur-sm transition-all duration-200 hover:scale-105 hover:bg-white/10 md:h-24 md:text-4xl"
        id="days">
        00
      </div>
      <div class="label mt-2 text-xs font-semibold uppercase tracking-wider text-gray-400">Days
      </div>
    </div>

    <div class="timer-unit flex flex-col items-center">
      <div
        class="hours number flex h-20 w-full items-center justify-center rounded-xl bg-white/5 px-6 text-3xl font-bold text-white shadow-inner backdrop-blur-sm transition-all duration-200 hover:scale-105 hover:bg-white/10 md:h-24 md:text-4xl"
        id="hours">
        00
      </div>
      <div class="label mt-2 text-xs font-semibold uppercase tracking-wider text-gray-400">Hours
      </div>
    </div>

    <div class="timer-unit flex flex-col items-center">
      <div
        class="minutes number flex h-20 w-full items-center justify-center rounded-xl bg-white/5 px-6 text-3xl font-bold text-white shadow-inner backdrop-blur-sm transition-all duration-200 hover:scale-105 hover:bg-white/10 md:h-24 md:text-4xl"
        id="minutes">
        00
      </div>
      <div class="label mt-2 text-xs font-semibold uppercase tracking-wider text-gray-400">Mins
      </div>
    </div>

    <div class="timer-unit flex flex-col items-center">
      <div
        class="seconds number bg-accent/20 text-accent hover:bg-accent/30 flex h-20 w-full items-center justify-center rounded-xl px-6 text-3xl font-bold shadow-inner backdrop-blur-sm transition-all duration-200 hover:scale-105 md:h-24 md:text-4xl"
        id="seconds">
        00
      </div>
      <div class="label mt-2 text-xs font-semibold uppercase tracking-wider text-gray-400">Secs
      </div>
    </div>
  </div>
</div>
