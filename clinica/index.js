window.onload = () => {
  openModal();

  const btnLogin = document.getElementById("button-login");
  btnLogin.onclick = sendLoginForm;
};

function openModal() {
  const buttons = document.querySelectorAll(".clinica-navitem");

  for (let button of buttons) {
    button.onclick = (event) => {
      event.preventDefault();
      openTab(button.dataset.tabname);
    };
  }
  openTab("cont-a");

  const modal = document.getElementById("modal-login");
  const btnOpen = document.getElementById("btn-login");
  const btnClose = document.getElementById("modal-close");

  btnOpen.onclick = () => (modal.style.display = "block");
  btnClose.onclick = () => (modal.style.display = "none");

  function openTab(tab) {
    const lastTab = document.querySelector(".tab-active");
    const lastBtn = document.querySelector(".btn-active");

    if (lastTab !== null && lastBtn !== null) {
      lastTab.className = "";
      lastBtn.className = "clinica-navitem";
    }

    document.querySelector(`.tabs > section[data-tabname="${tab}"]`).className =
      "tab-active";

    document.querySelector(`nav button[data-tabname="${tab}"]`).className =
      "clinica-navitem btn-active";
  }
}

async function sendLoginForm() {
  event.preventDefault();
  try {
    const loginForm = document.getElementById("form-login");
    const loginFormData = new FormData(loginForm);

    const response = await fetch("login.php", {
      method: "POST",
      body: loginFormData,
    });

    if (!response.ok) {
      throw new Error("Erro: ", response.status);
    }

    const login = await response.json();
    if (login.success) {
      window.location = login.detail;
    } else {
      document.getElementById("login-fail").style.display = "block";
      loginForm.password.value = "";
    }
  } catch (err) {
    console.log(err);
  }
}
