import Completions from "../services/api/Completions.js";
import Alert from "../components/Alert.js";

const form = document.querySelector("#tutorial-completions");

form.addEventListener("submit", async (e) => {
  e.preventDefault();

  const csrfToken = form
    .querySelector('[name="csrfToken"]')
    .getAttribute("value");

  const completions = [...form.querySelectorAll('input[type="checkbox"]')].map(
    (checkbox) => {
      const tutorialId = checkbox.getAttribute("name");
      const newValue = Number(checkbox.checked).toString();
      return [tutorialId, newValue];
    }
  );

  try {
    const response = await Completions.put(csrfToken, completions);
    const json = await response.json();
    console.log(json);
    const saveAlert = new Alert("#save-status");

    saveAlert.setMessage(
      response.ok
        ? "Successfully saved!"
        : "Failed to save. Please try again later."
    );
    saveAlert.show();
  } catch (e) {
    console.error(e);
  }
});
