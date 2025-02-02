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
  /**
   * The directory containing views for the application.
   */
  public const DIR = __DIR__ . "/../views";
  private readonly string $filename;
  private Layout $layout;
  private array $data;
  private int $status;
  /**
   * Stores a string buffer of HTML representing the view.
   */
  private string $buffer;

  /**
   * Initialises the view and creates a reference to it in the custom request globals.
   * @param string $filename The filename of the view relative to the views directory.
   * @param array $data The data to be used for the view.
   * @param Layout $layout The filename of the layout to be used with the view.
   * @param int $status The HTTP response code to be set for the view when shown.
   */
  public function __construct(
    string $filename = "",
    array $data = [],
    Layout $layout = Layout::Main,
    int $status = 200
  ) {
    $this->filename = $filename;
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
   * Stops output buffering and stores the result of the buffer whichs represents the view.
   */
  public function stopBuffering()
  {
    $buffer = ob_get_clean() ?: "";
    $this->buffer = $buffer;
  }

  /**
   * Shows the currently configured view and exits the script.
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
   * Shows the contents of the current view; either echoes the current buffer or requires the filename.
   * 
   * Assumes either is set and prioritises the buffer.
   */
  public function showContent()
  {
    if ($this->buffer) {
      echo $this->buffer;
    } else {
      require_once self::DIR . $this->filename;
    }
  }

  public function setLayout(Layout $layout)
  {
    $this->layout = $layout;
  }

  /**
   * Gets the fully qualified filename of the layout.
   */
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
   * Append new data to the view data array (merges them).
   * @param array $data The key-value pairs to append; overrides existing keys.
   */
  public function appendData(array $data)
  {
    $this->data = array_merge($this->data, $data);
  }

  /**
   * Sets the page title data.
   * @param string $title The new title.
   */
  public function setTitle(string $title)
  {
    $this->data["meta"]["title"] = $title;
  }

  public function getTitle(): string|null
  {
    $meta = $this->data["meta"];
    if (isset($meta)) {
      return $meta["title"];
    }
  }

  /**
   * Sets a script to be used with the view.
   * @param string $filename The filename of the script relative to the script asset directory.
   */
  public function script(string $filename)
  {
    $this->data["meta"]["js"][] = "/assets/js" . $filename;
  }

  /**
   * Sets a stylesheet to be used with the view.
   * @param string $filename The filename of the stylesheet relative to the CSS asset directory.
   */
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
