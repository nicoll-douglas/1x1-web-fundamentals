export default class Alert {
  static #container = document.querySelector("#alert-container");
  static #message = document.querySelector("#alert-message");
  static #currentTimeout;

  static show(message) {
    if (this.#currentTimeout) {
      this.hide();
    }

    this.#message.textContent = message;
    this.#container.classList.remove("hidden");

    this.#currentTimeout = setTimeout(() => {
      this.hide();
    }, 1500);
  }

  static hide() {
    clearTimeout(this.#currentTimeout);
    this.#currentTimeout = null;
    this.#container.classList.add("hidden");
  }
}
