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
  } catch (error) {
    console.log(error);
  }
});
