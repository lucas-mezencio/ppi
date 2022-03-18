window.onload = () => {
    const selEspecialidade = document.getElementById("especialidade");
    selEspecialidade.onchange = () => requestNames(selEspecialidade);
}

async function requestNames(select) {
    if (select.value === '' || select.value == null) {
        return;
    }

    try {
        const response = await fetch(`search.php?especialidade=${select.value}`);
        if (!response.ok) {
            throw new Error("Erro: " + response.status);
        }
        const data = await response.json();
        showNames(data);
    } catch (err) {
        console.log(err);
    }
}

function showNames(data) {
    const selNomes = document.getElementById("medico");
    clearSelect(selNomes);
    if (data.success) {
        for (let nome of data.nomes) {
            let option = document.createElement("option");
            option.value = nome;
            option.text = nome;
            selNomes.add(option);
        }
    }
}

function clearSelect(select) {
    while (select.options.length > 0) {
        select.remove(0);
    }
}