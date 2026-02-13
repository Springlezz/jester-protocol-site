const startBtn = document.querySelector(".start-btn");
const createBtn = document.querySelector(".create-btn");
const moreBtn = document.querySelector(".more-btn");

startBtn.addEventListener("click", () => {
  window.location.assign("/game");
});

createBtn.addEventListener("click", () => {
  window.location.assign("/create-level");
});

moreBtn.addEventListener("click", () => {
  window.location.assign("/community");
});