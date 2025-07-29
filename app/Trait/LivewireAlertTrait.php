<?php

namespace App\Trait;

use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Jantinnerezo\LivewireAlert\Enums\Position;

trait LivewireAlertTrait
{
  /**
   * Menampilkan alert sukses dengan title dan text opsional
   *
   * @param string $title
   * @param string|null $text
   * @param string|Position $position
   * @param bool $isToast
   * @return void
   */
  public function alertSuccess(string $title, ?string $text = null, $position = 'center', bool $isToast = false): void
  {
    $alert = LivewireAlert::title($title);

    if ($text) {
      $alert->text($text);
    }

    if ($isToast) {
      $alert->toast()->position('top-end');
    } else {
      $alert->position($position instanceof Position ? $position : $position);
    }

    $alert->success()->show();
  }

  /**
   * Menampilkan alert error dengan title dan text opsional
   *
   * @param string $title
   * @param string|null $text
   * @param string|Position $position
   * @param bool $isToast
   * @return void
   */
  public function alertError(string $title, ?string $text = null, $position = 'center', bool $isToast = false): void
  {
    $alert = LivewireAlert::title($title);

    if ($text) {
      $alert->text($text);
    }

    if ($isToast) {
      $alert->toast()->position('top-end');
    } else {
      $alert->position($position instanceof Position ? $position : $position);
    }

    $alert->error()->show();
  }

  /**
   * Menampilkan alert warning dengan title dan text opsional
   *
   * @param string $title
   * @param string|null $text
   * @param string|Position $position
   * @param bool $isToast
   * @return void
   */
  public function alertWarning(string $title, ?string $text = null, $position = 'center', bool $isToast = false): void
  {
    $alert = LivewireAlert::title($title);

    if ($text) {
      $alert->text($text);
    }

    if ($isToast) {
      $alert->toast()->position('top-end');
    } else {
      $alert->position($position instanceof Position ? $position : $position);
    }

    $alert->warning()->show();
  }

  /**
   * Menampilkan alert info dengan title dan text opsional
   *
   * @param string $title
   * @param string|null $text
   * @param string|Position $position
   * @param bool $isToast
   * @return void
   */
  public function alertInfo(string $title, ?string $text = null, $position = 'center', bool $isToast = false): void
  {
    $alert = LivewireAlert::title($title);

    if ($text) {
      $alert->text($text);
    }

    if ($isToast) {
      $alert->toast()->position('top-end');
    } else {
      $alert->position($position instanceof Position ? $position : $position);
    }

    $alert->info()->show();
  }

  /**
   * Menampilkan alert question dengan title dan text opsional
   *
   * @param string $title
   * @param string|null $text
   * @param string|Position $position
   * @param bool $isToast
   * @return void
   */
  public function alertQuestion(string $title, ?string $text = null, $position = 'center', bool $isToast = false): void
  {
    $alert = LivewireAlert::title($title);

    if ($text) {
      $alert->text($text);
    }

    if ($isToast) {
      $alert->toast()->position('top-end');
    } else {
      $alert->position($position instanceof Position ? $position : $position);
    }

    $alert->question()->show();
  }
}
