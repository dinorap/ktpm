const registerForm = document.getElementById("registers-form");
registerForm.addEventListener("submit", register);

function register(event) {
  event.preventDefault();
  const newUsername = document.getElementById("new-username").value;
  const newEmail = document.getElementById("new-email").value;
  const newPassword = document.getElementById("new-password").value;

  const xhr = new XMLHttpRequest();
  xhr.open("POST", "register.php");
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (xhr.status === 200) {
      const response = JSON.parse(xhr.responseText);
      if (response.success) {
        const messageBox = document.createElement("div");
        messageBox.style.zIndex = "99000";
        messageBox.textContent = "Đăng ký thành công";
        messageBox.style.position = "fixed";
        messageBox.style.top = "10px";
        messageBox.style.left = "50%";
        messageBox.style.transform = "translateX(-50%)";
        messageBox.style.width = "30%";
        messageBox.style.backgroundColor = "#00e5ff";
        messageBox.style.color = "white";
        messageBox.style.textAlign = "center";
        messageBox.style.padding = "10px";
        document.body.appendChild(messageBox);
        setTimeout(function () {
          window.location.href = "uslist.php";
        }, 2000); // Chuyển hướng trang sau 3 giây
      } else {
        alert(response.message);
      }
    } else {
      alert("Error: " + xhr.statusText);
    }
  };
  xhr.onerror = function () {
    alert("Network Error");
  };
  xhr.send(
    "new-username=" +
      encodeURIComponent(newUsername) +
      "&new-email=" +
      encodeURIComponent(newEmail) +
      "&new-password=" +
      encodeURIComponent(newPassword)
  );
}
