export function openPopup() {
    document.getElementById("overlay").style.display = "block";
    document.getElementById("popup").style.display = "flex";
  }

export function closePopup() {
    document.getElementById("overlay").style.display = "none";
    document.getElementById("popup").style.display = "none";
  }