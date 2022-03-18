window.onload = () => {
  const selEspecialidade = document.getElementById("especialidade");
  selEspecialidade.onchange = () => requestNames(selEspecialidade);

  const selDate = document.getElementById("date");
  requestSchedule(selDate).then(() => console.log());
  selDate.onchange = () =>
    // console.log(selDate.value)
    requestSchedule(selDate, selEspecialidade);
};

async function requestSchedule(select, specialty) {
  if (select.value === "" || select.value == null) {
    return;
  }
  try {
    const selMedico = document.getElementById("medico");
    const response = await fetch(
      `schedule.php?date=${select.value}&medicId=${selMedico.value}`
    );
    if (!response.ok) {
      throw new Error("Erro: ", response.status);
    }

    const data = await response.json();
    showSchedule(data);
  } catch (err) {
    console.log(err);
  }
}

async function requestNames(select) {
  if (select.value === "" || select.value == null) {
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
    for (let medic of data.medics) {
      let option = document.createElement("option");
      option.value = medic.id;
      option.text = medic.name;
      selNomes.add(option);
    }
  }
}

function showSchedule(data) {
  const selTime = document.getElementById("hour");
  clearSelect(selTime);
  const timeMarkers = [
    "8h",
    "9h",
    "10h",
    "11h",
    "12h",
    "13h",
    "14h",
    "15h",
    "16h",
    "17h",
  ];
  if (data.success) {
    const timeScheduled = new Set(data.timeScheduled);
    const timesShow = timeMarkers.filter((t) => !timeScheduled.has(t));
    for (let time of timesShow) {
      let option = document.createElement("option");
      option.value = time;
      option.text = time;
      selTime.add(option);
    }
  } else {
    for (let time of timeMarkers) {
      let option = document.createElement("option");
      option.value = time;
      option.text = time;
      selTime.add(option);
    }
  }
}

function clearSelect(select) {
  while (select.options.length > 0) {
    select.remove(0);
  }
}
