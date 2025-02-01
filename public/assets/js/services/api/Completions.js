/**
 * Service class to interface with the Tutorial Completions service.
 */
export default class Completions {
  /**
   * Makes a PUT request to /api/me/completions to replace with the new completions.
   * @param {string} csrfToken The current CSRF token.
   * @param {Array<Array<string>>} completions The updated completions to make with the request.
   * @returns Promise<Response> The request response
   */
  static async put(csrfToken, completions) {
    return fetch("/api/me/completions", {
      method: "PUT",
      body: JSON.stringify({
        csrfToken,
        completions,
      }),
      headers: {
        "Content-Type": "application/json",
      },
    });
  }
}
