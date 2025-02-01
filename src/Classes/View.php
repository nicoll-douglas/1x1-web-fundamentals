<?php

declare(strict_types=1);

namespace App\Classes;

use App\Enums\Layout;
use App\Classes\RequestGlobals;

/**
 * Class to instantiate and show views.
 */
class View
{
  public const DIR = __DIR__ . "/../views";
  private readonly string $filename;
  private Layout $layout;
  private array $data;
  private int $status;
  private string $buffer;

  public function __construct(
    string $filename = "",
    array $data = [],
    Layout $layout = Layout::Main,
    int $status = 200
  ) {
    if ($filename) {
      $this->filename = $filename;
    }
    $this->data = $data;
    $this->layout = $layout;
    $this->status = $status;
    $this->buffer = "";
    RequestGlobals::$view = $this;
  }

  /**
   * Starts output buffering.
   */
  public function startBuffering()
  {
    ob_start();
  }

  /**
   * Stops output buffering and stores the result.
   */
  public function stopBuffering()
  {
    $buffer = ob_get_clean() ?: "";
    $this->buffer = $buffer;
  }

  /**
   * Shows the currently configured view.
   */
  public function show()
  {
    if (!$this->layout) {
      http_response_code($this->status);
      $this->showContent();
      exit;
    }

    http_response_code($this->status);
    require_once __DIR__ . "/../templates" . $this->layout->value;
    exit;
  }

  /**
   * Shows the contents of the current view, either echoes the buffer or includes the filename.
   */
  public function showContent()
  {
    if ($this->buffer) {
      echo $this->buffer;
    } else {
      require self::DIR . $this->filename;
    }
  }

  public function setLayout(Layout $layout)
  {
    $this->layout = $layout;
  }

  public function getLayout(): string
  {
    return __DIR__ . "/../templates" . $this->layout->value;
  }

  public function getStatus(): int
  {
    return $this->status;
  }

  public function setStatus(int $status)
  {
    $this->status = $status;
  }

  public function getData(): array
  {
    return $this->data;
  }

  public function setData(array $data)
  {
    $this->data = $data;
  }

  /**
   * Append new data to the view data array.
   * @param array $data The key-value pairs to append, overrides existing keys.
   */
  public function appendData(array $data)
  {
    $this->data = array_merge($this->data, $data);
  }

  /**
   * Sets the page title metadata.
   */
  public function setTitle(string $title)
  {
    $this->data["meta"]["title"] = $title;
  }

  public function script(string $filename)
  {
    $this->data["meta"]["js"][] = "/assets/js" . $filename;
  }

  public function style(string $filename)
  {
    $this->data["meta"]["css"][] = "/assets/css" . $filename;
  }

  public function getFilename()
  {
    return self::DIR . $this->filename;
  }

  public function setFilename(string $filename)
  {
    $this->filename = $filename;
  }
}
