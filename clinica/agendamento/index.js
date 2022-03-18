window.onload = () => {
    const selEspecialidade = document.getElementById("especialidade");
    selEspecialidade.onchange = () => requestSpecialty();
}

async function requestSpecialty() {
    try {
        const response = await fetch(``)
    }
}