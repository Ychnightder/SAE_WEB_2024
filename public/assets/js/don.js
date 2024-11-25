function showForm(formType) {
  document.getElementById("individual-form").classList.remove("active");
  document.getElementById("organization-form").classList.remove("active");
  document.getElementById("individual-tab").classList.remove("active");
  document.getElementById("organization-tab").classList.remove("active");

  if (formType === "individual") {
    document.getElementById("individual-form").classList.add("active");
    document.getElementById("individual-tab").classList.add("active");
  } else {
    document.getElementById("organization-form").classList.add("active");
    document.getElementById("organization-tab").classList.add("active");
  }
}
