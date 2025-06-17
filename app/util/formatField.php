<?php

function formatField(string $field): string
{
  if (!isset($field) || null == $field)
    return "not-set";
  if ("" == $field)
    return "not-set";
  return $field;
}
