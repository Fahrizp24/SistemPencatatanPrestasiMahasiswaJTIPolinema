// Get the modal
var modal = document.getElementById("editProfileModal");

// Get the button that opens the modal
var btn = document.getElementById("editProfileBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function () {
    modal.style.display = "block";
}

// Event listener for clicking on the profile picture
document.querySelector('.profile-pic-container').addEventListener('click', function () {
    document.getElementById('profilePicture').click();
});

// Show preview of uploaded image
document.getElementById('profilePicture').addEventListener('change', function (event) {
    const reader = new FileReader();
    reader.onload = function () {
        document.getElementById('previewImage').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
});

// When the user clicks on <span> (x), close the modal
span.onclick = function () {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}