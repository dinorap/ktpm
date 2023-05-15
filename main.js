const loginForm = document.getElementById("login-form");
loginForm.addEventListener("submit", login);

const registerForm = document.getElementById("register-form");
registerForm.addEventListener("submit", register);
// Login form
function login(event) {
  event.preventDefault();
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "login.php");
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (xhr.status === 200) {
      const response = JSON.parse(xhr.responseText);
      if (response.success) {
        const messageBox = document.createElement("div");
        messageBox.style.zIndex = "9999";
        messageBox.textContent = "Đăng nhập thành công";
        messageBox.style.position = "fixed";
        messageBox.style.top = "10";
        messageBox.style.left = "50%";
        messageBox.style.transform = "translateX(-50%)";
        messageBox.style.width = "30%";
        messageBox.style.backgroundColor = "#00e5ff";
        messageBox.style.color = "white";
        messageBox.style.textAlign = "center";
        messageBox.style.padding = "10px";
        document.body.appendChild(messageBox);
        if (response.ad == 1) {
          setTimeout(function () {
            window.location.href = "uslist.php";
          }, 2000); // Chuyển hướng trang sau 3 giây
        } else {
          setTimeout(function () {
            window.location.href = "test/index.html";
          }, 2000); // Chuyển hướng trang sau 3 giây
        }

        setTimeout(function () {
          messageBox.style.display = "none";
        }, 2000);
        // Redirect to login page or do other stuff here
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
    "email=" +
      encodeURIComponent(email) +
      "&password=" +
      encodeURIComponent(password)
  );
}
// Register form
function register(event) {
  event.preventDefault();
  const newUsername = document.getElementById("new-username").value;
  const newEmail = document.getElementById("new-email").value;
  const newPassword = document.getElementById("new-password").value;
  const confirmPassword = document.getElementById("confirm-password").value;

  if (newPassword !== confirmPassword) {
    alert("Passwords do not match");
    return;
  }

  const xhr = new XMLHttpRequest();
  xhr.open("POST", "register.php");
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (xhr.status === 200) {
      const response = JSON.parse(xhr.responseText);
      if (response.success) {
        const messageBox = document.createElement("div");
        messageBox.style.zIndex = "9999";
        messageBox.textContent = "Đăng ký thành công";
        messageBox.style.position = "fixed";
        messageBox.style.top = "10";
        messageBox.style.left = "50%";
        messageBox.style.transform = "translateX(-50%)";
        messageBox.style.width = "30%";
        messageBox.style.backgroundColor = "#00e5ff";
        messageBox.style.color = "white";
        messageBox.style.textAlign = "center";
        messageBox.style.padding = "10px";
        document.body.appendChild(messageBox);
        setTimeout(function () {
          window.location.href = "index.html";
        }, 2000); // Chuyển hướng trang sau 3 giây
        setTimeout(function () {
          messageBox.style.display = "none";
        }, 2000);
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
