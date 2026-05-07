<?php
// app/Helpers/helpers.php

if (!function_exists('settings')) {
  function settings($key, $default = null)
  {
    return \App\Models\SiteSetting::get($key, $default);
  }
}
