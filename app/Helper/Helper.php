<?php

function generateRandomString($alpha_length = 2, $num_length = 4) {
  $alpha = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $number = '0123456789';
  $alphaLength = strlen($alpha);
  $numberLength = strlen($number);
  $randomString = '';
  for ($i = 0; $i < $alpha_length; $i++) {
      $randomString .= $alpha[rand(0, $alphaLength - 1)];
  }
  for ($i = 0; $i < $num_length; $i++) {
      $randomString .= $number[rand(0, $numberLength - 1)];
  }
  return $randomString;
}

function getRoleByGuard($guardName)
{
    switch ($guardName) {
        case 'clinic':
            return \App\Enums\User\Type::CLINIC;
        case 'patient':
            return \App\Enums\User\Type::USER;
        case 'doctor':
            return \App\Enums\User\Type::DOCTOR;
        default:
            return '';
    }
}