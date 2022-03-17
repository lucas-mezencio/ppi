window.onload = () => {
  const inputCep = document.getElementById("cep");
  inputCep.onkeyup = () => loadAddress(inputCep.value);
};

async function loadAddress(cep) {
  if (cep.length != 9) {
    return;
  }
  try {
    const form = document.getElementById("pat-form");
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
