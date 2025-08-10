<?php
function input(string $data): string
{
  static $charsToRemove = ['\'', ';', '[', ']', '{', '}', '|', '^', '~', '<', '>', '+', '&', '$', '#', '!'];

  return htmlspecialchars(
    stripslashes(
      trim(
        str_replace($charsToRemove, '', $data)
      )
    ),
    ENT_QUOTES | ENT_HTML5,
    'UTF-8'
  );
}