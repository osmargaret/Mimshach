<div @class(['deadline-timer']) data-deadline="{{ $target }}">
  <div @class(['timer-label'])>
    {{ $label ?? 'Time Remaining' }}
  </div>

  <div @class(['timer-numbers'])>

    <div @class(['timer-unit'])>
      <div @class(['number', 'months']) id='months'>00</div>
      <div @class(['label'])>Months</div>
    </div>

    <div @class(['timer-unit'])>
      <div @class(['number', 'days']) id="days">00</div>
      <div @class(['label'])>Days</div>
    </div>

    <div @class(['timer-unit'])>
      <div @class(['number', 'hours']) id="hours">00</div>
      <div @class(['label'])>Hours</div>
    </div>

    <div @class(['timer-unit'])>
      <div @class(['number', 'minutes']) id="minutes">00</div>
      <div @class(['label'])>Mins</div>
    </div>

    <div @class(['timer-unit'])>
      <div @class(['number', 'seconds']) id="seconds">00</div>
      <div @class(['label'])>Secs</div>
    </div>

  </div>
</div>
