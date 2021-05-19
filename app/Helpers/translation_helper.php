<?php

use App\Tools\FormatUtil;

function translate($english, $dataset = "default")
{
  return FormatUtil::translate($english, $dataset);

}
