import Alert from "../classes/Alert.js";

const button = document.querySelector("#mark-complete-btn");

button.addEventListener("click", async (e) => {
  e.preventDefault();
  const formData = new FormData();

  const id = button.dataset.id;
  const newValue = button.dataset.newValue;
  formData.set(id, newValue);

  const csrfToken = document
    .querySelector('input[name="csrf_token"]')
    .getAttribute("value");
  formData.set("csrf_token", csrfToken);

  try {
    const response = await fetch("/api/completions.php", {
      method: "POST",
      body: formData,
    });

    const json = await response.json();
    console.log(json);

    switch (response.status) {
      case 200:
        if (newValue === "1") {
          Alert.show("Successfully completed!");
          button.textContent = "Completed";
          button.dataset.newValue = "0";
        } else {
          Alert.show("Marked incomplete.");
          button.textContent = "Mark tutorial as completed";
          button.dataset.newValue = "1";
        }
        break;
      default:
        Alert.show(
          "Failed to update. Something went wrong, please try again later."
        );
    }
  } catch (error) {
    console.log(error);
  }
});
