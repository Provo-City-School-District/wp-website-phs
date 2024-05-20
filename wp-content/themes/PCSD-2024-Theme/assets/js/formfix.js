//forms with textarea with ID "message". when focused it should scroll to place the textarea at the top of the viewport to the best of its ability.
let formMessageInput = document.getElementById("textareamessage");

formMessageInput.addEventListener("focus", function () {
  formMessageInput.scrollIntoView({ block: "center" });
});