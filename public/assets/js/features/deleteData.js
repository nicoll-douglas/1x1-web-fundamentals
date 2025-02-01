import User from "../services/api/User.js";
import Alert from "../components/Alert.js";

const form = document.querySelector("#delete-data-form");

form.addEventListener("submit", async (e) => {
  e.preventDefault();

  const { csrfToken } = form.querySelector("button").dataset;

  try {
    // If success on the backend this should redirect to /auth/goodbye
    const response = await User._delete(csrfToken);

    if (response.ok) {
      window.location.href = "/auth/goodbye";
      return;
    }

    const deleteAlert = new Alert("#delete-status");
    deleteAlert.setMessage("Failed to delete data. Please try again later.");
    deleteAlert.show();
  } catch (e) {
    console.error(e);
  }
});
