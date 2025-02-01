import Alert from "../components/Alert.js";
import Completions from "../services/api/Completions.js";

const form = document.querySelector("#mark-complete-form");

form.addEventListener("submit", async (e) => {
  e.preventDefault();

  const button = form.querySelector("button");
  const { tutorialId, newValue, csrfToken } = button.dataset;

  try {
    const response = await Completions.put(csrfToken, [[tutorialId, newValue]]);
    const saveAlert = new Alert("#save-status");

    if (!response.ok) {
      saveAlert.setMessage(
        "Failed to update. Something went wrong, please try again later."
      );
      saveAlert.show();
      return;
    }

    if (newValue === "1") {
      saveAlert.setMessage("Successfully completed!");
      saveAlert.show();
      button.textContent = "Completed";
      button.dataset.newValue = "0";
      return;
    }

    saveAlert.setMessage("Marked incomplete.");
    saveAlert.show();
    button.textContent = "Mark tutorial as completed";
    button.dataset.newValue = "1";
  } catch (e) {
    console.error(e);
  }
});
