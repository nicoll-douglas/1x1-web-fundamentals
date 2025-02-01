/**
 * Component class that provides functionality for an alert.
 */
export default class Alert {
  #container;
  #text;
  #currentTimeout;
  #message;

  /**
   * Initialises the fields and gets the necessary DOM elements to load them into the class.
   * @param {string} containerSelector The selector for the alert container element (the element to hide and show).
   * @param {string} message An optional value to initially set the message to.
   */
  constructor(containerSelector, message) {
    this.#container = document.querySelector(containerSelector);
    this.#text = document.querySelector(`${containerSelector} p`);
    this.#message = message;
  }

  /**
   * Show the alert for a certain amount of time before hiding.
   */
  show() {
    if (this.#currentTimeout) {
      this.hide();
    }

    this.#text.textContent = this.#message;
    this.#container.classList.remove("hidden");

    this.#currentTimeout = setTimeout(() => {
      this.hide();
    }, 1500);
  }

  /**
   * Hides the alert.
   */
  hide() {
    clearTimeout(this.#currentTimeout);
    this.#currentTimeout = null;
    this.#text.textContent = "";
    this.#container.classList.add("hidden");
  }

  /**
   * Sets the text content of the alert.
   * @param {string} value The value to set.
   */
  setMessage(value) {
    this.#message = value;
  }
}
