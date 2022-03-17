window.onload = () => {
  // const salaryInput = document.getElementById("salario");
  // salaryInput.onchange = (e) => {
  //   const formatter = new Intl.NumberFormat("pt-BR", {
  //     style: "currency",
  //     currency: "BRL",
  //   });
  //
  //   if (isNaN(e.target.value)) {
  //     e.target.value = "";
  //   } else {
  //     e.target.value = formatter.format(e.target.value);
  //   }
  // };

  const medicCheckbox = document.getElementById("isMedico");
  medicCheckbox.onchange = () => {
    if (medicCheckbox.checked) {
      document.querySelectorAll(".cad-medico").forEach((field) => {
        field.style.display = "block";
      });
      document.getElementById("crm").required = true;
      document.getElementById("especialidade").required = true;
    } else {
      document.querySelectorAll(".cad-medico").forEach((field) => {
        field.style.display = "none";
      });
      document.getElementById("crm").required = false;
      document.getElementById("especialidade").required = false;
    }
  };

  const inputCep = document.getElementById("cep");
  inputCep.onkeyup = () => loadAddress(inputCep.value);
};

async function loadAddress(cep) {
  if (cep.length != 9) {
    return;
  }
  try {
    const form = document.getElementById("emp-form");
    const response = await fetch(`loadAddress.php?cep=${cep}`);

    if (!response.ok) {
      throw new Error("Erro: ", response.status);
    }

    const data = await response.json();

    if (data.success) {
      form.logradouro.value = data.logradouro;
      form.cidade.value = data.cidade;
      form.estado.value = data.estado;
    }
  } catch (err) {
    console.log(err);
  }
}
