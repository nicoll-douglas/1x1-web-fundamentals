import Alert from "../classes/Alert.js";

const form = document.querySelector("#tutorial-completions");

form.addEventListener("submit", async (e) => {
  e.preventDefault();
  const formData = new FormData();

  form.querySelectorAll('input[type="checkbox"]').forEach((checkbox) => {
    const name = checkbox.getAttribute("name");
    const value = Number(checkbox.checked).toString();
    formData.set(name, value);
  });

  try {
    const response = await fetch("/api/completions.php", {
      method: "POST",
      body: formData,
    });
    const json = await response.json();
    console.log(json);

    switch (response.status) {
      case 200:
        Alert.show("Successfully saved!");
        break;
      default:
        Alert.show(
          "Failed to save. Something went wrong, please try again later."
        );
    }
  } catch (error) {
    console.log(error);
  }
});
