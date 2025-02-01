/**
 * Service class to interface with the User service.
 */
export default class User {
  /**
   * Makes a DELETE request to /api/me to delete the current user.
   * @param {string} csrfToken The current CSRF token.
   * @returns Promise<Response> The request response.
   */
  static async _delete(csrfToken) {
    return fetch("/api/me", {
      method: "DELETE",
      body: JSON.stringify({
        csrfToken,
      }),
      headers: {
        "Content-Type": "application/json",
      },
      redirect: "manual",
    });
  }
}
