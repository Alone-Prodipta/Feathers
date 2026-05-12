var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
var modal = document.getElementById('id01');
var overlay = document.getElementById('overlay');
var closeBtn = document.querySelector('.close');

function closeModal() {
  modal.style.display = "none";
  overlay.style.display = "none";
}

closeBtn.onclick = closeModal;
overlay.onclick = closeModal;
